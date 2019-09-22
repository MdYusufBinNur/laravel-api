<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\DbModels\Post::class, function (Faker $faker) {
    return [

        'propertyId' =>  App\DbModels\Property::all()->random()->id,
        'deletedUserId' =>  App\DbModels\User::all()->random()->id,
        'type' => $faker->randomElement(array('marketplace','wall','event','recommend','poll')),
        'status' => $faker->randomElement(array('posted','pending','approved','denied')),
        'likeCount' => $faker->numberBetween(0,10000),
        'likeUsers' => '',
        'attachment' => $faker->boolean,
    ];
});
