<?php

use Faker\Generator as Faker;

$factory->defineAs(\App\Models\Video::class, 'video', function (Faker $faker) {
  return [
    'url' => 'https://www.youtube.com/watch?v=3Hy5dA8oFV0',
    'category_id' => rand(1, 3),
    'season_id' => 1,
  ];
});

$factory->defineAs(\App\Models\VideoTranslation::class, 'video_en', function (Faker $faker) {
  return [
    'language' => 'en',
    'title' => $faker->sentence($nbWords = 4, $variableNbWords = true),
  ];
});

$factory->defineAs(\App\Models\VideoTranslation::class, 'video_ru', function (Faker $faker) {
  return [
    'language' => 'ru',
    'title' => 'Video title ru',
  ];
});

$factory->defineAs(\App\Models\VideoTranslation::class, 'video_ua', function (Faker $faker) {
  return [
    'language' => 'ua',
    'title' => 'Video title ua',
  ];
});
