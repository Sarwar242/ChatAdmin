<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $fillable = [
        'user_id', 'is_sent', 'is_userseen','is_adminseen','message'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

}
