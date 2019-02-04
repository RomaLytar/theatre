<?php

use Faker\Generator as Faker;

$factory->defineAs(\App\Models\AlbumCategory::class, 'album_category', function (Faker $faker) {
  return [];
});

$factory->defineAs(\App\Models\AlbumCategoryTranslation::class, 'album_category_en', function (Faker $faker) {
  return [
    'language' => 'en',
    'title' => 'Album category' . $faker->sentence($nbWords = 1, $variableNbWords = true),
  ];
});

$factory->defineAs(\App\Models\AlbumCategoryTranslation::class, 'album_category_ru', function (Faker $faker) {
  return [
    'language' => 'ru',
    'title' => 'Album category ru',
  ];
});

$factory->defineAs(\App\Models\AlbumCategoryTranslation::class, 'album_category_ua', function (Faker $faker) {
  return [
    'language' => 'ua',
    'title' => 'Album category ua',
  ];
});
