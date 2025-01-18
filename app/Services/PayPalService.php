<?php
// app/Services/PayPalService.php

namespace App\Services;

use App\Models\Settings;
use Exception;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class PayPalService
{
    protected $provider;

    public function __construct()
    {
        
    //     $paypalConfig = Settings::where('payment_type', 'paypal')->first();
    //     if (!$paypalConfig) {
    //         throw new \Exception('PayPal credentials not found in the database.');
    //     }
    //    dd($paypalConfig);
    //     $this->provider = new PayPalClient;
    //      $this->provider->setApiCredentials([
    //     'mode' => $paypalConfig->mode,
    //     'client_id' => $paypalConfig->client_id,
    //     'client_secret' => $paypalConfig->client_secret,
    // ]);
        // $this->provider->setApiCredentials([
        //     'mode' => $paypalConfig->mode,
        //     'sandbox' => [
        //         'client_id' => $paypalConfig->client_id,
        //         'client_secret' => $paypalConfig->client_secret,
        //     ],
        //     // 'live' => [
        //     //     'client_id' => $paypalConfig->client_id,
        //     //     'client_secret' => $paypalConfig->client_secret,
        //     // ],
        // ]);
        //$this->provider->getAccessToken();
         $this->provider = new PayPalClient;
         try {
            $this->provider->getAccessToken();
        } catch (Exception $e) {
            // Handle exceptions related to accessing PayPal
            throw new Exception('Unable to get PayPal access token: ' . $e->getMessage());
        }
        // $this->provider->setApiCredentials(config('paypal'));
        // $this->provider->getAccessToken();
    }

    // public function __construct()
    // {
    //     // Retrieve PayPal credentials from the database
    //     $paypalConfig = Settings::where('payment_type', 'paypal')->first();

    //     if (!$paypalConfig || !$paypalConfig->client_id || !$paypalConfig->client_secret) {
    //         throw new \Exception('PayPal credentials not found in the database.');
    //     }
    //     dd($paypalConfig);
    //     // Initialize PayPal client
    //     $this->provider = new PayPalClient;
    //     $this->provider->setApiCredentials([
    //         'mode' => $paypalConfig->mode, // 'sandbox' or 'live'
    //         'sandbox' => [
    //             'client_id' => $paypalConfig->client_id,
    //             'client_secret' => $paypalConfig->client_secret,
    //         ],
    //         'live' => [
    //             'client_id' => $paypalConfig->client_id,
    //             'client_secret' => $paypalConfig->client_secret,
    //         ],
    //     ]);

    //     $this->provider->getAccessToken();
    // }



    public function createOrder($grandTotal, $cartItems)
    {
        // Directly retrieve the access token without additional calls
        $paypalToken = $this->provider->getAccessToken();

        // Create the order
        $response = $this->provider->createOrder([
            "intent" => "CAPTURE",
            "purchase_units" => [
                [
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => $grandTotal, // Pass as a float
                        "breakdown" => [
                            "item_total" => [
                                "currency_code" => "USD",
                                "value" => $cartItems->sum(function ($item) {
                                    return $item->price * $item->quantity; // Calculate total price for items
                                }),
                            ],
                            // Add other breakdowns if needed
                        ],
                    ],
                    "items" => $cartItems->map(function ($item) {
                        return [
                            "name" => $item->product->name,
                            "unit_amount" => [
                                "currency_code" => "USD",
                                "value" => $item->price, // Pass as a float
                            ],
                            "quantity" => $item->quantity,
                        ];
                    })->toArray(),
                ],
            ],
            "application_context" => [
                "return_url" => route('paypal.return'),
                "cancel_url" => route('paypal.cancel'),
            ],
        ]);

        // Log the response for debugging
        \Log::info('PayPal Create Order Response:', (array) $response);

        return $response;
    }

    // public function createOrder($grandTotal, $cartItems)
    // {
    //     $paypalToken = $this->provider->getAccessToken();

    //     $response = $this->provider->createOrder([
    //         "intent" => "CAPTURE",
    //         "purchase_units" => [
    //             [
    //                 "amount" => [
    //                     "currency_code" => "USD",
    //                     "value" => number_format($grandTotal, 2, '.', ''),
    //                     "breakdown" => [
    //                         "item_total" => [
    //                             "currency_code" => "USD",
    //                             "value" => number_format($cartItems->sum('price'), 2, '.', ''),
    //                         ],
    //                         // Add other breakdowns as needed
    //                     ],
    //                 ],
    //                 "items" => $cartItems->map(function ($item) {
    //                     return [
    //                         "name" => $item->product->name,
    //                         "unit_amount" => [
    //                             "currency_code" => "USD",
    //                             "value" => number_format($item->price, 2, '.', ''),
    //                         ],
    //                         "quantity" => $item->quantity,
    //                     ];
    //                 })->toArray(),
    //             ],
    //         ],
    //         "application_context" => [
    //             "return_url" => route('paypal.return'),
    //             "cancel_url" => route('paypal.cancel'),
    //         ],
    //     ]);

    //     return $response;
    // }

    public function capturePayment($token)
    {
        \Log::info('Token for capture payment:', ['token' => $token]);

        // Ensure to call the capture method with just the token
        $response = $this->provider->capturePaymentOrder($token);
        return $response;

    }
}
