<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\DbModels\PropertyImage::class, function (Faker $faker) {
    return [
        'propertyId' =>  App\DbModels\Property::all()->random()->id,
        'title' => $faker->title,
        'imageId' => factory(\App\DbModels\Attachment::class)->create()->id
    ];
});
