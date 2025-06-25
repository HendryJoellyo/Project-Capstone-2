<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckFrontendMember
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->role->nama_role !== 'Member') {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
        }

        return $next($request);
    }
}
