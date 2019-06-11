<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\DbModels\Resident::class, function (Faker $faker) {
    return [
        'propertyId' => App\DbModels\Property::all()->random()->id,
        'userId' => App\DbModels\User::all()->random()->id,
        'unitId' => App\DbModels\Unit::all()->random()->id,
        'contactEmail' => $faker->unique()->email,
        'type' => $faker->randomElement(array('tenant','owner')),
        'group' => '',
        'boardMember' => $faker->boolean,
        'sendEmailPermission' => $faker->boolean,
        'displayUnit' => $faker->boolean,
        'displayPublicProfile' => $faker->boolean,
        'allowPostNote' => $faker->boolean,
        'allowSendMessage' => $faker->boolean,
        'defaultDial' => $faker->randomElement(array('homePhone','cellPhone')),
        'homePhone' => substr($faker->phoneNumber,0,20),
        'cellPhone' => substr($faker->phoneNumber,0,20),
        'employerName' => $faker->name,
        'employerAddress' => $faker->address,
        'businessPhone' => substr($faker->phoneNumber,0,20),
        'businessEmail' => $faker->unique()->email,
        'secondaryAddress' => $faker->address,
        'secondaryPhone' => substr($faker->phoneNumber,0,20),
        'secondaryEmail' => $faker->unique()->email,
        'joiningDate' => $faker->dateTime,
    ];
});
