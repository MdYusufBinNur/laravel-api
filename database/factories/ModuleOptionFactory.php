<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\DbModels\ModuleOption::class, function (Faker $faker) {
    return [
        'moduleId' =>  App\DbModels\Module::all()->random()->id,
        'key' => $faker->randomAscii,
        'title' => $faker->title,
    ];
});
