<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(\App\DbModels\Attachment::class, function (Faker $faker) {
    return [
        'type' => $faker->randomElement(['generic', 'logo', 'property-slide', 'user-profile-pic', 'property-custom']),
        'resourceId' => $faker->sentence,
        'fileName' => 'jobber.jpg',
        'descriptions' => $faker->sentence(5),
        'fileType' => $faker->fileExtension,
        'fileSize' => mt_rand(),
    ];
});
