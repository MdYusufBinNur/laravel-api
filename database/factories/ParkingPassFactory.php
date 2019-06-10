<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\DbModels\ParkingPass::class, function (Faker $faker) {
    return [
        'propertyId' =>  App\DbModels\Property::all()->random()->id,
        'unitId' =>  App\DbModels\Unit::all()->random()->id,
        'submittedUserId' =>  App\DbModels\User::all()->random()->id,
        'voidedUserId' =>  App\DbModels\User::all()->random()->id,
        'number' => $faker->phoneNumber,
        'type' => $faker->randomElement(array('unit','office')),
        'status' => $faker->randomElement(array('active','voided')),
        'vehicleMake' => $faker->randomKey(),
        'vehicleModel' => $faker->randomKey(),
        'vehicleLicensePlate' => $faker->phoneNumber,
        'otherDetail' => '',
        'startAt' => $faker->dateTime,
        'endAt' => $faker->dateTime,
        'voidedAt' => $faker->dateTime,
    ];
});
