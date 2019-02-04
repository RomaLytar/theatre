<?php

use Faker\Generator as Faker;

$factory->defineAs(\App\Models\ArticleCategory::class, 'article_category', function (Faker $faker) {
  return [
  ];
});

$factory->defineAs(\App\Models\ArticleCategoryTranslation::class, 'article_category_en', function (Faker $faker) {
  return [
    'language' => 'en',
  ];
});


$factory->defineAs(\App\Models\ArticleCategoryTranslation::class, 'article_category_ru', function (Faker $faker) {
  return [
    'language' => 'ru',
    'title' => 'Article category ru',
  ];
});

$factory->defineAs(\App\Models\ArticleCategoryTranslation::class, 'article_category_ua', function (Faker $faker) {
  return [
    'language' => 'ua',
    'title' => 'Article category ua',
  ];
});
