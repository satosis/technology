<?php

namespace App\Services\LineMessageEvents;

use LINE\LINEBot;

interface BaseHandler
{
    public function handle(LINEBot $bot, LINEBot\Event\BaseEvent $event);
}
