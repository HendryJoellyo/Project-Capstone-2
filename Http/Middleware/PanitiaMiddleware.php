<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PanitiaMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check() && auth()->user()->role && auth()->user()->role->nama_role === 'Panitia_Event') {
            return $next($request);
        }

        abort(403, 'Unauthorized');
    }
}
