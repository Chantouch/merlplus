<?php

use Faker\Generator;
use App\Model\Post;
use App\Model\User;
use Illuminate\Support\Facades\DB;

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(Post::class, function (Generator $faker) {
    return [
        'title' => $faker->sentence,
        'description' => $faker->paragraph,
        'user_id' => function () {
            return factory(User::class)->create()->id;
        },
        'active' => 1,
        'posted_at' => \Carbon\Carbon::now(),
        'slug' => $faker->slug
    ];
});