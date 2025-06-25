<?php

namespace App\Http\Controllers\Panitia;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;

class DashboardPanitiaController extends Controller
{
    public function index()
    {
        $events = Event::all();
        return view('panitia.dashboard', compact('events'));
    }
}
