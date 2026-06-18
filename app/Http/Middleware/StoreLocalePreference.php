<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class StoreLocalePreference
{
    public function handle(Request $request, Closure $next)
{
   
    if (Auth::check()) {
        $locale = Auth::user()->locale;
        if ($locale) {
            App::setLocale($locale);
        }
    } 
   
    elseif (!Session::has('locale')) {
        $ip = $request->ip();
        if ($ip !== '127.0.0.1' && $ip !== '::1') {
            try {
                $response = Http::timeout(2)->get("http://ip-api.com/json/{$ip}");
                if ($response->successful()) {
                    $country = $response->json('countryCode');
                    $locale = match($country) {
                        'FR' => 'fr',
                        'NL', 'BE' => 'nl',
                        default => 'en'
                    };
                    App::setLocale($locale);
                }
            } catch (\Exception $e) {
                App::setLocale('en');
            }
        }
    }

    return $next($request);
}
}