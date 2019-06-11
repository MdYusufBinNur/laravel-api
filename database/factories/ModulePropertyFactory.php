<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\DbModels\ModuleProperty::class, function (Faker $faker) {
    return [
        'propertyId' =>  App\DbModels\Property::all()->random()->id,
        'moduleId' =>  App\DbModels\Module::all()->random()->id,
        'value' => $faker->boolean,
    ];
});
