<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\DbModels\VisitorType::class, function (Faker $faker) {
    return [
        'title' => $faker->randomElement(array('guest','doctor','Engineer','electrician','other')),
        'propertyId' =>  App\DbModels\Property::all()->random()->id,
    ];
});
