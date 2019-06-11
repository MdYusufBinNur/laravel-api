<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\DbModels\ResidentArchive::class, function (Faker $faker) {
    return [
        'propertyId' =>  App\DbModels\Property::all()->random()->id,
        'residentId' =>  App\DbModels\Resident::all()->random()->id,
        'unitId' =>  App\DbModels\Unit::all()->random()->id,
        'startAt' => $faker->dateTime,
        'endAt' => $faker->dateTime,
    ];
});
