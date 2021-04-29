<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\TopTitle;
use Faker\Generator as Faker;

$factory->define(TopTitle::class, function (Faker $faker) {
    return [
        'id' => '1',
        'main_title' => $faker->text(25),
        'content' =>  $faker->text(100),
    ];
});
