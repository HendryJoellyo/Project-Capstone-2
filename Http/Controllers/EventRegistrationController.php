<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EventRegistration;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class EventRegistrationController extends Controller
{
    
    // Daftar Event
    public function daftarEvent(Request $request)
    {
        Log::info('Mencoba mendaftar event.', ['user_id' => auth()->id(), 'event_id' => $request->event_id]); // Log awal
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

    $history = EventRegistration::with(['event', 'user'])
        ->where('id_users', $userId)
        ->orderBy('created_at', 'desc')
        ->get();

    return view('history', compact('history'));
}

public function generateQRCode($id)
{
    $registration = EventRegistration::with(['event', 'user'])->find($id);

    $text = $registration->id; // cukup kirim ID registrasinya aja

    $qrCode = QrCode::size(300)->generate($text);

    return view('qr_code_view', compact('qrCode'));
}





}
