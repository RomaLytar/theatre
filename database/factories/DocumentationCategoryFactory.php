<?php
use Faker\Generator as Faker;
$factory->defineAs(\App\Models\DocumentationCategory::class,'doc_category', function (Faker $faker) {
    return [];
});

$factory->defineAs(\App\Models\DocumentationCategoryTranslation::class, 'doc_category_en', function (Faker $faker) {
  return [
    'language' => 'en',
    'title' => $faker->sentence($nbWords = 1, $variableNbWords = true),
  ];
});

$factory->defineAs(\App\Models\DocumentationCategoryTranslation::class, 'doc_category_ru', function (Faker $faker) {
  return [
    'language' => 'ru',
    'title' => 'Деятельность',
  ];
});

$factory->defineAs(\App\Models\DocumentationCategoryTranslation::class, 'doc_category_ua', function (Faker $faker) {
  return [
    'language' => 'ua',
    'title' => 'Деятельность',
  ];
});
