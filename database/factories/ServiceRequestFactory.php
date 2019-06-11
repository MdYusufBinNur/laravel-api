<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\DbModels\ServiceRequest::class, function (Faker $faker) {
    return [
        'userId' =>  App\DbModels\User::all()->random()->id,
        'unitId' =>  App\DbModels\Unit::all()->random()->id,
        'categoryId' =>  App\DbModels\ServiceRequestCategory::all()->random()->id,
        'statusId' =>  App\DbModels\ServiceRequestStatus::all()->random()->id,
        'type' => $faker->randomElement(array('unit','commonArea','equipment')),
        'phone' =>  substr($faker->phoneNumber,0,20),
        'description' => $faker->sentence,
        'permissionToEnter' => $faker->boolean,
        'prefferedStartTime' => $faker->time(),
        'prefferedEndTime' => $faker->time(),
        'feedback' => $faker->randomElement(array('none','positive','negative')),
        'photo' => $faker->boolean,
        'resolvedAt' => $faker->dateTime,
    ];
});
