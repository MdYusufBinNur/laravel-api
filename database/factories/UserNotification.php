<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(App\DbModels\UserNotification::class, function (Faker $faker) {
    return [
        'toUserId' =>  1,
        'fromUserId' =>  App\DbModels\User::all()->random()->id,
        'userNotificationTypeId' =>  App\DbModels\UserNotificationType::all()->random()->id,
        'resourceId' => 1,
        'message' => $faker->sentence,
    ];
});
