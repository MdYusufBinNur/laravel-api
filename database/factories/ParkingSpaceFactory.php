<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\DbModels\ParkingSpace::class, function (Faker $faker) {
    return [
        'propertyId' =>  App\DbModels\Property::all()->random()->id,
        'parkingNumber' => $faker->randomNumber(3),
        'ownedBy' => $faker->name
    ];
});
