<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\DbModels\EventSignup::class, function (Faker $faker) {
    return [
        'eventId' =>  App\DbModels\Event::all()->random()->id,
        'userId' =>  App\DbModels\User::all()->random()->id,
        'residentId' =>  App\DbModels\Resident::all()->random()->id,
        'guests' => $faker->numberBetween(20,5000),
    ];
});
