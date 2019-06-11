<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\DbModels\ServiceRequestLog::class, function (Faker $faker) {
    return [
        'serviceRequestId' =>  App\DbModels\ServiceRequest::all()->random()->id,
        'userId' =>  App\DbModels\User::all()->random()->id,
        'type' => $faker->randomElement(array('status','comment','feedback','assignment')),
        'feedback' => $faker->randomElement(array('none','positive','negative')),
        'status' => $faker->boolean,
    ];
});
