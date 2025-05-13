<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Keuangan extends Model
{
    protected $table = 'tim_keuangan';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id_events', 'nama', 'nomor_hp', 'email', 'password'
    ];

    public function event()
    {
        return $this->belongsTo(Event::class, 'id_events');
    }
}
