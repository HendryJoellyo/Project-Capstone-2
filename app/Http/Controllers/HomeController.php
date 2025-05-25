<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Support\Carbon;
use App\Models\EventRegistration;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
{
    $startDate = Carbon::now()->startOfDay();
    $endDate = (clone $startDate)->addDays(6)->endOfDay();

    $eventsInWeek = Event::whereBetween('tanggal', [$startDate, $endDate])
        ->orderBy('tanggal')
        ->get();

    foreach ($eventsInWeek as $event) {
        // Hitung jumlah peserta yang sudah verified bayar
        $registrasi_terverifikasi = EventRegistration::where('id_events', $event->id_events)
            ->where('status_pembayaran', 'verified')
            ->count();

        // Simpan slot tersedia di property tambahan
        $event->slot_tersedia = $event->jumlah_peserta - $registrasi_terverifikasi;
    }

    $eventsByDate = $eventsInWeek->groupBy(function ($event) {
        return Carbon::parse($event->tanggal)->format('Y-m-d');
    });

    $registrations = [];
    if (Auth::check()) {
        $registrations = EventRegistration::where('id_users', Auth::id())
            ->pluck('status_pembayaran', 'id_events')
            ->toArray();
    }

    return view('index', [
        'eventsByDate' => $eventsByDate,
        'startDate' => $startDate,
        'endDate' => $endDate,
        'registrations' => $registrations,
    ]);
}


}
