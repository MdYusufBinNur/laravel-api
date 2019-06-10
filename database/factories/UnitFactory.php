<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\DbModels\Unit::class, function (Faker $faker) {
    return [
        'towerId' => App\DbModels\Tower::all()->random()->id,
        'title' => $faker->title,
        'floor' => $faker->randomNumber(1,30),
        'line' => $faker->randomNumber(1,20),
    ];
});
