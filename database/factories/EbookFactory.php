<?php

use Faker\Generator as Faker;

$factory->defineAs(\App\Models\Ebook::class, 'ebook', function (Faker $faker) {
  return [

  ];
});

$factory->defineAs(App\Models\EbookTranslation::class, 'ebook_en', function (Faker $faker) {
    return [
      'language' => 'en',
      'title' => $faker->sentence($nbWords = 3, $variableNbWords = true),
      'file' => 'http://num.kharkiv.ua/doc/gazeta11.pdf',
    ];
});

$factory->defineAs(App\Models\EbookTranslation::class, 'ebook_ru', function (Faker $faker) {
  return [
    'language' => 'ru',
    'title' => 'Ebook title ru',
    'file' => 'http://num.kharkiv.ua/doc/gazeta11.pdf',
  ];
});

$factory->defineAs(App\Models\EbookTranslation::class, 'ebook_ua', function (Faker $faker) {
  return [
    'language' => 'ua',
    'title' => 'Ebook title ua',
    'file' => 'http://num.kharkiv.ua/doc/gazeta11.pdf',
  ];
});
