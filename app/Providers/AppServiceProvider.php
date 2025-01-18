<?php

namespace App\Providers;

use App\Models\Cart;
use App\Models\SiteSetting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        View::composer(['components.navbar', 'index'], function ($view) {
            // Fetch the cart count and pass it to the navbar view
            $count = $this->getCartCount();

            $setting = SiteSetting::first();
            $salesStatus = $setting ? $setting->sales_status : 0;

            $view->with([
                'sales_status' => $salesStatus,
                'cartCount' => $count,
            ]);
        });
    }

    /**
     * Get the cart count for the current user or session.
     *
     * @return int
     */
    public function getCartCount()
    {
       
        if (Auth::check()) {
 
            $userId = Auth::id();
            $totalItems = Cart::where('user_id', $userId)->count();
        } else { 
            $cartItems = session()->get('cart', []);
            $totalItems = collect($cartItems)->count();
  
        }
        return $totalItems;
    }
}
