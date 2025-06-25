<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Keuangan;
use App\Models\User;


class KeuanganController extends Controller
{
    public function dashboard()
    {
        $keuangans = Keuangan::all();
        return view('admin.TKeuangan.dashboard', compact('keuangans'));
    }

    public function create()
    {
        return view('admin.TKeuangan.create');
    }

    public function store(Request $request)
{
    $request->validate([
        'nama'      => 'required|string|max:100',
        'nomor_hp'  => 'required|string|max:20',
        'email'     => 'required|email|max:100|unique:users,email|unique:tim_keuangan,email',
        'password'  => 'required|string|max:100',
    ]);

    // hash password
    $hashedPassword = Hash::make($request->password);

    // simpan ke tabel tim_keuangan
    Keuangan::create([
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
        'id_roles'  => 2, // Panitia_Keuangan
    ]);

    return redirect()->route('admin.keuangans.dashboard')->with('success', 'Data berhasil ditambahkan.');
}


    public function edit($id)
    {
        $keuangan = Keuangan::findOrFail($id);
        return view('admin.TKeuangan.edit', compact('keuangan'));
    }

    public function update(Request $request, $id)
{
    $request->validate([
        'nama'      => 'required|string|max:100',
        'nomor_hp'  => 'required|string|max:20',
        'email'     => 'required|email|max:100',
        'password'  => 'nullable|string|max:100',
    ]);

    $keuangan = Keuangan::findOrFail($id);

    $data = [
        'nama'      => $request->nama,
        'nomor_hp'  => $request->nomor_hp,
        'email'     => $request->email,
    ];

    if ($request->filled('password')) {
        $data['password'] = Hash::make($request->password);
    }

    // update keuangan
    $keuangan->update($data);

    // cari user dengan email lama
    $user = User::where('email', $keuangan->email)->first();

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

    return redirect()->route('admin.keuangans.dashboard')->with('success', 'Data berhasil diperbarui.');
}


    public function destroy($id)
{
    $keuangan = Keuangan::findOrFail($id);

    // cari user berdasarkan email
    $user = User::where('email', $keuangan->email)->first();

    // hapus keuangan
    $keuangan->delete();

    // hapus user kalau ada
    if ($user) {
        $user->delete();
    }

    return redirect()->route('admin.keuangans.dashboard')->with('success', 'Data berhasil dihapus.');
}

public function toggleStatus($id)
{
    $user = User::findOrFail($id);
    $user->status = !$user->status;
    $user->save();

    return redirect()->route('admin.keuangans.dashboard')->with('success', 'Status akun berhasil diperbarui.');
}


}
