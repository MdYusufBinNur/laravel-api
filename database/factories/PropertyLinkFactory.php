<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(\App\DbModels\PropertyLink::class, function (Faker $faker) {
        return [
            'propertyId' =>  App\DbModels\Property::all()->random()->id,
            'title' => $faker->title,
            'description' => $faker->sentence,
            'url' => $faker->url,
            'linkCategoryId' =>  App\DbModels\PropertyLinkCategory::all()->random()->id,
            'isFeatured' => $faker->boolean,
        ];
});
