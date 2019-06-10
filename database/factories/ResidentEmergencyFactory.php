<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(Model::class, function (Faker $faker) {
    return [
        'residentId' => App\DbModels\Resident::all()->random()->id,
        'name' => $faker->name,
        'relationship' => $faker->randomElement(array('Brother','Sister','Cousin','Uncle','Aunt',"Other")),
        'address' => $faker->address,
        'homePhone' => $faker->phoneNumber,
        'cellPhone' => $faker->phoneNumber,
        'email' => $faker->email,
    ];
});
