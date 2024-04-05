<?php

namespace App\Services\LineMessageEvents;

use App\Models\User;
use LINE\LINEBot;

class UserUnFollowHandler implements BaseHandler
{
    public function handle(LINEBot $bot, LINEBot\Event\BaseEvent $event)
    {
        User::updateOrCreate(
            [
                'provider_id' =>  $event->getUserId(),
                'provider_name' => 'line',
            ],
            [
                'active' => 0
            ]
        );
        logs()->debug("UserUnFollowHandler updated: {$event->getUserId()}");
    }
}
