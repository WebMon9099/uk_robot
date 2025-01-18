<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\SiteSetting;

class CheckSalesStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        // Check the sales status from the database
        $salesEnabled = SiteSetting::first()->sales_status ?? true;

        if (!$salesEnabled) {
            // Abort with a 403 status or redirect with a message
            // return abort(403, 'E-commerce is currently disabled.');
            return redirect()->route('home')->with('error', 'E-commerce is currently disabled.');
        }

        return $next($request);
        
    }
}
