<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class KeuanganMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check() && auth()->user()->role && auth()->user()->role->nama_role === 'Panitia_Keuangan') {
            return $next($request);
        }

        abort(403, 'Unauthorized');
    }
}
