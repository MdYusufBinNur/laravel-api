<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\DbModels\PostApprovalBlacklistUnit::class, function (Faker $faker) {
    return [
        'unitId' => App\DbModels\Unit::all()->random()->id,
    ];
});
