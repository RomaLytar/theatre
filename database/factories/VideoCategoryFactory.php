<?php

use Faker\Generator as Faker;

$factory->defineAs(\App\Models\VideoCategory::class, 'video_category', function (Faker $faker) {
  return [];
});

$factory->defineAs(\App\Models\VideoCategoryTranslation::class, 'video_category_en', function (Faker $faker) {
  return [
    'language' => 'en',
    'title' => $faker->sentence($nbWords = 2, $variableNbWords = true),
  ];
});

$factory->defineAs(\App\Models\VideoCategoryTranslation::class, 'video_category_ru', function (Faker $faker) {
  return [
    'language' => 'ru',
    'title' => 'Video category ru',
  ];
});

$factory->defineAs(\App\Models\VideoCategoryTranslation::class, 'video_category_ua', function (Faker $faker) {
  return [
    'language' => 'ua',
    'title' => 'Video category ua',
  ];
});
