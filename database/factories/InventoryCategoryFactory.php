<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\DbModels\InventoryCategory::class, function (Faker $faker) {
    return [
        'title' => $faker->randomElement(array('title1','title2','title3')),
        'propertyId' =>  App\DbModels\Property::all()->random()->id,
    ];
});
