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

Broadcast::channel('chat.{user}', function ($user) {
    return true;
});
Broadcast::channel('sent.{user}', function ($user) {
    return true;
});

Broadcast::channel('user-verified', function ($user, $id) {
    return true;
});

Broadcast::channel('user-paid', function ($user, $id) {
    return true;
});