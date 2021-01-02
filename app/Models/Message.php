<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'message', 'file', 'read_at',
        'user_id', 'conversation_id', 'deleted_from_sender',
        'deleted_from_receiver',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function conversation()
    {
        return $this->belongsTo(Conversation::class);
    }

}
