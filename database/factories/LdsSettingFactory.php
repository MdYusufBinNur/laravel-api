<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\DbModels\LdsSetting::class, function (Faker $faker) {
    return [
        'propertyId' =>  App\DbModels\Property::all()->random()->id,
        'refreshRate' => $faker->name,
        'showPackages' => $faker->boolean,
        'iconSize' => $faker->randomElement(array('small','large')),
        'iconColor' => $faker->randomElement(array('white','color')),
        'theme' => $faker->randomElement(array('classic','traditional','black-tie')),
    ];
});
