<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Setting;
use Symfony\Component\HttpFoundation\Response;

class MaintenanceMode
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $setting = Setting::first();

        // Agar maintenance OFF hai to sab ko allow karo
        if (!$setting || !$setting->maintenance_mode) {
            return $next($request);
        }

        // Login aur Register pages hamesha allow hon
        if (
            $request->routeIs('login') ||
            $request->routeIs('login.store') ||
            $request->routeIs('register') ||
            $request->routeIs('register.store')
        ) {
            return $next($request);
        }

        // Sirf Admin ko allow karo
        if (auth()->check() && auth()->user()->role === 'Admin') {
            return $next($request);
        }

        // Baqi sab ko maintenance page
        return response()->view('maintenance');
    }
}
