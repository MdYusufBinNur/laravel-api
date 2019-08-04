<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(App\DbModels\ResidentAccessRequest::class, function (Faker $faker) {
    return [
        'propertyId' => App\DbModels\Property::all()->random()->id,
        'unitId' => App\DbModels\Unit::all()->random()->id,
        'name' => $faker->name,
        'email' => $faker->unique()->email,
        'type' => '',
        'pin' => Str::random(6),
        'groups' => '',
        'status' => $faker->randomElement(array('approved','denied','completed','pending')),
        'active' => $faker->boolean,
        'comments' => $faker->sentence,
        'moderatedUserId' => $faker->numberBetween(1,100),
        'moderatedAt' => $faker->dateTime,
        'movedinDate' => $faker->dateTime,
        'birthDate' => $faker->date(),
    ];
});
