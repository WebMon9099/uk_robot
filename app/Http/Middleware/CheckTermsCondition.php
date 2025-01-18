<?php

namespace App\Http\Middleware;

use App\Models\User;
use App\Models\UserIp;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Response;
use GuzzleHttp\Client;


class CheckTermsCondition
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $client = new Client();
        $response = $client->get('https://api.ipify.org/?format=json');
        $data = json_decode($response->getBody(), true);
        $ipAddress = $data['ip'];
        if (UserIp::where('ip', $ipAddress)->exists()) { 
            session()->put('open_modal', false);
        }else{
            session()->put('open_modal', true);
        }
        return $next($request);
    }
}
