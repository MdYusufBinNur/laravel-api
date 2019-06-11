<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\DbModels\PostMarketplace::class, function (Faker $faker) {
    return [
        'postId' =>  App\DbModels\Post::all()->random()->id,
        'type' => $faker->randomElement(array('buy','sell')),
        'title' => $faker->title,
        'price' => $faker->numberBetween(10,100000),
        'contact' => $faker->phoneNumber,
    ];
});
