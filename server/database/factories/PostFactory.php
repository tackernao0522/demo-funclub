<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use App\PrimaryCategory;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'post_image_name' => $faker->text(50),
        'post_title' => $faker->text(20),
        'language' => $faker->text(255),
        'body' => $faker->text(500),
        'user_id' => function () {
            return factory(PrimaryCategory::class);
        }
    ];
});
