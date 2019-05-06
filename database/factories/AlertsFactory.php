<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Models\Alert;
use Faker\Generator as Faker;

$factory->define(Alert::class, function (Faker $faker) {
    return [
        'person_id' => function() {
            return \App\Models\Person::all()->random();
        },
        'piece_id' => function () {
            return \App\Models\Piece::all()->random();
        },
        'date_time' => \Carbon\Carbon::now()->addDay(rand(0, 20))
    ];
});
