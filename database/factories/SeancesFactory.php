<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Models\Seance;
use Faker\Generator as Faker;

$factory->define(Seance::class, function (Faker $faker) {
    return [
        'resident_id' => function() {
            return \App\Models\Person::query()->where('type', \App\Enums\PersonTypes::RESIDENT)->get()->random();
        },
        'pensionaire_id' => function() {
            return \App\Models\Person::query()->where('type', \App\Enums\PersonTypes::PENSIONNAIRE)->get()->random();
        },
        'duration' => rand(0,500),
        'date_start' => \Carbon\Carbon::now()->addDay(rand(0,20)),
        'date_end' => \Carbon\Carbon::now()->addDay(rand(25,35)),
    ];
});
