<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Support\Carbon;

class HomeController extends Controller
{
    public function index()
    {
        // Mulai dari hari ini (awal hari)
        $startDate = Carbon::now()->startOfDay();

        // Tambahkan 6 hari untuk rentang 7 hari total
        $endDate = (clone $startDate)->addDays(6)->endOfDay();

        // Ambil semua event dalam rentang 7 hari mulai dari hari ini
        $eventsInWeek = Event::whereBetween('tanggal', [$startDate, $endDate])
                             ->orderBy('tanggal')
                             ->get();

        // Group event berdasarkan tanggal (format Y-m-d)
        $eventsByDate = $eventsInWeek->groupBy(function ($event) {
            // Pastikan tanggal event sudah di-cast ke Carbon di model, 
            // jika tidak, parse manual: Carbon::parse($event->tanggal)
            return Carbon::parse($event->tanggal)->format('Y-m-d');
        });

        return view('index', [
            'eventsByDate' => $eventsByDate,
            'startDate' => $startDate,
            'endDate' => $endDate,
        ]);
    }
}
