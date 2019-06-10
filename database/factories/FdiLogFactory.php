<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\DbModels\FdiLog::class, function (Faker $faker) {
    return [
        'fdiId' =>  App\DbModels\VisitorType::all()->random()->id,
        'userId' =>  App\DbModels\VisitorType::all()->random()->id,
        'text' => $faker->sentence,
        'type' => $faker->randomElement(array('add','edit','expired','approved','denied')),
    ];
});
