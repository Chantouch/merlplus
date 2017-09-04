<?php

use Faker\Generator;
use App\Model\Comment;
use App\Model\User;
use App\Model\Post;

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(Comment::class, function (Generator $faker) {
    return [
        'body' => $faker->paragraph,
        'approved' => 1,
        'user_id' => function () {
            return factory(User::class)->create()->id;
        },
        'type' => '1'
    ];
});

$factory->state(Comment::class, 'comment', function (Generator $faker) {
    return [
        'body' => $faker->paragraph,
        'approved' => true,
        'type' => 1,
        'commentable_type' => 'App\Model\Post',
        'commentable_id' => function () {
            return factory(Post::class)->create()->id;
        }
    ];
});
