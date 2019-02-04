<?php

use Faker\Generator as Faker;

$factory->defineAs(\App\Models\FaqCategory::class, 'faq_category', function (Faker $faker) {
  return [];
});

$factory->defineAs(\App\Models\FaqCategoryTranslation::class, 'faq_category_en', function (Faker $faker) {
  return [
    'language' => 'en',
    'title' => 'Tickets and subscriptions',
  ];
});

$factory->defineAs(\App\Models\FaqCategoryTranslation::class, 'faq_category_ru', function (Faker $faker) {
  return [
    'language' => 'ru',
    'title' => 'Билеты и абонементы',
  ];
});

$factory->defineAs(\App\Models\FaqCategoryTranslation::class, 'faq_category_ua', function (Faker $faker) {
  return [
    'language' => 'ua',
    'title' => 'Билеты и абонементы',
  ];
});
