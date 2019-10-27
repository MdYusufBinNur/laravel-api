<?php

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

Broadcast::channel('USER.{userId}', function ($user, $userId) {
    return $user->id == (int) $userId;
});

Broadcast::channel('ADMIN.{userId}', function ($user, $userId) {
    return $user->isAdmin();
});

Broadcast::channel('PROPERTY.{propertyId}', function ($user, $propertyId) {
    return $user->userOfTheProperty($propertyId);
});

Broadcast::channel('PROPERTY.STAFF.{propertyId}', function ($user, $propertyId) {
    return $user->isAStaffOfTheProperty($propertyId);
});






