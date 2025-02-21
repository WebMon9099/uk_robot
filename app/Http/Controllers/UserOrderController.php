<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserOrderController extends Controller
{
    public function userOrder()
    {
        $user = Auth::user();
        $orders = $user->orders()
                 ->whereNotNull('payment_id')
                       ->with('orderItems.product')
                       ->orderBy('created_at','desc')->get();
                       //dd($orders);
        return view('user.ordersList', compact('orders'));
    }
    public function show($id)
    {
        // Fetch the order item from `order_items` where the ID matches
        $orderItems = OrderItem::where('id', $id)->with('order')->firstOrFail();

        // Fetch the corresponding order using the order_id from order_items
        $order = Order::where('id', $orderItems->order_id)->firstOrFail(); // Will throw a 404 if not found

          // Decode the address if it's stored as a JSON string
        if ($order && is_string($order->address)) {
            $order->address = json_decode($order->address, true); // Decode address into array
        }
        // dd($orderItems);
        // Pass both orderItems and order to the view
        return view('user.itemdetails', compact('orderItems', 'order'));
    }

    public function cancelOrder(Request $request)
    {
        // Validate the request to ensure the order_item_id is present
        $request->validate([
            'order_item_id' => 'required|exists:order_items,id'
        ]);

        // Fetch the order item by ID
        $orderItem = OrderItem::find($request->order_item_id);

        if (!$orderItem) {
            return response()->json(['success' => false, 'message' => 'Order item not found.']);
        }

        // Check the status of the order item
        if ($orderItem->status === 'delivered') {
            return response()->json(['success' => false, 'message' => 'Cannot cancel a delivered order.']);
        }
        if ($orderItem->status === 'cancelled') {
            $order = $orderItem->order;
            $order->status=$orderItem->status;
            $order->save();
            return response()->json(['success' => false, 'message' => 'Cannot cancel, the item is already cancelled.']);
        }

        // Update the status to 'cancelled'
        $orderItem->status = 'cancelled';
        $orderItem->save();

        return response()->json(['success' => true, 'message' => 'Order cancelled successfully.']);
    }
}
