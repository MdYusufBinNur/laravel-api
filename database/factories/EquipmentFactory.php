<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(\App\DbModels\Equipment::class, function (Faker $faker) {
    return [
        'propertyId'  => App\DbModels\Property::all()->random()->id,
        'name' => $faker->name,
        'sku'  => $faker->title,
        'description'  => $faker->sentence,
        'location' => $faker->address,
        'areaServices' => $faker->randomElements(array('building','garage','shop')),
        'manufacturer' => $faker->company,
        'expireDate' => $faker->dateTime,
        'modelNumber' => $faker->randomElements(array('model1', 'model2', 'model3')) ,
        'requiredService' => $faker->randomElements(array('service1', 'service2')),
        'nextMaintenanceDate' => $faker->dateTime,
        'notifyDuration' => $faker->randomElements(array('day', 'week', 'month', 'three_months', 'six_months', 'year')),
        'restockNote'  => $faker->sentence,
    ];
});
