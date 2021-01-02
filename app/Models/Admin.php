<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use Notifiable;

    protected $guard = 'admin';

    protected $fillable = [
        'is_super','name', 'email', 'password',
        'username', 'image', 'about',
        'device_id',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function conversations()
    {
        return $this->hasMany(Conversation::class, 'user_two');
    }
}
