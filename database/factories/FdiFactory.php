<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\DbModels\Unit;
use Faker\Generator as Faker;

$factory->define(App\DbModels\Fdi::class, function (Faker $faker) {
    return [
        'propertyId' =>  App\DbModels\Property::all()->random()->id,
        'unitId' =>  App\DbModels\Unit::all()->random()->id,
        'guestTypeId' =>  App\DbModels\FdiGuestType::all()->random()->id,
        'name' => $faker->name,
        'type' => $faker->randomElement(array('guest','mail','general')),
        'photo' => $faker->boolean,
        'startDate' => $faker->dateTime,
        'endDate' => $faker->dateTime,
        'permanent' => $faker->boolean,
        'comments' => $faker->sentence,
        'canGetKey' => $faker->boolean,
        'signature' => $faker->boolean,
        'status' => $faker->randomElement(array('active','deleted','pendingApproval')),
    ];
});
