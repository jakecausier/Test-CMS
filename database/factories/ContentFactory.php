<?php

use Faker\Generator as Faker;

$factory->define(App\Content::class, function (Faker $faker) {
    return [
        'name' => $faker->words(4, true),
        'content' => $faker->paragraphs(3, true),
        'type' => 'text',
    ];
});
