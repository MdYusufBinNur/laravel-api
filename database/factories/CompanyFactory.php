<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\DbModels\Company::class, function (Faker $faker) {
    return [
        'title' => $faker->title,
        'address' => $faker->address,
        'city' => $faker->city,
        'state' => $faker->state,
        'postCode' => $faker->postcode,
        'country' => $faker->randomElement(array('BD','India','UK','USA','UAE','SL')),
        'active' => $faker->boolean,
    ];
});
