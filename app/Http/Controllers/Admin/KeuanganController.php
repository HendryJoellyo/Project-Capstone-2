<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Keuangan;

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
            'nama' => 'required|string|max:100',
            'nomor_hp' => 'required|string|max:20',
            'email' => 'required|email|max:100',
        ]);

        Keuangan::create($request->all());

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
        'nama' => 'required|string|max:100',
        'nomor_hp' => 'required|string|max:20',
        'email' => 'required|email|max:100',
    ]);

    $keuangan = Keuangan::findOrFail($id);
    $keuangan->update($request->all());

    return redirect()->route('admin.keuangans.dashboard')->with('success', 'Data berhasil diperbarui.');
}

public function destroy($id)
{
    $keuangan = Keuangan::findOrFail($id);
    $keuangan->delete();

    return redirect()->route('admin.keuangans.dashboard')->with('success', 'Data berhasil dihapus.');
}

}
