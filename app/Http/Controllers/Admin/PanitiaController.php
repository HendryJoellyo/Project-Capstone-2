<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

use App\Models\PanitiaEvent;
use App\Models\User;


class PanitiaController extends Controller
{
    public function dashboard()
    {
        $panitias = PanitiaEvent::all();
        return view('admin.TPanitia.dashboard', compact('panitias'));
    }

    public function create()
    {
        return view('admin.TPanitia.create');
    }

    public function store(Request $request)
{
    $request->validate([
        'nama'      => 'required|string|max:100',
        'nomor_hp'  => 'required|string|max:20',
        'email'     => 'required|email|max:100|unique:users,email|unique:panitia_event,email',
        'password'  => 'required|string|max:100',
    ]);

    // hash password
    $hashedPassword = Hash::make($request->password);

    PanitiaEvent::create([
        'nama'      => $request->nama,
        'nomor_hp'  => $request->nomor_hp,
        'email'     => $request->email,
        'password'  => $hashedPassword,
    ]);

    // simpan ke tabel users
    User::create([
        'nama'      => $request->nama,
        'email'     => $request->email,
        'password'  => $hashedPassword,
        'id_roles'  => 3,
    ]);

    return redirect()->route('admin.panitias.dashboard')->with('success', 'Data berhasil ditambahkan.');
}


    public function edit($id)
    {
        $panitia = PanitiaEvent::findOrFail($id);
        return view('admin.TPanitia.edit', compact('panitia'));
    }

    public function update(Request $request, $id)
{
    $request->validate([
        'nama'      => 'required|string|max:100',
        'nomor_hp'  => 'required|string|max:20',
        'email'     => 'required|email|max:100',
        'password'  => 'nullable|string|max:100',
    ]);

    $panitia = PanitiaEvent::findOrFail($id);

    $data = [
        'nama'      => $request->nama,
        'nomor_hp'  => $request->nomor_hp,
        'email'     => $request->email,
    ];

    if ($request->filled('password')) {
        $data['password'] = Hash::make($request->password);
    }

    // update panitia
    $panitia->update($data);

    // cari user dengan email lama
    $user = User::where('email', $panitia->email)->first();

    if ($user) {
        $userData = [
            'nama'  => $request->nama,
            'email' => $request->email,
        ];

        if ($request->filled('password')) {
            $userData['password'] = $data['password'];
        }

        $user->update($userData);
    }

    return redirect()->route('admin.panitias.dashboard')->with('success', 'Data berhasil diperbarui.');
}


    public function destroy($id)
{
    $panitia = PanitiaEvent::findOrFail($id);

    // cari user berdasarkan email
    $user = User::where('email', $panitia->email)->first();

    $panitia->delete();

    // hapus user kalau ada
    if ($user) {
        $user->delete();
    }

    return redirect()->route('admin.panitias.dashboard')->with('success', 'Data berhasil dihapus.');
}

 public function toggleStatus($id)
    {
        $user = User::findOrFail($id); 
        $user->status = !$user->status; 
        $user->save(); 

        return redirect()->route('admin.panitias.dashboard')->with('success', 'Status akun berhasil diperbarui.');
    }

}
