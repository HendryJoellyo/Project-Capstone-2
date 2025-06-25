<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventRegistration extends Model
{
    protected $table = 'event_registrations';
    protected $primaryKey = 'id_event_registrations';

    protected $fillable = [
    'id_users',
    'id_events',
    'status_pembayaran',
    'status_kehadiran'
];

    


    public function event()
{
    return $this->belongsTo(Event::class, 'id_events', 'id_events');
}

public function user()
{
    return $this->belongsTo(User::class, 'id_users', 'id_users');
}

public function certificate()
{
    return $this->hasOne(Certificate::class, 'event_registration_id', 'id_event_registrations');
}



}
