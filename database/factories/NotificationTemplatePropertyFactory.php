<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\DbModels\NotificationTemplateProperty::class, function (Faker $faker) {
    return [
        'propertyId' =>  App\DbModels\Property::all()->random()->id,
        'templateId' =>  App\DbModels\NotificationTemplate::all()->random()->id,
    ];
});
