<?php

namespace App\Services\LineMessageEvents;
 
use Storage;
use App\Models\User;
use App\Services\UserService;
use LINE\LINEBot;
use ReflectionException;

class UserFollowHandler implements BaseHandler
{
    /**
     * @throws ReflectionException
     */
    public function handle(LINEBot $bot, LINEBot\Event\BaseEvent $event)
    {
        $user = User::where('provider_id', $event->getUserId())->where('provider_name', 'line')->first();
        if (!$user) {
            $response = $bot->getProfile($event->getUserId());
            $data = $response->getJSONDecodedBody();
            $avatar = $data['pictureUrl'];
            $contents = file_get_contents($avatar);
            $name = substr($avatar, strrpos($avatar, '/') + 1);
            Storage::put('public/avatar/' . $name . '.jpg', $contents);
            $data['avatar'] = Storage::url('public/avatar/' . basename($name)) . '.jpg' ?? null ;
            User::create([
                'name' => $data['displayName'] ?? null,
                'line_id' => $data['userId'],
                'avatar' => $data['avatar'] ?? null,
                'active' => 1
            ]);
            logs()->debug("UserFollowHandler created: {$event->getUserId()}");
        } else {
            User::updateOrCreate(
                [
                    'id' => $user->id
                ],
                [
                    'active' => 1
                ]
            );
            logs()->debug("UserFollowHandler updated: {$event->getUserId()}");
        }

        $bot->replyText(
            $event->getReplyToken(),
            route('home')
        );
    }
}
