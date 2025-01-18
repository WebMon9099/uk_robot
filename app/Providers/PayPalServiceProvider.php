<?php

namespace App\Providers;

use App\Models\Settings;
use App\Services\PayPalService;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;

class PayPalServiceProvider extends ServiceProvider
{
    public function register()
    {
        // Bind the PayPalService to the service container
        $this->app->singleton(PayPalService::class, function ($app) {
            return new PayPalService();
        });
    }

    public function boot()
    {
        try {
            // Retrieve the PayPal settings from the database
            $paypalSettings = Settings::where('payment_type', 'paypal')->first();

            if ($paypalSettings) {
                $mode = strtolower($paypalSettings->mode) === 'live' ? 'live' : 'sandbox';

                // Set the mode
                Config::set('paypal.mode', $mode);

                // Set the credentials based on the mode
                if ($mode === 'live') {
                    Config::set('paypal.live.client_id', $paypalSettings->live_client_id);
                    Config::set('paypal.live.client_secret', $paypalSettings->live_client_secret);
                } else {
                    Config::set('paypal.sandbox.client_id', $paypalSettings->sandbox_client_id);
                    Config::set('paypal.sandbox.client_secret', $paypalSettings->sandbox_client_secret);
                }
                Config::set("paypal.{$mode}.app_id", $paypalSettings->app_id ?? '');

                // Optionally set other PayPal config options from the database
                Config::set('paypal.payment_action', $paypalSettings->payment_action ?? 'Sale');
                Config::set('paypal.currency', $paypalSettings->currency ?? 'USD');
                Config::set('paypal.notify_url', $paypalSettings->notify_url ?? '');
                Config::set('paypal.locale', $paypalSettings->locale ?? 'en_US');
                Config::set('paypal.validate_ssl', $paypalSettings->validate_ssl ?? true);
            } else {
                // Log a warning if PayPal settings are not found
                Log::warning('PayPal credentials not found in the database. Using default .env configurations.');
            }
        } catch (\Exception $e) {
            // Log any exceptions that occur during the configuration
            Log::error('Error setting PayPal configuration from database: ' . $e->getMessage());
        }
    }
}
