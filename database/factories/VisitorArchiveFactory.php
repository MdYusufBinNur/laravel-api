<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\DbModels\VisitorArchive::class, function (Faker $faker) {
    return [
        'visitorId' =>  App\DbModels\Visitor::all()->random()->id,
        'signOutUserId' =>  App\DbModels\User::all()->random()->id,
        'signature' => $faker->boolean,
        'signOutAt' => $faker->dateTime,
    ];
});
