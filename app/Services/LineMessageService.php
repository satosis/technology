<?php

namespace App\Services;

use App\Exceptions\LineException;
use App\Services\LineMessageEvents\BaseHandler;
use Illuminate\Http\Request;
use LINE\LINEBot;

class LineMessageService
{
    /**
     * @var LINEBot
     */
    private $lineBot;

    /**
     * @var array
     */
    private $eventHandlers = [];

    public function __construct()
    {
        $channelSecret = config('line.channel_secret');
        $channelToken = config('line.channel_token');
        $this->lineBot = new LINEBot(new LINEBot\HTTPClient\CurlHTTPClient($channelToken), [
            'channelSecret' => $channelSecret,
        ]);
    }

    /**
     * @param Request $request
     * @throws LineException
     */
    public function handle(Request $request)
    {
        $signature = $request->header(LINEBot\Constant\HTTPHeader::LINE_SIGNATURE);
        if (empty($signature)) {
            throw new LineException('Bad Request', 400);
        }

        try {
            $this->handleEvents($this->getBot()->parseEventRequest($request->getContent(), $signature));
        } catch (LINEBot\Exception\InvalidSignatureException|LINEBot\Exception\InvalidEventRequestException $e) {
            throw new LineException($e->getMessage(), 400);
        }
    }

    /**
     * @param array $events
     */
    private function handleEvents(array $events)
    {
        foreach ($events as $event) {
            if ($event instanceof LINEBot\Event\FollowEvent && isset($this->eventHandlers['follow'])) {
                $this->createEventHandler('follow', $event);
            } elseif ($event instanceof LINEBot\Event\UnfollowEvent && isset($this->eventHandlers['unfollow'])) {
                $this->createEventHandler('unfollow', $event);
            } elseif ($event instanceof LINEBot\Event\MessageEvent\TextMessage && isset($this->eventHandlers['message'])) {
                $this->createEventHandler('message', $event);
            }
        }
    }

    /**
     * @param string $eventName
     * @param LINEBot\Event\BaseEvent $event
     */
    private function createEventHandler(string $eventName, LINEBot\Event\BaseEvent $event)
    {
        $eventHandler = new $this->eventHandlers[$eventName];
        if ($eventHandler instanceof BaseHandler) {
            logs()->debug(
                "[LINE message] Event: " . $event->getType() . " - UserId: " . $event->getUserId()
            );
            $eventHandler->handle($this->getBot(), $event);
        }
    }

    /**
     * @return LINEBot
     */
    public function getBot()
    {
        return $this->lineBot;
    }

    /**
     * @param string $eventName
     * @param string $event
     */
    public function addEventHandler(string $eventName, string $event)
    {
        $this->eventHandlers[$eventName] = $event;
    }
}
