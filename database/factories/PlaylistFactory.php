<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\Playlist::class, function (Faker $faker) {
    return [
       'artist'=>$faker->name,
       'track'=>$faker->sentence($nbWords = 4, $variableNbWords = true),
       'genre'=>$faker->word,
       'year'=>$faker->year($max = 'now'),
       'duration'=>$faker->randomFloat($nbMaxDecimals = 2, $min = 1, $max = 15)


    ];
});
