<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\DbModels\ServiceRequestCategory::class, function (Faker $faker) {
    return [
        'propertyId' =>  App\DbModels\Property::all()->random()->id,
        'parentId' =>  App\DbModels\ServiceRequestCategory::all()->random()->id ? : 1,
        'title' => $faker->title,
        'type' => $faker->randomElement(array('unit','commonArea')),
        'active' => $faker->boolean,
    ];
});
