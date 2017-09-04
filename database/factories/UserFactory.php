<?php

use Faker\Generator;
use App\Model\User;

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(User::class, function (Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = 'secret',
        'api_token' => str_random(60),
        'remember_token' => str_random(10),
    ];
});

$factory->state(User::class, 'Chantouch Sek', function (Generator $faker) {
    return [
        'name' => 'Chantouch Sek',
        'email' => 'chantouchsek.cs83@gmail.com'
    ];
});
