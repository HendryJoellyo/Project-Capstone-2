<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PanitiaEvent extends Model
{
    protected $table = 'panitia_event';
    protected $primaryKey = 'id';

    protected $fillable = [
     'nama', 'nomor_hp', 'email', 'password'
    ];

    
}
