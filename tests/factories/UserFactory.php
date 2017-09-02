<?php

$factory->define(Backend\Models\User::class, function (Faker\Generator $faker) {
    return [
        'login' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => 'secret',
        'last_activity' => new DateTime,
    ];
});