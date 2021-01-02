<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;
use App\Models\Admin;
use App\Models\Message;

class MessageToAdmin implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;

    public function __construct(Admin $admin, Message $message)
    {
        $this->admin = $admin;
        $this->message = $message;
    }


    public function broadcastOn()
    {
        \Log::info('broadcasting MessagePosted');
        return new PrivateChannel('chat-admin');
    }
}
