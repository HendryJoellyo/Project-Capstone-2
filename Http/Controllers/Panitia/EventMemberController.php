<?php

namespace App\Http\Controllers\Panitia;

use App\Http\Controllers\Controller;
use App\Models\EventRegistration;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Certificate;
use Illuminate\Support\Facades\Auth;
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
        $members = EventRegistration::with(['user', 'certificate'])
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
    $history = EventRegistration::with('event')
                ->where('id_user', Auth::id())
                ->orderByDesc('created_at')
                ->get();

    return view('panitia.history', compact('history'));
}

public function uploadSertifikat(Request $request, $id_event_registration)
{
    \Log::info('Upload sertifikat dipanggil untuk ID: ' . $id_event_registration);

    $request->validate([
        'sertifikat' => 'required|mimes:pdf,jpg,jpeg,png|max:2048'
    ]);

    $file = $request->file('sertifikat');
    $fileName = time().'_'.$file->getClientOriginalName();
    $file->move(public_path('uploads/sertifikat'), $fileName);

    $certificate = Certificate::create([
        'event_registration_id' => $id_event_registration,
        'file_path' => 'uploads/sertifikat/'.$fileName
    ]);

    \Log::info('Certificate berhasil dibuat:', $certificate->toArray());

    return redirect()->back()->with('success', 'Sertifikat berhasil diupload!');
}


}
