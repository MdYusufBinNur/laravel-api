<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\DbModels\Announcement::class, function (Faker $faker) {
    return [
        'propertyId' =>  App\DbModels\Property::all()->random()->id,
        'title' => $faker->name,
        'content' => $faker->sentence,
        'link' => $faker->url,
        'linkinNewWindows' => $faker->boolean,
        'showOnWebsite' => $faker->boolean,
        'showOnLds' => $faker->boolean,
        'expireAt' => $faker->dateTime,
    ];
});
