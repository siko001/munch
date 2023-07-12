<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class StaffAuthMiddleware {
    public function handle($request, Closure $next) {
        if (Auth::guard('staff')->check()) {
            return $next($request);
        }

        return redirect()->back()->with('failure', '403 Unauthorized Access.');
    }
}
