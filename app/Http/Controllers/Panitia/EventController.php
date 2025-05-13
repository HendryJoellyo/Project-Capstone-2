<?php

namespace App\Http\Controllers\Panitia;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;

class EventController extends Controller
{
   public function index()
    {
        $events = Event::all();
        return view('panitia.dashboard', compact('events'));
    }

    public function create()
    {
        return view('panitia.events.create');
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_event' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'waktu' => 'required',
            'lokasi' => 'required|string|max:255',
            'narasumber' => 'required|string|max:255',
            'poster' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'biaya_registrasi' => 'required|numeric',
            'jumlah_peserta' => 'required|integer',
        ]);

        // Simpan poster
        $posterPath = $request->file('poster')->store('posters', 'public');

        // Simpan event
        Event::create(array_merge($validated, ['poster' => $posterPath]));

        return redirect()->route('panitia.events.index')->with('success', 'Event berhasil ditambahkan!');
    }
}
