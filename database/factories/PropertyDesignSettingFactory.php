<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\DbModels\PropertyDesignSetting::class, function (Faker $faker) {
    return [
        'propertyId' =>  App\DbModels\Property::all()->random()->id,
        'themeId' => $faker->numberBetween(1,10),
        'selectedBackground' => $faker->randomElement(array('red','grey','black','white')),
        'selectedHeadline' => $faker->title,
        'customImageAttachmentId' => 1,
        'tileUploadedImage' => $faker->boolean,
    ];
});
