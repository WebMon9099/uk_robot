<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Exception;

class PaymentController extends Controller
{
    // Display all payments
    public function index()
    {
        try {
            $payments = Settings::all();
            return view('admin.payment.index', compact('payments'));
        } catch (Exception $e) {
            Log::error('Error fetching payments: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to fetch payment details.');
        }
    }

    // Store a new payment
    public function store(Request $request)
    {
        try {
            Log::info('Payment store request data: ', $request->all());

            // Validate the request
            $request->validate([
                'client_id' => 'required',
                'client_secret' => 'required',
                'mode' => 'required',
                'payment_type' => 'required',
                'status'=>'required',
            ]);
             //dd($request->all());
            // Create the payment
            Settings::create([
                'live_client_id' => $request->live_client_id,
                'live_client_secret' => $request->live_client_secret,
                'sandbox_client_id' => $request->client_id,
                'sandbox_client_secret' => $request->client_secret,
                'mode' => $request->mode,
                'payment_type' => $request->payment_type,
                'status' => $request->has('status') ? 1 : 0,
            ]);

            return redirect()->back()->with('success', 'Payment added successfully');
        } catch (Exception $e) {
            Log::error('Error adding payment: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to add payment. Please try again.');
        }
    }

    // Fetch payment details for editing
    public function edit($id)
    {
        try {
            $payment = Settings::findOrFail($id);
            return response()->json($payment);
        } catch (Exception $e) {
            Log::error('Error fetching payment for editing: ' . $e->getMessage());
            return response()->json(['error' => 'Payment not found'], 404);
        }
    }

    // Update payment details
    public function update(Request $request, $id)
    {
      // dd($request);
        try {
            // Validate the request
            $request->validate([
                'client_id' => 'required',
                'client_secret' => 'required',
                'mode' => 'required',
                'payment_type' => 'required',
                
            ]);
            Log::info('Updating payment with data: ', $request->all());

            // Fetch the payment and update
            $payment = Settings::findOrFail($id);
            $payment->update([
                'live_client_id' => $request->edit_live_client_id,
                'live_client_secret' => $request->edit_live_client_secret,
                'sandbox_client_id' => $request->client_id,
                'sandbox_client_secret' => $request->client_secret,
                'mode' => $request->mode,
                'payment_type' => $request->payment_type,
                'status' => $request->has('status') ? 1 : 0,// Will be 1 if checked, 0 if not
            ]);

            return response()->json(['message' => 'Payment updated successfully']);
        } catch (Exception $e) {
            Log::error('Error updating payment: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to update payment. Please try again.'], 500);
        }
    }

    // Get payment credentials based on mode
    public function getPaymentCredentials(Request $request)
    {
        try {
            $mode = $request->input('mode');

            // Validate the mode input
            if (!in_array($mode, ['live', 'sandbox'])) {
                return response()->json(['error' => 'Invalid mode provided'], 400);
            }

            // Retrieve credentials from the config
            $credentials = config("payment.$mode");

            // Fetch settings from the database if they exist
            $settings = Settings::where('mode', $mode)->first(['client_id', 'client_secret']);

            // Override config values with settings if they exist
            if ($settings) {
                $credentials['client_id'] = $settings->client_id;
                $credentials['client_secret'] = $settings->client_secret;
            }

            return response()->json($credentials);
        } catch (Exception $e) {
            Log::error('Error fetching payment credentials: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to fetch payment credentials.'], 500);
        }
    }

    public function toggleStatus($id)
    {
        try {
            $payment = Settings::findOrFail($id);
            
            // Toggle the status
            $payment->status = !$payment->status; 
    
            // Save the updated payment status
            $payment->save();
    
            // Determine the new status message
            $statusMessage = $payment->status ? 1 : 0;
    
            return response()->json([
                'success' => true,
                'status' => $payment->status,
                'message' => "Payment status successfully $statusMessage."
            ]);
        } catch (Exception $e) {
            Log::error('Error toggling payment status: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to toggle status.'], 500);
        }
    }
}
