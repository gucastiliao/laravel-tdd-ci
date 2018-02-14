<?php

use Faker\Generator as Faker;

$factory->define(App\Post::class, function (Faker $faker) {
    return [
        'title' => str_random(20),
        'body' => str_random(100),
        'author' => str_random(10),
    ];
});
