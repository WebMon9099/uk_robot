<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Redirect;


class AdminAuthenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::guard('admin')->check() && Auth::guard('admin')->user()->user_type == 1) {
            return $next($request);
        }

        return redirect()->route('register')->with('error', 'Unauthorized access as you are not admin.');
    }

    // protected function authenticate($request, array $guards)
    // {
    //     if ($this->auth->guard('admin')->check()) {
    //         return $this->auth->shouldUse('admin');
    //     } 

    //     $this->unauthenticated($request, ['admin']);
    // }
}
