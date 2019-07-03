<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\DbModels\Unit::class, function (Faker $faker) {
    return [
        'towerId' => App\DbModels\Tower::all()->random()->id,
        'propertyId' => App\DbModels\Property::all()->random()->id,
        'title' => $faker->title,
        'floor' => $faker->numberBetween(1,30),
        'line' => $faker->numberBetween(1,20),
    ];
});
