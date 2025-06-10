<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'certificates';
    protected $fillable = [
        'event_registration_id', 'file_path', 'created_at', 'updated_at'
    ];
    public $timestamps = false;
    public function eventRegistration()
    {
        return $this->belongsTo(EventRegistration::class, 'event_registration_id', 'id_event_registrations');
    }
}
