<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Member;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
{
    $request->validate([
        'name' => ['required', 'string', 'max:45'],
        'email' => ['required', 'string', 'email', 'max:45', 'unique:users,email', 'unique:members,email'],
        'password' => ['required', 'confirmed', Rules\Password::defaults()],
    ]);

    // Simpan ke tabel members
    $member = Member::create([
        'nama' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);

    // Simpan ke tabel users dengan id_roles 13
    $user = User::create([
        'nama' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'id_roles' => 4,
    ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('index', absolute: false));
    }
}
