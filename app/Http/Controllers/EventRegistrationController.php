<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EventRegistration;
use Illuminate\Support\Carbon;

class EventRegistrationController extends Controller
{
    // Upload Bukti Pembayaran
   public function uploadBukti(Request $request)
{
    $request->validate([
        'event_id' => 'required|exists:events,id_events',
        'bukti_pembayaran' => 'required|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    $userId = auth()->user()->id_users;

    $registration = EventRegistration::where('id_users', $userId)
                        ->where('id_events', $request->event_id)
                        ->first();

    if (!$registration) {
        return response()->json(['success' => false, 'message' => 'Registrasi event tidak ditemukan.'], 404);
    }

    $file = $request->file('bukti_pembayaran');
    $filename = time() . '_' . $file->getClientOriginalName();
    $file->move(public_path('uploads/bukti_pembayaran'), $filename);

    $registration->update([
    'bukti_pembayaran'  => $filename,
    'status_pembayaran' => 'proses',
    'updated_at'        => now(),
]);


    return response()->json([
        'success' => true,
        'message' => 'Bukti pembayaran berhasil diupload!',
        'data'    => $registration
    ]);
}


    // Update Status Pembayaran (oleh keuangan)
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status_pembayaran' => 'required|in:pending,verified,rejected'
        ]);

        $registration = EventRegistration::findOrFail($id);

        $registration->update([
            'status_pembayaran' => $request->status_pembayaran,
            'updated_at'        => now(),
        ]);

        return back()->with('success', 'Status pembayaran berhasil diupdate!');
    }

    // Daftar Event
    public function daftarEvent(Request $request)
    {
    $request->validate([
        'event_id' => 'required|exists:events,id_events',
    ]);

    $userId = auth()->user()->id_users;

    // Cek apakah sudah pernah daftar
    $exists = EventRegistration::where('id_users', $userId)
                                ->where('id_events', $request->event_id)
                                ->first();

    if ($exists) {
        return response()->json(['error' => 'Kamu sudah mendaftar event ini!'], 409);
        }

    // Cek slot tersisa
    $event = \App\Models\Event::findOrFail($request->event_id);
    $jumlahTerdaftar = EventRegistration::where('id_events', $event->id_events)
                        ->where('status_pembayaran', 'verified')
                        ->count();

    if ($jumlahTerdaftar >= $event->jumlah_peserta) {
        return response()->json(['error' => 'Slot sudah habis.'], 409);
        }

    // Simpan registrasi baru
    $registration = EventRegistration::create([
        'id_users'           => $userId,
        'id_events'          => $request->event_id,
        'bukti_pembayaran'   => null,
        'status_pembayaran'  => 'pending',
        'created_at'         => now(),
        'updated_at'         => now(),
        ]);

    return response()->json([
        'success' => true,
        'message' => 'Registrasi berhasil disimpan.',
        'data'    => $registration
        ]);
    }
    public function history()
{
    $userId = auth()->user()->id_users;

    $history = EventRegistration::with('event')
        ->where('id_users', $userId)
        ->orderBy('created_at', 'desc')
        ->get();

    return view('history', compact('history'));
}



}
