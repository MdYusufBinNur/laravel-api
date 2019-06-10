<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\DbModels\PropertyDesignSetting::class, function (Faker $faker) {
    return [
        'propertyId' =>  App\DbModels\Property::all()->random()->id,
        'themeId' => '',
        'selectedBackground' => $faker->colorName,
        'selectedHeadline' => $faker->title,
        'customImage' => $faker->imageUrl(),
        'tileUploadedImage' => $faker->boolean,
    ];
});
