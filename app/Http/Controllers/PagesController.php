<?php

namespace App\Http\Controllers;

use Stripe\Stripe;
use App\Models\Cart;
use App\Models\Order;
use App\Models\UserIp;
use GuzzleHttp\Client;
use App\Models\Address;
use App\Models\Product;
use Stripe\PaymentIntent;
use App\Models\SiteSetting;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Services\PayPalService;
use Illuminate\Support\Facades\Auth;


class PagesController extends Controller
{
    public function getProducts()
    {
        return view('product', [
            'products' => Product::with('images')->get()
        ]);
    }

    public function getOneProduct($id)
    {
        return view('product-detail', [
            'product' => Product::with('images')->find($id),
            'setting' => SiteSetting::find(1)
        ]);
    }
    
    public function addAddress(Request $request)
    {

        // Validate the request
        $request->validate([
            'new_name' => 'required|string|max:255',
            'new_phone_number' => 'required|string|max:20',
            'new_address' => 'required|string|max:255',
            'new_pincode' => 'required|string|max:255',
            'new_state' => 'required|string|max:255',
            'new_city' => 'required|string|max:255',

        ]);

        // Check if the user is logged in
        $user = Auth::user();

        if ($user) {
            // User is logged in; save the address to the database
            Address::create([
                'user_id' => $user->id,
                'name' => $request->new_name,
                'phone' => $request->new_phone_number,
                'address' => $request->new_address,
                'pin_code' => $request->new_pincode,
                'state' => $request->new_state,
                'city' => $request->new_city,
            ]);

            // Redirect back with a success message for logged-in users
            return redirect()->route('checkout')->with('success', 'Address added successfully.');
        } else {
            // User is not logged in; prepare data for local storage
            $addressData = [
                'name' => $request->new_name,
                'phone' => $request->new_phone_number,
                'address' => $request->new_address,
                'pin_code' => $request->new_pincode,
                'state' => $request->new_state,
                'city' => $request->new_city,
            ];

            // Return a JSON response with the address data to save locally
            return response()->json([
                'success' => true,
                'message' => 'User is not logged in. Address will be saved locally.',
                'data' => $addressData,
            ]);
        }
    }

    // Show the form for editing an existing address
    public function editAddress($id)
    {
        $user = Auth::user();
        $address = Address::where('user_id', $user->id)->findOrFail($id);

        return view('user.edit-address', compact('address'));
    }

    public function updateAddress(Request $request, $id)
    {
        // dd($request);
        // Find the address by ID
        $address = Address::find($id);

        if (!$address) {
            return response()->json(['error' => 'Address not found.'], 404);
        }

        // Update the address with data from the request
        $address->name = $request->input('update_name');
        $address->phone = $request->input('update_phone_number');
        $address->address = $request->input('update_address');
        $address->pin_code = $request->input('update_pin_code');
        $address->state = $request->input('update_state');
        $address->city = $request->input('update_city');

        // Save the updated address
        $address->save();

        // Return a success response
        return response()->json(['success' => 'Address updated successfully.']);
    }

    public function deleteAddress($id)
    {
        $user = Auth::user();
        $address = Address::where('user_id', $user->id)->findOrFail($id);

        // Delete the address
        $address->delete();

        // Return a JSON response
        return response()->json(['success' => true, 'message' => 'Address deleted successfully']);
    }
    public function checkout()
    {
        $cartItems = [];
        $addresses = [];
        $user = null;

        // Auth user
        if (Auth::check()) {
            $user = auth()->user();
            $addresses = Address::where('user_id', $user->id)->get();
            $cartItems = Cart::with('product')
                ->where('user_id', $user->id)
                ->get();
        } else {
            // Assuming session cart items are stored as an associative array
            $cartItems = session()->get('cart', []);
            $cartItems = collect($cartItems);
        }

        // Total calculation
        $totalAmount = collect($cartItems)->sum(function ($item) {
            // Handle both object and array cases
            if (is_object($item)) {
                return $item->price * $item->quantity; // Ensure product price is accessible
            } elseif (is_array($item)) {
                return $item['price'] * $item['quantity']; // Accessing price from array
            }
            return 0; // Default case
        });

        return view('checkout', [
            'cartItems' => $cartItems,
            'totalAmount' => $totalAmount,
            'user' => $user,
            'addresses' => $addresses,
        ]);
    }

    public function processCheckout(Request $request)
    {
       // dd($request);
        // Check if the user is logged in
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'You need to be logged in to proceed with checkout.');
        }

        // Validate the form data
        $validatedData = $request->validate([
            'name' => 'required|string',
            'phone_number' => 'required',
            'address' => 'required|string|max:255',
            'pin_code' => 'required|digits:6',
            'state' => 'required|string|max:100',
            'city' => 'required|string|max:100',
            'payment_method' => 'required',
        ]);
      
        //          if ($validatedData->fails()) {
        //     // Redirect back with error messages
        //     return response()->json($validatedData->messages(),400);
        // }

        // Structure the address data as an associative array
        $addressData = [
            'name' => $validatedData['name'],
            'phone_number' => $validatedData['phone_number'],
            'address' => $validatedData['address'],
            'pin_code' => $validatedData['pin_code'],
            'state' => $validatedData['state'],
            'city' => $validatedData['city'],
        ];
        $cartItems = Cart::with('product')->where('user_id', auth()->id())->get();
        if ($cartItems->isEmpty()) {
            return redirect()->back()->with('error', 'Your cart is empty');
        }

        // Calculate totals
        $subTotal = $cartItems->sum(function ($item) {
            return $item->price * $item->quantity;
        });

        $shippingCost = 0.00; // Define your shipping logic
        $discount = 0; // Include coupon discount logic if applicable
        $grandTotal = $subTotal + $shippingCost - $discount;

        $paymentMethod = $request->payment_method;

        // Create the order without marking it as paid yet
        $order = new Order();
        $order->user_id = auth()->id();
        $order->orderNumber = 'ORD-' . strtoupper(Str::random(10)); // Generate order number
        $order->sub_total = $subTotal;
        $order->shipping = $shippingCost;
        $order->discount = $discount;
        $order->grand_total = $grandTotal;
        $order->payment_method = $paymentMethod;
        $order->status = 'pending';
        $order->address = $addressData;
        $order->address_id = $request->selected_address;
        $order->save();

        // Link the cart items to the order
        foreach ($cartItems as $item) {
            $order->orderItems()->create([
                'product_id' => $item->product_id,
                'product_name' => $item->product->name,
                'pallet' => $item->can_type,
                'quantity' => $item->quantity,
                'price' => $item->price,
                'total' => $item->price * $item->quantity,
            ]);
        }

        // If PayPal is selected, create the PayPal order
        if ($paymentMethod === 'paypal') {
            $paypalService = new PayPalService();
            $paypalResponse = $paypalService->createOrder($grandTotal, $cartItems);

            // Handle PayPal response
            if (isset($paypalResponse['id'])) {
                $order->payment_id = $paypalResponse['id'];
                $order->save();
                return redirect($paypalResponse['links'][1]['href']);
            } else {
                return redirect()->back()->with('error', 'Error creating PayPal order.');
            }
        } elseif ($request->payment_method === 'cod') {
            $order->payment_id = 'COD-' . strtoupper(Str::random(8)); // Create a unique payment ID for COD
            $order->payment_status = 'not paid'; // Mark payment status as not paid
            $order->save();

            // Clear the cart items only if payment is successful
            Cart::where('user_id', auth()->id())->delete();

            // Redirect to order success page
            return view('orderSuccess', ['orderNumber' => $order->orderNumber]);
        }

        // If payment method is invalid
        return redirect()->back()->with('error', 'Invalid payment method selected.');
    }


    public function return(Request $request)
    {
        \Log::info('Return request data:', $request->all());

        $paymentId = $request->input('token');
        $payerId = $request->input('PayerID');

        \Log::info('Payment ID received:', ['payment_id' => $paymentId, 'payer_id' => $payerId]);

        $paypalService = new PayPalService();
        $captureResponse = $paypalService->capturePayment($paymentId);

        // Check if the response indicates a successful capture
        if (isset($captureResponse['id']) && $captureResponse['status'] === 'COMPLETED') {
            \Log::info('Capture successful:', $captureResponse);

            \Log::info('Looking up order by payment ID:', ['payment_id' => $paymentId]);
            $order = Order::where('payment_id', $paymentId)->first();

            if ($order) {
                // Check if the order has already been marked as paid
                if ($order->payment_status === 'paid') {
                    \Log::info('Order already paid:', ['order' => $order]);
                    return view('orderSuccess', ['orderNumber' => $order->orderNumber]);
                }

                // Update the order status
                $order->payment_status = 'paid';
                //$order->status = 'completed';
                $order->save();
                Cart::where('user_id', auth()->id())->delete();
                return view('orderSuccess', ['orderNumber' => $order->orderNumber]);
            } else {
                \Log::error('Order not found for payment ID:', ['payment_id' => $paymentId]);
                return redirect()->route('home')->with('error', 'Order not found.');
            }
        } else {
            \Log::error('Payment could not be captured:', $captureResponse);

            // Check for specific errors in the capture response
            if (isset($captureResponse['error'])) {
                $errorDetails = $captureResponse['error']['details'] ?? [];
                \Log::error('Capture error details:', $errorDetails);
            }

            return redirect()->route('home')->with('error', 'Payment could not be captured. Please try again.');
        }
    }

    public function cancel()
    {
        return redirect()->route('home')->with('error', 'Payment was cancelled.');
    }
    public function userOrder()
    {
        $user=Auth::user();
        $orders = $user->orders()->with('orderItems.product')->get();
        return view('user.ordersList', compact('orders'));
    }
    // public function checkout($id)
    // {
    //     return view('checkout', [
    //         'product' => Product::with('images')->find($id)
    //     ]);
    // }

    public function postOrder(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone_number' => 'required',
            'address' => 'required',
            'card_number' => 'required|regex:/^\d{4} \d{4} \d{4} \d{4}$/',
            'cvs' => 'required|regex:/^\d{3}$/',
            'expiry_date' => 'required|regex:/^\d{2}\/\d{4}$/',
            'price' => 'required'
        ]);
        try {
            Stripe::setApiKey('sk_test_51NYRGYGcmMBjdwMryh3L0cyk3Z3a6qbpIrDme39i9crBTgc0jK9zsg2C9e8aSFqGIec5HDnTBjODqC5O0AXYQZzV00VxmqcA18');
            $paymentIntent = PaymentIntent::create([
                'amount' => $request->price * 100,
                'currency' => 'usd',
                'description' => 'Order Payment',
                'payment_method' => $request->payment_method,
                'confirmation_method' => 'manual',
            ]);
            Order::create([
                'name' => $request->name,
                'email' => $request->email,
                'payment_id' => $paymentIntent->id,
                'phone_number' => $request->phone_number,
                'address' => $request->address,
                'card_number' => $request->card_number,
                'cvs' => $request->cvs,
                'expiry_date' => $request->expiry_date,
                'price' => $request->price
            ]);
            return redirect()->route('home')->with('success', 'Order Successfully Submitted');
        } catch (\Exception $e) {
            dd($e->getMessage());
            return back()->with('error', 'Failed to submit order. Please try again.');
        }
    }

    public function order()
    {
        return view('admin.order.index', [
            'orders' => Order::all()
        ]);
    }

    public function saveIp(Request $request)
    {
        try {
            UserIp::create([
                'ip' => $request->ip
            ]);
            session(['open_modal' => false]);
            return response()->json(['status' => true], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()], 500);
        }
    }
    public function saveIpFrom(Request $request)
    {
        try {
            $client = new Client();
            $response = $client->get('https://api.ipify.org/?format=json');
            $data = json_decode($response->getBody(), true);
            $ipAddress = $data['ip'];
            UserIp::create([
                'ip' => $ipAddress
            ]);
            session(['open_modal' => false]);
            return back();
        } catch (\Exception $e) {
            return back();
        }
    }
}
