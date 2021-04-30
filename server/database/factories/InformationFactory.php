<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Information;
use Faker\Generator as Faker;

$factory->define(Information::class, function (Faker $faker) {
    return [
        'id' => 145,
        'info_image_name' => $faker->text(50),
        'description' => $faker->text(300),
    ];
});
