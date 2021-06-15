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
use App\Models\Accounts;

class Notice implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    //public $totalMessage;
    //public $targetId;
    //public $targetUser;
    public $targetTmp;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Accounts $targetTmp)
    {
        //$this->totalMessage = $totalMessage;
        //$this->targetId = $targetId;
        $this->targetTmp = $targetTmp;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('notificat.'.$this->targetTmp->id);
    }

    public function broadcastAs(){
        return 'notif';
    }
}
