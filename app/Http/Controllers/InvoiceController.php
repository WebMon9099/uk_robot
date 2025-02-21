<?php

namespace App\Http\Controllers;

// use Barryvdh\DomPDF\Facade as PDF;
use PDF;
use Illuminate\Http\Request;
use App\Models\Order; // Assuming you have an Order model


class InvoiceController extends Controller
{
    
    public function downloadInvoice($order_id)
    {
        // dd($order_id);
        // Fetch order details by ID, including related items and their products
        $order = Order::find($order_id);
        // dd($order);

        // Decode the address if it's stored as a JSON string
        if ($order && is_string($order->address)) {
            $order->address = json_decode($order->address, true); // Decode address into array
        }
        // Check if order is found
        if (!$order) {
            return response()->json(['error' => 'Order not found'], 404);
        }

        // Pass the order details to the view
        $pdf = PDF::loadView('user.invoice', compact('order'));

        // Download the PDF
        return $pdf->download('invoice_' . $order->id . '.pdf');
    }
}
