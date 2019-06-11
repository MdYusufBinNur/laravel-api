<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\DbModels\Message::class, function (Faker $faker) {
    return [
        'propertyId' =>  App\DbModels\Property::all()->random()->id,
        'fromUserId' =>  App\DbModels\User::all()->random()->id,
        'toUserId' =>  App\DbModels\User::all()->random()->id,
        'subject' => $faker->title,
        'isGroupMessage' => $faker->boolean,
        'group' => $faker->title,
        'groupNames' => $faker->name,
        'emailNotification' => $faker->boolean,
        'smsNotification' => $faker->boolean,
        'voiceNotification' => $faker->boolean,
    ];
});
