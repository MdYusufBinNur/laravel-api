<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\DbModels\UserPropertyManager::class, function (Faker $faker) {
    return [
        'propertyId' => App\DbModels\Property::all()->random()->id,
        'userId' => App\DbModels\User::all()->random()->id,
        'role' => $faker->randomElement(['admin', 'manager', 'others']),
        'phone' => substr($faker->phoneNumber,0,20),
        'title' => $faker->jobTitle,
        'displayInCorner' => $faker->boolean,
        'displayPublicProfile' => $faker->boolean,
    ];
});
