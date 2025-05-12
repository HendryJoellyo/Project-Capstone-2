<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = 'events';
    protected $primaryKey = 'id_events';

    protected $fillable = [
        'nama_event', 'tanggal', 'waktu', 'lokasi', 'narasumber',
        'poster', 'biaya_registrasi', 'jumlah_peserta',
        'created_at', 'updated_at'
    ];

    public function eventRegistrations()
    {
        return $this->hasMany(EventRegistration::class, 'id_events');
    }
}
