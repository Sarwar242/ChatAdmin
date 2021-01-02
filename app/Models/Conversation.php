<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    protected $fillable = [
        'user_one', 'user_two', 'status',
    ];

    public function admin()
    {
        return $this->belongsTo(Admin::class,'user_two');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_one');
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}
