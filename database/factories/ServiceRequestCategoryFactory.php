<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\DbModels\ServiceRequestCategory::class, function (Faker $faker) {
    return [
        'propertyId' =>  App\DbModels\Property::all()->random()->id,
        'parentId' =>  1,
        'type' => $faker->randomElement(array('unit','commonArea')),
        'title' => $faker->title,
        'active' => $faker->boolean,
    ];
});
