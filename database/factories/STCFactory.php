<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(\App\DbModels\StaffTimeClock::class, function (Faker $faker) {

    $year = rand(2019, 2020);
    $month = rand(1, 12);
    $day = rand(1, 28);
    $minute = rand(1,15);

    $date = Carbon::create($year,$month ,$day , 10, $minute, 0);

    return [
        'propertyId' => 1,
        'createdByUserId' => 1,
        'managerId' =>  $faker->numberBetween(1,2),
        'state' => $faker->randomElement(array('check-in','check-out')),
        "clockedIn" =>  $date->format('Y-m-d H:i:s'),
        "clockedOut" => $date->addHours(rand(5, 9))->format('Y-m-d H:i:s')
    ];
});
