<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(Model::class, function (Faker $faker) {
    return [
        'residentId' => App\DbModels\Unit::all()->random()->id,
        'make' => '',
        'model' => $faker->numberBetween(1990,2050),
        'color' => $faker->randomElement(array('black','white','grey','blue','silver','red')),
        'licensePlate' => $faker->randomAscii,
    ];
});
