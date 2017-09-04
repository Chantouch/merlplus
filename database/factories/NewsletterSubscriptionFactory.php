<?php

use App\Model\NewsletterSubscription;
use Faker\Generator;

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(NewsletterSubscription::class, function (Generator $faker) {
    return [
        'email' => $faker->unique()->safeEmail
    ];
});
