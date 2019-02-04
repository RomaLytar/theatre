<?php

use Faker\Generator as Faker;

$factory->defineAs(\App\Models\Page::class, 'page', function (Faker $faker) {
  return [
//    'name' => 'mission-and-goals',
  ];
});

//$factory->defineAs(\App\Models\Page::class, 'page_history', function (Faker $faker) {
//  return [
//    'name' => 'history',
//  ];
//});

$factory->defineAs(\App\Models\PageTranslation::class, 'page_en', function (Faker $faker) {
  return [
    'language' => 'en',
    'descriptions' => $faker->text(1000),
  ];
});

$factory->defineAs(\App\Models\PageTranslation::class, 'page_ru', function (Faker $faker) {
  return [
    'language' => 'ru',
    'descriptions' => $faker->text(1000),
  ];
});

$factory->defineAs(\App\Models\PageTranslation::class, 'page_ua', function (Faker $faker) {
  return [
    'language' => 'ua',
    'descriptions' => $faker->text(1000),
  ];
});
