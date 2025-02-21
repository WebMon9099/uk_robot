<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UserAuthenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // if (Auth::check() && Auth::user()->user_type == 2) {
        //     return $next($request);
        // }
        if (Auth::check() && in_array(Auth::user()->user_type,[1,2,3,4,5,6,7,8])) {
            return $next($request);
        }
        if (!session()->has('url.intended')) {
            session(['url.intended' => url()->current()]); // Store current URL
        }
        return redirect()->route('user.login')->with('error', 'Unauthorized access as you are not User.');
    }
}
