<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\DbModels\ManagerProperty::class, function (Faker $faker) {
    return [
        'managerId' =>  App\DbModels\Manager::all()->random()->id,
        'propertyId' =>  App\DbModels\Property::all()->random()->id,
        'active' => $faker->boolean,
    ];
});
