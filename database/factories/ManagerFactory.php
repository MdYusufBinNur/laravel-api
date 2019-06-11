<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\DbModels\Manager::class, function (Faker $faker) {

    return [
        'userId' =>  App\DbModels\User::all()->random()->id,
        'contactEmail' => $faker->email,
        'phone' => substr($faker->phoneNumber,0,20),
        'title' => $faker->title,
        'level' => $faker->randomElement(array('admin','standard','limited','restricted')),
        'displayInCorner' => $faker->boolean,
        'displayPublicProfile' => $faker->boolean,
    ];
});
