<?php

namespace App\Http\Controllers\Keuangan;

use App\Http\Controllers\Controller;
use App\Models\EventRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class DashboardKeuanganController extends Controller
{
        public function index()
    {
        $registrations = EventRegistration::with('user', 'event')->get();
        return view('keuangan.dashboard', compact('registrations'));

    }
    public function updateStatusPembayaran(Request $request)
    {
        Log::info('Request diterima:', $request->all());
        $request->validate([
           'id' => 'required|exists:event_registrations,id_event_registrations',
            'status' => 'required|in:verified,rejected'
        ]);

        $registration = EventRegistration::where('id_event_registrations', $request->id)->first();

        $registration->status_pembayaran = $request->status;
        $registration->save();

        return response()->json(['message' => 'Status pembayaran berhasil diupdate.']);
    }


}
