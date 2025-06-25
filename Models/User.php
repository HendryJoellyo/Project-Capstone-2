<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';
    protected $primaryKey = 'id_users';

    protected $fillable = [
        'nama', 'email', 'password', 'id_roles', 'created_at', 'updated_at', 'status'
    ];

    protected $hidden = [
        'password',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class, 'id_roles');
    }

    public function eventRegistrations()
    {
        return $this->hasMany(EventRegistration::class, 'id_users');
    }

    public function getAuthIdentifier()
{
    return $this->getKey();
}

}
