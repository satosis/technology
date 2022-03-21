<?php

namespace App\Services;

use DB;
use Auth;
use Log;
use Config;
use App\Models\Chat;
use App\Models\User;
use Twilio\Rest\Client;
use Twilio\Jwt\AccessToken;
use Twilio\Jwt\Grants\ChatGrant;
use Twilio\Jwt\Grants\VideoGrant;

class TwilioServices
{ 
    public function list($room){
        $list = Chat::where('gate', 'twilio')->whereNotNull('chat')->where('room', $room)->get();
        return $list;
    }
    public function tokenVideo(){
        $accountSid     = \Config::get('env.twilio.account_sid');
        $apiKeySid      = \Config::get('env.twilio.api_key_sid');
        $apiKeySecret   = \Config::get('env.twilio.api_key_secret');

        $identity = uniqid();
        // Create an Access Token
        $token = new AccessToken(
            $accountSid,
            $apiKeySid,
            $apiKeySecret,
            3600,
            $identity,
        );

        // Grant access to Video
        $grant = new VideoGrant();
        $grant->setRoom('cool room');
        $token->addGrant($grant);

        // Serialize the token as a JWT
        return $token->toJWT();
    }
    public function tokenChat($request)
    {
        $token = new AccessToken(
            Config::get('env.twilio.account_sid'),
            Config::get('env.twilio.api_key_sid'),
            Config::get('env.twilio.api_key_secret'),
            3600,
            $request->email
        );

        $chatGrant = new ChatGrant();
        $chatGrant->setServiceSid(Config::get('env.twilio.service_id'));

        $token->addGrant($chatGrant);

        return response()->json([
            'token' => $token->toJWT()
        ]);
    }  
    public function chat($request, $id)
    {  
        $authUser = Auth::user();
        $otherUser = User::find($id);   
        $room = Chat::where('gate', 'twilio')
                    ->where(function ($query) use ($otherUser) {
                        $query->where('author', Auth::user()->email)->where('other', $otherUser->email);
                    })->orWhere(function ($query) use ($otherUser) {
                        $query->where('author', $otherUser->email)->where('other', Auth::user()->email);
                    })->first();    
        if(empty($room)){
            $twilio = new Client(Config::get('env.twilio.account_sid'), Config::get('env.twilio.account_token'));
            $channel = $twilio->conversations->v1->conversations 
            ->create([
                "uniqueName" => $authUser->id . '-' . $otherUser->id,
                "friendlyName" => $authUser->name . '-' . $otherUser->name
            ]);
            // add first user 
            $firstUser = $twilio->conversations->v1->conversations($channel->sid)
                        ->participants
                        ->create([
                                    "identity" => $authUser->email
                                ]
                        );

            // add second user 
            $secondUser = $twilio->conversations->v1->conversations($channel->sid)
            ->participants
            ->create([
                        "identity" => $otherUser->email
                    ]
            );
            $room = Chat::create([
                'author'    => $authUser->email, 
                'other'     => $otherUser->email,
                'room'      => $authUser->id.'-'.$otherUser->id, 
                'gate'      => 'twilio',
                'code'      => $channel->sid
            ]);
        }
        return $room;
    }
    public function webhook($request)
    {
        Log::info($request->all());
        $chat = Chat::where('code', $request['ConversationSid'])->first();
        if($request['Author'] == $chat->author)
            Chat::create([
                'author' => $chat->author,
                'other' => $chat->other,
                'chat' => $request['Body'],
                'type' => $request['Body'] ? 'text' : 'media',
                'room' => $chat->room,
                'gate' => $chat->gate,
                'code' => $chat->code,
            ]);
        else
            Chat::create([
                'author' => $chat->other,
                'other' => $chat->author,
                'chat' => $request['Body'] ?? $request['Media']['Sid'],
                'type' => $request['Body'] ? 'text' : 'media',
                'room' => $chat->room,
                'gate' => $chat->gate,
                'code' => $chat->code,
            ]);
        return 1;
    }
}
