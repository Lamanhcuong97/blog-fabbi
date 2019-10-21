<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\Models\Post::class, function (Faker $faker) {
    return [
        'title' => $faker->realText($maxNbChars = 30),
        'description' => $faker->realText($maxNbChars = 30),
        'content' => $faker->realText($maxNbChars = 100),
        'thumnail' => 'image/noImage.png'
    ];
});
