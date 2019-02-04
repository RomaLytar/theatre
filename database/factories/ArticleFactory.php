<?php

use Faker\Generator as Faker;

$factory->defineAs(\App\Models\Article::class, 'article', function (Faker $faker) {
  return [
    'category_id' => rand(1, 4),
  ];
});

$factory->defineAs(\App\Models\Video::class, 'article', function (Faker $faker) {
  return [
    'url' => 'https://www.youtube.com/watch?v=90Rnl_IWYvI',
  ];
});

$factory->defineAs(\App\Models\ArticleTranslation::class, 'article_en', function (Faker $faker) {
  return [
    'language' => 'en',
    'title' => $faker->sentence($nbWords = 3, $variableNbWords = true),
    'descriptions' => $faker->text(1000),
  ];
});

$factory->defineAs(\App\Models\ArticleTranslation::class, 'article_ru', function (Faker $faker) {
  return [
    'language' => 'ru',
    'title' => 'Article title ru',
    'descriptions' => $faker->text(1000),
  ];
});

$factory->defineAs(\App\Models\ArticleTranslation::class, 'article_ua', function (Faker $faker) {
  return [
    'language' => 'ua',
    'title' => 'Article title ua',
    'descriptions' => $faker->text(1000),
  ];
});

$factory->defineAs(\App\Models\ArticleActor::class, 'article', function (Faker $faker) {
  return [
    'article_id' => rand(1, 5),
    'actor_id' => rand(1, 10),
  ];
});

$factory->defineAs(\App\Models\ArticlePerformance::class, 'article', function (Faker $faker) {
  return [
    'article_id' => rand(1, 5),
    'performance_id' => rand(1, 5),
  ];
});
