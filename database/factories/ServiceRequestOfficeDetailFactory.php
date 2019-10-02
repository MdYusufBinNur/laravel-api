<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\DbModels\ServiceRequestOfficeDetail::class, function (Faker $faker) {
    return [
        'serviceRequestId' =>  App\DbModels\ServiceRequest::all()->random()->id,
        'assignedUserId' =>  App\DbModels\User::all()->random()->id,
        'materialUsed' => $faker->sentence,
        'materialAmount' => $faker->numberBetween(1,100),
        'handyman' => $faker->name,
        'outsideContractor' => $faker->boolean,
        'partsNeeded' => $faker->word,
        'comment' => $faker->sentence,
        'temporarilyRepaired' => $faker->boolean,
        'signature' => $faker->boolean,
    ];
});
