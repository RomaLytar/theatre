<?php

use Faker\Generator as Faker;

$factory->defineAs(\App\Models\Documentation::class,'doc', function (Faker $faker) {
    return [
      'category_id' => rand(1, 3),
      'file' => 'http://num.kharkiv.ua/doc/gazeta11.pdf',
    ];
});

$factory->defineAs(\App\Models\DocumentationTranslation::class, 'doc_en', function (Faker $faker) {
  return [
    'language' => 'en',
    'title' => $faker->sentence($nbWords = 50, $variableNbWords = true),
  ];
});

$factory->defineAs(\App\Models\DocumentationTranslation::class, 'doc_ru', function (Faker $faker) {
  return [
    'language' => 'ru',
    'title' => 'Документ ru',
  ];
});

$factory->defineAs(\App\Models\DocumentationTranslation::class, 'doc_ua', function (Faker $faker) {
  return [
    'language' => 'ua',
    'title' => 'Документ ua',
  ];
});