<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;

class RoleController extends Controller
{
    // Menampilkan semua role
    public function dashboard()
    {
        $roles = Role::all();
        return view('admin.dashboard', compact('roles'));
    }

    // Form tambah role
    public function create()
    {
        return view('admin.create');
    }

    // Simpan role baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_role' => 'required|string|max:45',
        ]);

        Role::create([
            'nama_role' => $request->nama_role,
        ]);

        return redirect()->route('admin.roles.dashboard')->with('success', 'Role berhasil ditambahkan.');
    }

    // Form edit role
    public function edit(Role $role)
{
    return view('admin.roles.edit', compact('role'));
}

public function update(Request $request, Role $role)
{
    $request->validate([
        'nama_role' => 'required|string|max:45',
    ]);

    $role->update([
        'nama_role' => $request->nama_role,
    ]);

    return redirect()->route('admin.roles.dashboard')->with('success', 'Role berhasil diperbarui.');
}

public function destroy(Role $role)
{
    $role->delete();

    return redirect()->route('admin.roles.dashboard')->with('success', 'Role berhasil dihapus.');
}

}
