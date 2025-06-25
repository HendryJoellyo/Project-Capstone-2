<?php

namespace App\Http\Controllers\Pembayaran;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use Midtrans\Snap;
use Midtrans\Config;

class PaymentController extends Controller
{
   public function processPayment(Request $request)
{
    Config::$serverKey = config('midtrans.server_key');
    Config::$isProduction = config('midtrans.is_production');
    Config::$isSanitized = config('midtrans.is_sanitized');
    Config::$is3ds = config('midtrans.is_3ds');

    $eventId = $request->input('event_id');

    $event = Event::findOrFail($eventId);

    $params = [
        'transaction_details' => [
            'order_id' => uniqid(),
            'gross_amount' => (int) $event->biaya_registrasi,
        ],
        'customer_details' => [
            'first_name' => auth()->user()->nama,
            'email' => auth()->user()->email,
        ],
        'item_details' => [
            [
                'id' => $event->id_events,
                'price' => (int) $event->biaya_registrasi,
                'quantity' => 1,
                'name' => $event->nama_event
            ]
        ]
    ];

    $snapToken = Snap::getSnapToken($params);

    return response()->json(['token' => $snapToken]);
}

}
