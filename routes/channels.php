<?php

use Illuminate\Support\Facades\Broadcast;
/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});
Broadcast::channel('Online', function ($user) {
    return $user;
});

//Comment
Broadcast::channel('Comment.{user}', function ($user) {
    return $user->id;
});

Broadcast::channel('Chat.{user_id}.{friend_id}', function ($user, $user_id, $friend_id) {
    return $user->id == $friend_id;
});