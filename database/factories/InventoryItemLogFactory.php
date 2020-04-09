<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\DbModels\InventoryItemLog::class, function (Faker $faker) {
    return [
        'inventoryItemId' =>  App\DbModels\InventoryItem::all()->random()->id,
        'propertyId' =>  App\DbModels\Property::all()->random()->id,
        'updatedByUserId' =>  1,
        'quantityChange' => $faker->word,
    ];
});
