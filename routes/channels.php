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

Broadcast::channel('App.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('room{id}', function ($user) {    
    return $user;
});

Broadcast::channel('internal{mid}', function ($user) {    
    return $user;
});

Broadcast::channel('call{id}', function ($user) {    
    return $user;
});

Broadcast::channel('internalcall{id}', function ($user) {    
    return $user;
});


Broadcast::channel('group{id}', function ($user) {    
    return $user;
});
