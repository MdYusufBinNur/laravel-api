<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(\App\DbModels\InventoryItem::class, function (Faker $faker) {
    return [
        'propertyId' =>  App\DbModels\Property::all()->random()->id,
        'categoryId' =>  App\DbModels\InventoryCategory::all()->random()->id,
        'sku' => $faker->sentence,
        'name' => $faker->name,
        'description' => $faker->sentence,
        'location' => $faker->address,
        'comment' => $faker->sentence,
        'manufacturer' => $faker->name,
        'notifyCount' => 1,
        'quantity' => 1,
    ];
});