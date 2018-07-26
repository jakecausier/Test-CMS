<?php

use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'name' => $faker->words(4, true),
        'live_at' => $faker->boolean ? now()->ToDateTimeString() : null,
        'id_author' => optional( App\User::first() )->id,
    ];
});
