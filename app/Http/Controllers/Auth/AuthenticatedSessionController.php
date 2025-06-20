<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
{
    $request->authenticate();
    $request->session()->regenerate();

    $user = auth()->user();

    // Cek status user, kalau nonaktif langsung logout dan balikin pesan error
    if (!$user->status) {
        Auth::logout();
        return back()->withErrors([
            'email' => 'Akun Anda nonaktif. Silakan hubungi admin.',
        ]);
    }

    // Arahkan sesuai role
    if ($user->role && $user->role->nama_role === 'Admin') {
        return redirect()->route('admin.roles.dashboard');
    } elseif ($user->role && $user->role->nama_role === 'Panitia_Keuangan') {
        return redirect()->route('keuangan.dashboard');
    } elseif ($user->role && $user->role->nama_role === 'Panitia_Event') {
        return redirect()->route('panitia.dashboard');
    } elseif ($user->role && $user->role->nama_role === 'Member') {
        return redirect()->route('index');
    }

    abort(403, 'Unauthorized.');
}



    
    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
