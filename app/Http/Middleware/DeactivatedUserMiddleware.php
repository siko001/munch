<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class DeactivatedUserMiddleware {
    public function handle($request, Closure $next) {
        $user = Auth::user();

        if ($user && !$user->active) {
            return redirect()->route('reactivate.account');
        }

        return $next($request);
    }
}
