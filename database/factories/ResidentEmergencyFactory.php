<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\DbModels\ResidentEmergency::class, function (Faker $faker) {
    return [
        'residentId' => App\DbModels\Resident::all()->random()->id,
        'name' => $faker->name,
        'relationship' => $faker->randomElement(array('Brother','Sister','Cousin','Uncle','Aunt',"Other")),
        'address' => $faker->address,
        'homePhone' => substr($faker->phoneNumber,0,20),
        'cellPhone' => substr($faker->phoneNumber,0,20),
        'email' => $faker->email,
    ];
});
