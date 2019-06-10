<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\DbModels\PackageArchive::class, function (Faker $faker) {
    return [
        'packageId' =>  App\DbModels\Package::all()->random()->id,
        'signoutUserId' =>  App\DbModels\User::all()->random()->id,
        'signoutComments' => $faker->sentence,
        'signature' => $faker->boolean,
        'signoutAt' => $faker->dateTime,
    ];
});
