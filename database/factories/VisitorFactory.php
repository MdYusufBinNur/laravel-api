<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\DbModels\Visitor::class, function (Faker $faker) {
    return [
        'propertyId' => App\DbModels\Property::all()->random()->id,
        'signinUserId' => App\DbModels\User::all()->random()->id,
        'unitId' => App\DbModels\Unit::all()->random()->id,
        'visitorTypeId' =>  App\DbModels\VisitorType::all()->random()->id,
        'name' => $faker->name,
        'phone' => substr($faker->phoneNumber,0,20),
        'email' => $faker->email,
        'company' => $faker->company,
        'photo' => $faker->boolean,
        'permanent' => $faker->boolean,
        'comments' => $faker->sentence,
        'signature' => $faker->boolean,
        'status' => $faker->sentence,
        'signinAt' => $faker->dateTime,
    ];
});
