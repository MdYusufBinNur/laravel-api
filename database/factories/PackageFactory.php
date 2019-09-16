<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\DbModels\Package::class, function (Faker $faker) {
    return [
        'propertyId' =>  App\DbModels\Property::all()->random()->id,
        'unitId' =>  App\DbModels\Unit::all()->random()->id,
        'residentId' =>  App\DbModels\User::all()->random()->id,
        'typeId' =>  App\DbModels\PackageType::all()->random()->id,
        'enteredUserId' =>  App\DbModels\User::all()->random()->id,
        'trackingNumber' => $faker->randomAscii,
        'comment' => $faker->sentence,
        'notifiedByEmail' => $faker->boolean,
        'notifiedByText' => $faker->boolean,
        'notifiedByVoice' => $faker->boolean,
    ];
});
