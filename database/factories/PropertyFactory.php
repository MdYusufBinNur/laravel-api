<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\DbModels\Property::class, function (Faker $faker) {
    return [
        'companyId' => App\DbModels\Company::all()->random()->id,
        'type' => $faker->randomElement(array('Market','Hostel','Building','Hotel')),
        'title' => $faker->company,
        'domain' => $faker->unique()->domainName,
        'subdomain' => $faker->unique()->domainWord,
        'address' => $faker->address,
        'city' => $faker->city,
        'state' => $faker->state,
        'postCode' => $faker->postcode,
        'country' => $faker->randomElement(array('BD','India','UK','USA','UAE','SL')),
        'language' => $faker->languageCode,
        'timezone' => $faker->timezone,
        'active' => $faker->boolean,
    ];
});
