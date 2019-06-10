<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\DbModels\UserProfile::class, function (Faker $faker) {
    return [
        'userId' => App\DbModels\User::all()->random()->id,
        'gender' => $faker->randomElement(array('male','female')),
        'occupation' => $faker->randomElement(array('businessmen','jobholder','doctor','engineer','teacher','banker','other')),
        'homeTown' => $faker->city,
        'birthDate' => $faker->dateTime,
        'language' => $faker->languageCode,
        'website' => $faker->url,
        'facebookUsername' => 'www.facebook.com'.$faker->unique()->userName,
        'twitterUsername' => 'www.twitter.com'.$faker->unique()->userName,
        'aboutMe' => $faker->sentence,
    ];
});
