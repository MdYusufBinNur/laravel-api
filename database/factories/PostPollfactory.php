<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\DbModels\PostPoll::class, function (Faker $faker) {
    return [
        'postId' =>  App\DbModels\Post::all()->random()->id,
        'text' => '{"answers": ["red", "green", "mango"], "question": "What is the color of the apple?"}',
        'votes' => '[0, 0, 0]',
    ];
});
