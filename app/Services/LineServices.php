<?php

namespace App\Services;

use App\Exceptions\LineException;
use App\Services\LineMessageEvents\UserFollowHandler;
use App\Services\LineMessageEvents\UserUnFollowHandler;
use Config;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;
use LINE\LINEBot;
use LINE\LINEBot\HTTPClient\CurlHTTPClient;
use LINE\LINEBot\MessageBuilder\AudioMessageBuilder;
use LINE\LINEBot\MessageBuilder\ImageMessageBuilder;
use LINE\LINEBot\MessageBuilder\TextMessageBuilder;
use Log;

class LineServices
{
    /**
     * @var array
     */
    const LINE_ENDPOINTS = [
        'verify' => 'https://api.line.me/oauth2/v2.1/verify',
        'profile' => 'https://api.line.me/v2/profile',
        'friendship' => 'https://api.line.me/friendship/v1/status',
    ];
    /**
     * @var LineMessageService
     */
    private $lineMessageService;

    /**
     * @param LineMessageService $lineMessageService
     */
    public function __construct(LineMessageService $lineMessageService)
    {
        $this->lineMessageService = $lineMessageService;
    }

    /**
     * @param Request $request
     * @throws LineException
     */
    public function webhook(Request $request)
    {
        $this->lineMessageService->addEventHandler('follow', UserFollowHandler::class);
        $this->lineMessageService->addEventHandler('unfollow', UserUnFollowHandler::class);
        $this->lineMessageService->handle($request);
    }

    /**
     * Make sample LINE account
     *
     * @param $idToken
     * @return array
     * @throws LineException
     */
    public function getLineInfoByIdToken($idToken)
    {
        $response = Http::asForm()->post(self::LINE_ENDPOINTS['verify'], [
            'id_token' => $idToken,
            'client_id' => config('line.liff_channel_id'),
        ]);

        if ($response->status() !== Response::HTTP_OK) {
            return [
                'error' => json_decode($response->body())->error,
                'status' => Response::HTTP_UNAUTHORIZED
            ];
            // throw new LineException($response->body());
        }

        $data = $response->json();
        return [
            'name' => $data['name'],
            'email' => $data['email'] ?? null,
            'avatar' => $data['picture'] ?? null,
            'line_id' => $data['sub'],
            'status' => Response::HTTP_OK
        ];
    }

    public function checkFriendByAccessToken($accessToken)
    {
        $friendship = Http::withToken($accessToken)->get(self::LINE_ENDPOINTS['friendship']);
        if ($friendship['friendFlag'] === false) {
            return [
                'error' => __('messages.friend_not_found'),
                'status' => Response::HTTP_FORBIDDEN
            ];
        }
        return [
            'status' => Response::HTTP_OK
        ];
    }

    /**
     * @param $accessToken
     * @return array
     * @throws LineException
     */
    public function getLineInfoByAccessToken($accessToken)
    {
        $response = Http::get(self::LINE_ENDPOINTS['verify'], [
            'access_token' => $accessToken,
        ]);

        if ($response->status() !== Response::HTTP_OK) {
            return [
                'error' => json_decode($response->body())->error,
                'status' => Response::HTTP_UNAUTHORIZED
            ];
        }

        $data = $response->json();
        if ($data['client_id'] == config('line.liff_channel_id') && $data['expires_in'] > 0) {
            $response = Http::withToken($accessToken)->get(self::LINE_ENDPOINTS['profile']);

            $data = $response->json();
            return [
                'userId' => $data['userId'],
                'displayName' => $data['displayName'],
                'pictureUrl' => $data['pictureUrl'] ?? null,
            ];
        }

        throw new LineException("AccessToken invalid");
    }

    public function sendMessage($chat, $user)
    {
        $httpClient = new CurlHTTPClient(config('line.channel_token'));
        $bot = new LINEBot($httpClient, ['channelSecret' => config('line.channel_secret')]);
        $file = Config::get('env.app_url') . $chat->body;
        if ($chat->type == 'text') {
            $textMessageBuilder = new TextMessageBuilder($chat->body);
        } else if ($chat->type == 'image') {
            $textMessageBuilder = new ImageMessageBuilder($file, $file);
        } else {
            $textMessageBuilder = new AudioMessageBuilder($file, 1000);
        }
        $response = $bot->pushMessage($user->line_id, $textMessageBuilder);
        Log::channel('line')->info($response->getHTTPStatus() . ' ' . $response->getRawBody());
    }
}
