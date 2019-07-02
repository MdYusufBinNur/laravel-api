<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\DbModels\Role::class, function (Faker $faker) {
    return [
        'title' => $faker->randomElement(array('Admin','Guest','Manager','User')),
        'roleCategoryId' => App\DbModels\RoleCategory::all()->random()->id,
    ];
});
