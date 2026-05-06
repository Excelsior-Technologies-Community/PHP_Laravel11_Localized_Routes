<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use CodeZero\LocalizedRoutes\Facades\LocalizedRoute;

class StoreLocalePreference
{
    public function handle(Request $request, Closure $next)
    {
        // If user selects language via dropdown
        if ($request->has('lang')) {
            session(['locale' => $request->lang]);
        }

        return $next($request);
    }
}