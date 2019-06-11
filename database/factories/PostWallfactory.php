<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\DbModels\PostWall::class, function (Faker $faker) {
    return [
        'postId' =>  App\DbModels\Post::all()->random()->id,
        'text' => $faker->sentence,
    ];
});
