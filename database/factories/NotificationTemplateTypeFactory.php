<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\DbModels\NotificationTemplateType::class, function (Faker $faker) {
    return [
        'key' => $faker->randomKey(),
        'module' => $faker->sentence,
    ];
});
