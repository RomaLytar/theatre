<?php

use Faker\Generator as Faker;

$factory->defineAs(\App\Models\Faq::class, 'faq', function (Faker $faker) {
  return [
    'category_id' => rand(1, 3),
  ];
});

$factory->defineAs(\App\Models\FaqTranslation::class, 'faq_en', function (Faker $faker) {
  return [
    'language' => 'en',
    'title' => $faker->sentence($nbWords = 3, $variableNbWords = true),
    'description' => $faker->text(1000),
  ];
});

$factory->defineAs(\App\Models\FaqTranslation::class, 'faq_ru', function (Faker $faker) {
  return [
    'language' => 'ru',
    'title' => 'Booking tickets and season tickets ?',
    'description' => $faker->text(1000),
  ];
});

$factory->defineAs(\App\Models\FaqTranslation::class, 'faq_ua', function (Faker $faker) {
  return [
    'language' => 'ua',
    'title' => 'Заказ билетов и абонементов ?',
    'description' => $faker->text(1000),
  ];
});
