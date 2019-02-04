<?php

use Faker\Generator as Faker;

$factory->defineAs(\App\Models\Country::class, 'country', function (Faker $faker) {
  return [

  ];
});

$factory->defineAs(\App\Models\CountryTranslation::class, 'country_en', function (Faker $faker) {
  return [
    'language' => 'en',
  ];
});

$factory->defineAs(\App\Models\CountryTranslation::class, 'country_ru', function (Faker $faker) {
  return [
    'language' => 'ru',
  ];
});

$factory->defineAs(\App\Models\CountryTranslation::class, 'country_ua', function (Faker $faker) {
  return [
    'language' => 'ua',
  ];
});
