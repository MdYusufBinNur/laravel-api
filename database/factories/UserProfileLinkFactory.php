<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\DbModels\UserProfileLink::class, function (Faker $faker) {
    return [
        'userId' => App\DbModels\User::all()->random()->id,
        'title' => $faker->title,
        'url' => $faker->url,
        'type' => $faker->randomElement(array('website','company','facebook','liknkedin','myspace','other')),
    ];
});
