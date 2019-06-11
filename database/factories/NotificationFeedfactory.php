<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\DbModels\NotificationFeed::class, function (Faker $faker) {
    return [
        'propertyId' =>  App\DbModels\Property::all()->random()->id,
        'userId' =>  App\DbModels\User::all()->random()->id,
        'name' => $faker->name,
        'content' => $faker->sentence,
        'isRead' => $faker->boolean,
        'isViewed' => $faker->boolean,
    ];
});
