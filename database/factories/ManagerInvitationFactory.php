<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(App\DbModels\ManagerInvitation::class, function (Faker $faker) {
    return [
        'propertyId' =>  App\DbModels\Manager::all()->random()->id,
        'firstName' => $faker->firstName,
        'lastName' => $faker->lastName,
        'email' => $faker->email,
        'title' => $faker->title,
        'level' => $faker->randomElement(array('admin','standard','limited','restricted')),
        'status' => $faker->randomElement(array('active','cancelled','completed')),
        'pin' => Str::random(20),
        'invitedAt' => $faker->dateTime,
    ];
});
