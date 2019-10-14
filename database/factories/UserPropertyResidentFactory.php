<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\DbModels\UserPropertyResident::class, function (Faker $faker) {
    return [
        'propertyId' => App\DbModels\Property::all()->random()->id,
        'userId' => App\DbModels\User::all()->random()->id,
        'unitId' => App\DbModels\Unit::all()->random()->id,
        'role' => $faker->randomElement(['admin', 'manager', 'others']),
        'groups' => $faker->randomElement(['groupOne', 'groupTwo', 'groupThree']),
        'displayUnit' => $faker->boolean,
        'displayPublicProfile' => $faker->boolean,
        'allowPostNote' => $faker->boolean,
    ];
});
