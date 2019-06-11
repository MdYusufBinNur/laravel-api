<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\DbModels\MessageUser::class, function (Faker $faker) {
    return [
        'messageId' =>  App\DbModels\Message::all()->random()->id,
        'userId' =>  App\DbModels\User::all()->random()->id,
        'folder' => $faker->randomElement(array('inbox','sent')),
        'isRead' => $faker->boolean,
    ];
});
