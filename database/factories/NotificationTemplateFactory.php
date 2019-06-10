<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\DbModels\NotificationTemplate::class, function (Faker $faker) {
    return [
        'typeId' =>  App\DbModels\NotificationTemplateType::all()->random()->id,
        'title' => $faker->title,
        'text' => $faker->sentence,
        'editable' => $faker->boolean,
    ];
});
