<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    protected $table = 'events';
    protected $primaryKey = 'id_events';

    protected $casts = [
    'tanggal' => 'date',
];


    protected $fillable = [
        'nama_event', 'tanggal', 'waktu_mulai', 'waktu_selesai', 'lokasi', 'narasumber',
        'poster', 'biaya_registrasi', 'jumlah_peserta',
        'created_at', 'updated_at'
    ];

    public function eventRegistrations()
    {
        return $this->hasMany(EventRegistration::class, 'id_events');
    }
}
