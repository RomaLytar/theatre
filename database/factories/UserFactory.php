<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->defineAs(\App\Models\User::class, 'user', function (Faker $faker) {
    return [
        'login' => 'user@gmail.com',
        'email' => 'user@gmail.com',
        'password' => bcrypt('123456789'),
        'remember_token' => str_random(10),
        'firstName' => $faker->name,
        'lastName' => $faker->name,
        'country_id' => rand(1, 150),
    ];
});

$factory->defineAs(\App\Models\User::class, 'admin', function (Faker $faker) {
    return [
        'login' => 'rademax',
        'email' => 'rademaxbh@gmail.com',
        'password' => bcrypt('123456789'),
        'remember_token' => str_random(10),
        'firstName' => 'Vladimir',
        'lastName' => 'Ishchenko',
        'country_id' => rand(1, 150),
    ];
});

$factory->defineAs(\App\Models\User::class, 's-user', function (Faker $faker) {
    return [
        'login' => 'suser@gmail.com',
        'email' => 'suser@gmail.com',
        'password' => bcrypt('1234567899'),
        'remember_token' => str_random(10),
        'firstName' => 'user',
        'lastName' => 'user',
        'country_id' => rand(1, 150),
    ];
});
