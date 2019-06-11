<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\DbModels\UserProfilePost::class, function (Faker $faker) {
    return [
        'propertyId' => App\DbModels\Property::all()->random()->id,
        'byUserId' =>  App\DbModels\User::all()->random()->id,
        'toUserId' =>  App\DbModels\User::all()->random()->id,
        'text' => $faker->sentence,
        'active' => $faker->boolean,
    ];
});
