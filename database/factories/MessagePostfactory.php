<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\DbModels\MessagePost::class, function (Faker $faker) {
    return [
        'messageId' =>  App\DbModels\Message::all()->random()->id,
        'fromUserId' =>  App\DbModels\User::all()->random()->id,
        'text' => $faker->sentence,
    ];
});
