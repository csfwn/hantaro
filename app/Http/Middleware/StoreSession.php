<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class StoreSession
{
    public function handle(Request $request, Closure $next): Response
    {
        // If visiting /store/{code}, update current store_code
        $routeCode = $request->route('code');
        
        if ($routeCode && session('store_code') !== $routeCode) {
            // ✅ This is OK: setting current store reference
            session()->put('store_code', $routeCode);
        }
        // ❌ DO NOT touch cart here
        // ❌ DO NOT forget cart
        // ❌ DO NOT modify cart structure

        return $next($request);
    }
}
