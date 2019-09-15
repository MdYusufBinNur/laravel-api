<?php
/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\DbModels\Property;
use Faker\Generator as Faker;

$factory->define(App\DbModels\FdiGuestType::class, function (Faker $faker) {
    return [
        'propertyId' =>  App\DbModels\Property::all()->random()->id,
        'title' => $faker->randomElement(array('guest','family','contractor')),
    ];
});
