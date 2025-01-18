<?php

namespace App\Http\Controllers\admin;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Mail\OrderStatusChanged;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    public function index(Request $request)
    {
       $orders=Order::whereNotNull('payment_id',)->with('users')->latest('orders.created_at');


        $orders=$orders->paginate(6);
        $data['orders']=$orders;
       return view('admin.Orders.index',$data);
    }
    public function detail($id)
    {
       
        $order = Order::with(['users', 'users.details', 'orderItems'])
        ->where('id', $id)
        ->first();

    
            // $orderItems = OrderItem::where('order_id', $id)->get();
    
            return view('admin.Orders.order-detail', [
                'order' => $order,
                // 'orderItems' => $orderItems
            ]);
    }

    public function changeOrderSatatus(Request $request,$orderId)
    {
        //dd($orderId);
        $orderItems=OrderItem::find($orderId);
        // Get the associated Order
         $order = $orderItems->order;
        $orderItems->status=$request->order_status;
        $orderItems->shipped_date=$request->shipped_date;
        if($request->order_status==='shipped')
        {
            $orderItems->delivery_partner=$request->delivery_partner;
            $orderItems->tracking_number=$request->tracking_number;
        }
        $orderItems->save();
        if($order && $order->users)
        {
           Mail::to($order->users->email)->send(new OrderStatusChanged($order));
        }
        $this->updateOrderStatus($order);
 
        \session()->flash('success','Order Status change sucessfully');
        return back()->with('success', 'Order Status change sucessfully and Email is sent to user');

    }

    protected function updateOrderStatus(Order $order)
    {
       
        $orderItemStatuses = $order->orderItems()->pluck('status')->unique();

        if ($orderItemStatuses->count() === 1 && $orderItemStatuses->first() === 'shipped') {
            // All items are shipped
            if ($order->status !== Order::STATUS_COMPLETED) {
                $order->status = Order::STATUS_COMPLETED;
                $order->save();
            }
        } elseif ($orderItemStatuses->contains('shipped') && !$orderItemStatuses->contains('pending')) {
            // Some items are shipped, others are in different statuses (e.g., delivered)
            // Adjust according to your business logic
            // For example, set to 'partial_shipped'
            if ($order->status !== Order::STATUS_PARTIAL_SHIPPED) {
                $order->status = Order::STATUS_PARTIAL_SHIPPED;
                $order->save(); 
            }
        } else {
            // At least one item is not shipped
            if ($order->status !== Order::STATUS_PENDING) {
                $order->status = Order::STATUS_PENDING;
                $order->save();

            }
        }
    }
}
