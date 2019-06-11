<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\DbModels\EnterpriseUserProperty::class, function (Faker $faker) {
    return [
        'enterpriseUserId' =>  App\DbModels\EnterpriseUser::all()->random()->id,
        'propertyId' =>  App\DbModels\Property::all()->random()->id,
        'active' => $faker->boolean,
    ];
});
