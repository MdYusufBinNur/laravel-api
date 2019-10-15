<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\DbModels\ParkingPassLog::class, function (Faker $faker) {
    return [
        'propertyId' =>  App\DbModels\Property::all()->random()->id,
        'spaceId' =>  App\DbModels\ParkingSpace::all()->random()->id,
        'make' => $faker->randomKey(),
        'model' => $faker->randomKey(),
        'licensePlate' => $faker->randomNumber(6),
        'startAt' => $faker->dateTime,
        'endAt' => $faker->dateTime,
    ];
});
