<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\DbModels\EnterpriseUser::class, function (Faker $faker) {
    return [
        'userId' =>  App\DbModels\User::all()->random()->id,
        'companyId' =>  App\DbModels\Company::all()->random()->id,
        'contactEmail' => $faker->unique()->email,
        'phone' =>  substr($faker->phoneNumber,0,20),
        'title' => $faker->title,
        'level' => $faker->randomElement(array('enterprise_admin','enterprise_standard')),
    ];
});
