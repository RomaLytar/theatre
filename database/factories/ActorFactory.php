<?php

use Faker\Generator as Faker;

$factory->defineAs(\App\Models\Actor::class, 'actor', function (Faker $faker) {
  return [
    'dob' => $faker->date,
    'facebook' => '/',
    'instagram' => '/',
    'twitter' => '/',
    'youtube' => '/',
    'group_id' => rand(1, 46),
  ];
});

$factory->defineAs(\App\Models\Image::class, 'actor', function (Faker $faker) {
  return [
    'url' => 'http://placehold.it/150x180/111',
  ];
});

$factory->defineAs(\App\Models\Video::class, 'actor', function (Faker $faker) {
  return [
    'url' => 'https://www.youtube.com/watch?v=90Rnl_IWYvI',
  ];
});

$factory->defineAs(\App\Models\ActorTranslation::class, 'actor_en', function (Faker $faker) {
  return [
    'actor_id' => 1,
    'language' => 'en',
    'firstName' => $faker->firstName,
    'lastName' => $faker->lastName,
    'descriptions' => $faker->text(1000),
    'degree' => 'Actor degree',
    'repertoire' => 'Actor repertoire',
    'debut' => 'Actor debut',
    'hometown' => $faker->city,
    'merit' => 'Actor merit',
  ];
});

$factory->defineAs(\App\Models\ActorTranslation::class, 'actor_ru', function (Faker $faker) {
  return [
    'actor_id' => 1,
    'language' => 'ru',
    'firstName' => 'Иван',
    'lastName' => 'Иванов',
    'descriptions' => $faker->text(1000),
    'degree' => 'Actor degree',
    'repertoire' => 'Actor repertoire',
    'debut' => 'Actor debut',
    'hometown' => 'Actor hometown',
    'merit' => 'Actor merit',
  ];
});

$factory->defineAs(\App\Models\ActorTranslation::class, 'actor_ua', function (Faker $faker) {
  return [
    'actor_id' => 1,
    'language' => 'ua',
    'firstName' => 'Иван',
    'lastName' => 'Иванов',
    'descriptions' => $faker->text(1000),
    'degree' => 'Actor degree',
    'repertoire' => 'Actor repertoire',
    'debut' => 'Actor debut',
    'hometown' => 'Actor hometown',
    'merit' => 'Actor merit',
  ];
});
