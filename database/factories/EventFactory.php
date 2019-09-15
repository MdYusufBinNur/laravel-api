<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\DbModels\Event::class, function (Faker $faker) {
    return [
        'propertyId' =>  App\DbModels\Property::all()->random()->id,
        'createdUserId' =>  App\DbModels\User::all()->random()->id,
        'title' => $faker->title,
        'text' => $faker->paragraph,
        'maxGuests' => $faker->numberBetween(20,5000),
        'allowedSignUp' => $faker->boolean,
        'alldayEvent' => $faker->boolean,
        'allowedLoginPage' => $faker->boolean,
        'hasAttachment' => $faker->boolean,
        'startAt' => $faker->time,
        'endAt' => $faker->time,
        'date' => $faker->dateTime,
    ];
});
