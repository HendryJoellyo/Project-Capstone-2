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

        $file = $request->file('bukti_pembayaran');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('uploads/bukti_pembayaran'), $filename);

        EventRegistration::create([
            'id_users'         => auth()->user()->id_users,  // disesuaikan ke id_members
            'id_events'          => $request->event_id,
            'bukti_pembayaran'   => $filename,
            'status_pembayaran'  => 'pending',
            'created_at'         => Carbon::now(),
            'updated_at'         => Carbon::now(),
        ]);

        return back()->with('success', 'Bukti pembayaran berhasil diupload!');
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
            'updated_at'        => Carbon::now(),
        ]);

        return back()->with('success', 'Status pembayaran berhasil diupdate!');
    }

   public function daftarEvent(Request $request)
{
    // ambil data dari JSON body
    $data = $request->json()->all();

    // Validasi
    $validator = \Validator::make($data, [
        'event_id' => 'required|exists:events,id_events',
    ]);

    if ($validator->fails()) {
        return response()->json(['error' => $validator->errors()], 422);
    }

    // Cek duplikasi pendaftaran
    $exists = EventRegistration::where('id_users', auth()->user()->id_users)
                                ->where('id_events', $data['event_id'])
                                ->first();

    if ($exists) {
        return response()->json(['error' => 'Kamu sudah mendaftar event ini!'], 409);
    }

    // Simpan registrasi
    $registration = EventRegistration::create([
        'id_users'           => auth()->user()->id_users,
        'id_events'          => $data['event_id'],
        'bukti_pembayaran'   => '', // kosong dulu
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




}
