<?php

use Faker\Generator as Faker;

$factory->defineAs(\App\Models\Project::class,'project', function (Faker $faker) {
    return [
      'category_id' => rand(1,6),
    ];
});

$factory->defineAs(\App\Models\ProjectTranslation::class, 'project_en', function (Faker $faker) {
  return [
    'language' => 'en',
    'title' => $faker->sentence($nbWords = 3, $variableNbWords = true),
    'description' => $faker->text(1000),
    'cond_description' => $faker->text(1000),
  ];
});

$factory->defineAs(\App\Models\ProjectTranslation::class, 'project_ru', function (Faker $faker) {
  return [
    'language' => 'ru',
    'title' => 'Проект ру',
    'description' => $faker->text(1000),
    'cond_description' => $faker->text(1000),
  ];
});

$factory->defineAs(\App\Models\ProjectTranslation::class, 'project_ua', function (Faker $faker) {
  return [
    'language' => 'ua',
    'title' => 'Проект ua',
    'description' => $faker->text(1000),
    'cond_description' => $faker->text(1000),
  ];
});
