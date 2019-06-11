<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\DbModels\PostRecommendation::class, function (Faker $faker) {
    return [
        'postId' =>  App\DbModels\Post::all()->random()->id,
        'typeId' =>  App\DbModels\PostRecommendationType::all()->random()->id,
        'name' => $faker->name,
        'description' => $faker->paragraph,
        'contact' => $faker->randomAscii,
        'website' => $faker->url,
    ];
});
