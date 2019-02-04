<?php

use Faker\Generator as Faker;

$factory->defineAs(\App\Models\Program::class,'program', function (Faker $faker) {
    return [

    ];
});

$factory->defineAs(App\Models\ProgramTranslation::class, 'program_en', function (Faker $faker) {
  return [
    'language' => 'en',
    'title' => $faker->sentence($nbWords = 3, $variableNbWords = true),
    'description' => $faker->text(350),
    'terms_description' => $faker->text(400),
  ];
});

$factory->defineAs(App\Models\ProgramTranslation::class, 'program_ru', function (Faker $faker) {
  return [
    'language' => 'ru',
    'title' => 'Program title ru',
    'description' => $faker->text(350),
    'terms_description' => $faker->text(400),
  ];
});

$factory->defineAs(App\Models\ProgramTranslation::class, 'program_ua', function (Faker $faker) {
  return [
    'language' => 'ua',
    'title' => 'Program title ua',
    'description' => $faker->text(350),
    'terms_description' => $faker->text(400),
  ];
});
