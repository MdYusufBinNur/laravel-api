<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\DbModels\ServiceRequestOfficeDetail::class, function (Faker $faker) {
    return [
        'serviceRequestId' =>  App\DbModels\ServiceRequest::all()->random()->id,
        'assignedUserId' =>  App\DbModels\User::all()->random()->id,
        'materialUsed' => $faker->word,
        'materialAmount' => $faker->randomNumber(1,20),
        'handyman' => $faker->name,
        'outsideContactor' => $faker->boolean,
        'partsNeeded' => $faker->words,
        'comments' => $faker->sentence,
        'temporarilyRepaired' => $faker->boolean,
        'signature' => $faker->boolean,
    ];
});
