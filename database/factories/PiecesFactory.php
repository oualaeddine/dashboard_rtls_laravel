<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Models\Piece;
use Faker\Generator as Faker;

$factory->define(Piece::class, function (Faker $faker) {
/*    return [
        'cart_id' => rand(10000, 9999999),
        'name' => $faker->sentence(3),
        'type' => \App\Enums\PieceTypes::getRandomValue(),
        'isInterdite' => rand(0,1) == 1,
    ];*/
});
