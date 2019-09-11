<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\DbModels\PropertySocialMedia::class, function (Faker $faker) {
    return [
        'propertyId' =>  App\DbModels\Property::all()->random()->id,
        'url' => $faker->url,
        'type' => $faker->randomElement(array('facebook','twitter','other', 'quara', 'instagram')),
    ];
});
