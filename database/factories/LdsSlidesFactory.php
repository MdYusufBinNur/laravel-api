<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\DbModels\LdsSlide::class, function (Faker $faker) {
    return [
        'title' => $faker->title,
        'backgroundColor' => $faker->rgbColor,
        'imageId' => $faker->numberBetween(1,1000),
        'type' => $faker->randomElement(array('standard','custom')),
    ];
});
