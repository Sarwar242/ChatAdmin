<?php

namespace App\Listeners;

use App\Events\MessageSent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class MessageSentListener
{
    public function handle (MessageSent $event) {
        app('log')->info(json_encode([ 'MessageSent' => $event->message->toArray() ]));
    }
}
