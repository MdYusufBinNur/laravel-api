<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(App\DbModels\Admin::class, function (Faker $faker) {
    return [
        'userId' =>App\DbModels\User::all()->random()->id,
        'level' => $faker->randomElement(array('admin','standard','limited')),
    ];
});
