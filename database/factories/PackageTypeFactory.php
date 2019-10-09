<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\DbModels\PackageType::class, function (Faker $faker) {
    return [
        'propertyId' => App\DbModels\Property::all()->random()->id,
        'title' => $faker->title,
        'icon' => $faker->numberBetween(1,20),
    ];
});
