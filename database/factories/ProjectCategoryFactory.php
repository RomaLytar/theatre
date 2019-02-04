<?php

use Faker\Generator as Faker;

$factory->defineAs(\App\Models\ProjectCategory::class,'project_category', function (Faker $faker) {
    return [
    ];
});

$factory->defineAs(\App\Models\ProjectCategoryTranslation::class, 'project_category_en', function (Faker $faker) {
  return [
    'language' => 'en',
  ];
});

$factory->defineAs(\App\Models\ProjectCategoryTranslation::class, 'project_category_ru', function (Faker $faker) {
  return [
    'language' => 'ru',
  ];
});

$factory->defineAs(\App\Models\ProjectCategoryTranslation::class, 'project_category_ua', function (Faker $faker) {
  return [
    'language' => 'ua',
  ];
});