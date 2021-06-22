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
    public $targetUser;
    public $senderUser;
    //public $targetTmp;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $targetUser, User $senderUser)
    {
        //$this->totalMessage = $totalMessage;
        //$this->targetId = $targetId;
        $this->targetUser = $targetUser->id;
        $this->senderUser = $senderUser->id;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('notificat.'.$this->targetUser);
    }

    public function broadcastAs(){
        return 'notif';
    }
}
