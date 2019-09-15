<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\DbModels\PackageArchive::class, function (Faker $faker) {
    return [
        'packageId' =>  App\DbModels\Package::all()->random()->id,
        'signOutUserId' =>  App\DbModels\User::all()->random()->id,
        'signOutComment' => $faker->sentence,
        'signature' => $faker->boolean,
        'signOutAt' => $faker->dateTime,
    ];
});
