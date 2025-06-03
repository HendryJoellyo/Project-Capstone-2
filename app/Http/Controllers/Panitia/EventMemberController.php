<?php

namespace App\Http\Controllers\Panitia;

use App\Http\Controllers\Controller;
use App\Models\EventRegistration;
use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Support\Facades\Log;

class EventMemberController extends Controller
{
    public function index()
    {
        $events = Event::orderBy('tanggal', 'desc')->get();
        return view('panitia.event_member', compact('events'));
    }

    public function scan()
    {
        return view('panitia.events.scan_qr');
    }
    public function absenMember(Request $request)
    {
        $registration = EventRegistration::find($request->data);

        if (!$registration) {
            return response()->json([
                'status' => 'error',
                'message' => 'QR Code tidak valid!'
            ]);
        }

        $registration->update([
            'status_kehadiran' => 'hadir'
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Kehadiran berhasil dicatat.'
        ]);
    }

public function listMember($eventId)
{
    try {
        $members = EventRegistration::with('user')
                    ->where('id_events', $eventId)
                    ->orderBy('status_kehadiran', 'desc')
                    ->get();

        Log::info('Load members for event ID: ' . $eventId);
        Log::info('Jumlah data: ' . $members->count());
        Log::info('Data detail: ' . $members->toJson());

        return response()->json($members);
    } catch (\Exception $e) {
        Log::error('Error load member: ' . $e->getMessage());
        return response()->json(['error' => 'Gagal load data'], 500);
    }
}
public function history()
{
    $events = Event::orderBy('tanggal', 'desc')->get();
    return view('panitia.history', compact('events'));
}

}
