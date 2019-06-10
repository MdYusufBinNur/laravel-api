<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\DbModels\UserProfileChild::class, function (Faker $faker) {
    return [
        'userId' =>  App\DbModels\User::all()->random()->id,
        'gender' => $faker->randomElement(array('male','female')),
        'name' => $faker->name,
        'age' => $faker->numberBetween(10,120),
    ];
});
