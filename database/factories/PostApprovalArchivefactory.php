<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\DbModels\PostApprovalArchive::class, function (Faker $faker) {
    return [
        'postId' =>  App\DbModels\Post::all()->random()->id,
        'status' => $faker->randomElement(array('approved','denied')),
        'reason' => $faker->sentence,
    ];
});
