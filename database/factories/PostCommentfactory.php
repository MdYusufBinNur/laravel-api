<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\DbModels\PostComment::class, function (Faker $faker) {
    return [
        'postId' =>  App\DbModels\Post::all()->random()->id,
        'deletedUserId' =>  App\DbModels\User::all()->random()->id,
        'status' => $faker->randomElement(array('posted','pending','approved','denied')),
        'text' => $faker->sentence,
        'active' => $faker->boolean,
    ];
});
