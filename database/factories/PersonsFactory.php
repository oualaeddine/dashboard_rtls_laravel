<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Models\Person::class, function (Faker $faker) {
    return [
        'firstname' => $faker->firstName,
        'lastname' => $faker->lastName,
        'uid_bracelet' => $faker->numberBetween(100000000,999999999),
        'type' => \App\Enums\PersonTypes::getRandomValue()
    ];
});
