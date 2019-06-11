<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\DbModels\Module::class, function (Faker $faker) {
    return [
        'key' => $faker->randomAscii,
        'title' => $faker->title,
    ];
});
