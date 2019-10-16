<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\DbModels\ParkingPass::class, function (Faker $faker) {
    return [
        'unitId' =>  App\DbModels\Unit::all()->random()->id,
        'make' => $faker->randomKey(),
        'model' => $faker->randomKey(),
        'licensePlate' => $faker->phoneNumber,
        'startAt' => $faker->dateTime,
        'endAt' => $faker->dateTime,
        'releasedAt' => $faker->dateTime,
    ];
});
