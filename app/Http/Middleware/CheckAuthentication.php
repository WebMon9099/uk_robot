<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckAuthentication
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'UnAuthorized');
        }
        $user = Auth::user();

        if ($request->is('Admin/site-setting') && $user->user_type !== 0) {
            return redirect()->route('login')->with('error', 'Unauthorized access.');
        }
       
        $restrictedRoutes = [
            'Admin/Product',
            'Admin/User',
            'Admin/Order',
            'Admin/Payment',
            /* 'Admin/site-setting', */
        ];
        
        // Check if the user is not user_type = 1 and attempting to access restricted routes
        if (!in_array($user->user_type, [1, 0]) && $request->is($restrictedRoutes)) {
            return redirect()->route('login')->with('error', 'Unauthorized access.');
        }
        if (!in_array($user->user_type, [0, 1, 3, 4, 5, 6, 7, 8])) {
            Auth::logout();
            return redirect()->route('login')->with('error', 'Unauthorized access.');
        }
        
        return $next($request);
    }
}
