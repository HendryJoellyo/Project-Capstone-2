<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EventRegistration;
use Illuminate\Support\Facades\Auth;

class HistoryController extends Controller
{
    public function getNotifCount()
{
    $userId = auth()->user()->id_users;

    $count = EventRegistration::where('id_users', $userId)
                ->where('status_pembayaran', 'pending')
                ->count();

    return response()->json(['count' => $count]);
}

}
