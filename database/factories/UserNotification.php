<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(App\DbModels\UserNotification::class, function (Faker $faker) {
    return [
        'toUserId' =>  App\DbModels\User::all()->random()->id,
        'fromUserId' =>  App\DbModels\User::all()->random()->id,
        'userNotificationTypeId' =>  App\DbModels\UserNotificationType::all()->random()->id,
        'resourceId' => null,
        'message' => $faker->sentence,
    ];
});
