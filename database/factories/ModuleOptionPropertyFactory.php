<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\DbModels\ModuleOptionProperty::class, function (Faker $faker) {
    return [
        'propertyId' =>  App\DbModels\Property::all()->random()->id,
        'moduleOptionId' =>  App\DbModels\ModuleOption::all()->random()->id,
        'value' => $faker->randomDigit,
    ];
});
