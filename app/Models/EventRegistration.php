<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventRegistration extends Model
{
    protected $table = 'event_registrations';
    protected $primaryKey = 'id_event_registrations';

    protected $fillable = [
    'id_users', 'id_events', 'status_pembayaran',
    'bukti_pembayaran', 'transaction_id', 'created_at', 'updated_at'
];

    


    public function event()
{
    return $this->belongsTo(Event::class, 'id_events', 'id_events');
}

public function user()
{
    return $this->belongsTo(User::class, 'id_users', 'id_users');
}


}
