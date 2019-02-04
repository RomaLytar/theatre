<?php

use Faker\Generator as Faker;

$factory->defineAs(\App\Models\ActorGroup::class, 'actor_group', function (Faker $faker) {
  return [
    //
  ];
});

$factory->defineAs(\App\Models\ActorGroupTranslation::class, 'actor_group_en', function (Faker $faker) {
  return [
    'actor_group_id' => 1,
    'language' => 'en',
    'title' => 'Actor group' . $faker->sentence($nbWords = 2, $variableNbWords = true),
  ];
});

$factory->defineAs(\App\Models\ActorGroupTranslation::class, 'actor_group_ru', function (Faker $faker) {
  return [
    'actor_group_id' => 1,
    'language' => 'ru',
    'title' => 'Actor group ru',
  ];
});

$factory->defineAs(\App\Models\ActorGroupTranslation::class, 'actor_group_ua', function (Faker $faker) {
  return [
    'actor_group_id' => 1,
    'language' => 'ua',
    'title' => 'Actor group ua',
  ];
});
