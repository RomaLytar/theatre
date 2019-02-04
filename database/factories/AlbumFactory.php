<?php

use Faker\Generator as Faker;

$factory->defineAs(\App\Models\Album::class, 'album', function (Faker $faker) {
  return [
    'category_id' => rand(1, 2),
    'season_id' => 3,
  ];
});

$factory->defineAs(\App\Models\AlbumTranslation::class, 'album_en', function (Faker $faker) {
  return [
    'language' => 'en',
    'title' => $faker->sentence($nbWords = 4, $variableNbWords = true),
  ];
});

$factory->defineAs(\App\Models\AlbumTranslation::class, 'album_ru', function (Faker $faker) {
  return [
    'language' => 'ru',
    'title' => 'Album title ru',
  ];
});

$factory->defineAs(\App\Models\AlbumTranslation::class, 'album_ua', function (Faker $faker) {
  return [
    'language' => 'ua',
    'title' => 'Album title ua',
  ];
});
