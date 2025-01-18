<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function store(Request $request)
    {
        // Log the incoming request
        Log::info($request->all());

        // Validate incoming request
        $validated = $request->validate([
            'product_id' => 'required',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric',
            'total_price' => 'required|numeric',
            'can_type' => 'required|string',
        ]);

        $productId = $validated['product_id'];
        $quantity = $validated['quantity'];
        $price = $validated['price'];
        $totalPrice = $validated['total_price'];
        $canType = $validated['can_type'];

        // Check if the user is logged in
        if (auth()->check()) {
            $userId = auth()->id();

            // Check if product is already in the cart
            $existingCartItem = Cart::where('user_id', $userId)
                ->where('product_id', $productId)
                ->where('can_type', $canType)
                ->first();

            if ($existingCartItem) {
                // Update quantity if the product already exists in the cart
                $newQuantity = $existingCartItem->quantity + $quantity;
                if ($newQuantity > 5) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Sorry You cannot exceed a total of 5 pallets for this variation.',
                    ], 400);
                }

                $existingCartItem->update([
                    'quantity' => $newQuantity,
                    'price' => $price,
                    'total_price' => $totalPrice,
                ]);

                return response()->json([
                    'success' => true,
                    'message' => 'Great! Cart updated with additional quantity!',
                ]);
            }

            // Add the product to the user's cart
            Cart::create([
                'user_id' => $userId,
                'product_id' => $productId,
                'quantity' => $quantity,
                'price' => $price,
                'total_price' => $totalPrice,
                'can_type' => $canType,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'You are awesome, your Prodcut is Added Incart',
            ]);
        } else {
            // Handle guest users: Store cart items in the session
            $cart = session()->get('cart', []);

            // Check if the product is already in the session-based cart
            foreach ($cart as $index => $item) {
                if ($item['product_id'] == $productId && $item['can_type'] == $canType) {
                    // Update the quantity
                    $cart[$index]['quantity'] += $quantity;

                    if ($cart[$index]['quantity'] > 5) {
                        return response()->json([
                            'success' => false,
                            'message' => 'Sorry You cannot exceed a total of 5 pallets for this variation.',
                        ], 400);
                    }

                    session()->put('cart', $cart);

                    return response()->json([
                        'success' => true,
                        'message' => 'Great! Cart updated with additional quantity!',
                    ]);
                }
            }

            // Add new item to the session-based cart
            $cart[] = [
                'product_id' => $productId,
                'quantity' => $quantity,
                'price' => $price,
                'total_price' => $totalPrice,
                'can_type' => $canType,
            ];

            session()->put('cart', $cart);

            return response()->json([
                'success' => true,
                'message' => 'You are awesome, your Prodcut is Added Incart',
            ]);
        }
    }

    public function getdata()
    {
        if (Auth::check()) {
            $userId = Auth::id();
            $cartItems = Cart::with('product')->where('user_id', $userId)->get();
        } else {
            $cartItems = session()->get('cart', []);
        }
     
        $cartItems = collect($cartItems)->map(function ($item) {
            $product = Product::find($item['product_id']); 

            return [
                'id' => $item['product_id'],
                'product' => $product, 
                'quantity' => $item['quantity'],
                'price' => $item['price'],
                'total_price' => $item['total_price'],
                'can_type' => $item['can_type'],
            ];

        });

        return view('cart', ['cartItems' => $cartItems]);
    }

    public function destroy($productId,$canType)
    {
        if (auth()->check()) {
            // Logged-in user: Delete from the database
            $cartItem = Cart::where('user_id', auth()->id())
                ->where('product_id', $productId)
                ->where('can_type', $canType)
                ->first();

            if ($cartItem) {
                $cartItem->delete();
                return redirect()->back()->with('success', 'Item removed from cart.');
            }

            return redirect()->back()->with('error', 'Item not found.');
        } else {
            // Non-logged-in user: Handle cart in the session
            $cart = session()->get('cart', []);
            \Log::info('Cart before removal', ['cart' => $cart]);
            // Check if the cart is empty or not an array
            if (empty($cart) || !is_array($cart)) {
                return redirect()->back()->with('error', 'Cart is empty.');
            }

            // Loop through the cart to find the product by its ID
            foreach ($cart as $key => $item) {
                if ($item['product_id'] == $productId && $item['can_type'] == $canType) {
                    unset($cart[$key]); // Remove the item from the session cart
                    session()->put('cart', $cart); // Update session

                    return redirect()->back()->with('success', 'Item removed from cart.');
                }
            }

            return redirect()->back()->with('error', 'Item not found in session.');
        }
    }
   
    public function getCartCount()
    {
        // Check if the user is logged in
        if (Auth::check()) {
            // Get the total quantity of items in the user's cart
            $userId = Auth::id();
            $totalItems = Cart::where('user_id', $userId)->count();
            ;

        } else {
            // For guest users, calculate the total from the session
            $cartItems = session()->get('cart', []);
            $totalItems = collect($cartItems)->count();
            // $totalItems = collect($cartItems)->sum('quantity');
        }

        return response()->json(['totalItems' => $totalItems]);
    }

}