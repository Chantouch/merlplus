<?php

use App\Model\Media;
use App\Model\Post;
use Faker\Generator;

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(Media::class, function (Generator $faker) {
    return [
        'filename' => $faker->image,
        'original_filename' => 'avatar.png',
        'mime_type' => 'image/png'
    ];
});

$factory->state(Media::class, 'thumbnail', function (Generator $faker) {
    return [
        'filename' => $faker->image,
        'original_filename' => 'avatar.png',
        'mime_type' => 'image/png',
        'mediable_type' => 'App\Model\Post',
        'mediable_id' => function () {
            return factory(Post::class)->create()->id;
        }
    ];
});
