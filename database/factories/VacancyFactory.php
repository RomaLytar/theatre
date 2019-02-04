<?php

use Faker\Generator as Faker;

$factory->defineAs(\App\Models\Vacancy::class,'vacancy', function (Faker $faker) {
    return [
      'is_active' => '1'
    ];
});

$factory->defineAs(App\Models\VacancyTranslation::class, 'vacancy_en', function (Faker $faker) {
  return [
    'language' => 'en',
    'title' => $faker->sentence($nbWords = 3, $variableNbWords = true),
    'description' => $faker->text(600),
  ];
});

$factory->defineAs(App\Models\VacancyTranslation::class, 'vacancy_ru', function (Faker $faker) {
  return [
    'language' => 'ru',
    'title' => 'Vacancy title ru',
    'description' => $faker->text(1000),
  ];
});

$factory->defineAs(App\Models\VacancyTranslation::class, 'vacancy_ua', function (Faker $faker) {
  return [
    'language' => 'ua',
    'title' => 'Vacancy title ua',
    'description' => $faker->text(400),
  ];
});
