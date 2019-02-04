<?php

use Faker\Generator as Faker;

$factory->defineAs(\App\Models\HomePage::class, 'homepage_component1', function (Faker $faker) {
  return [
    'type' => 'recommended',
    'performance_calendar_id' => 1,
  ];
});

$factory->defineAs(\App\Models\HomePage::class, 'homepage_component2', function (Faker $faker) {
  return [
    'type' => 'specialProjects',
    'performance_calendar_id' => 1,
  ];
});

$factory->defineAs(\App\Models\HomePage::class, 'homepage_component3', function (Faker $faker) {
  return [
    'type' => 'promoSlider',
    'performance_calendar_id' => 1,
  ];
});

$factory->defineAs(\App\Models\HomePage::class, 'homepage_component4', function (Faker $faker) {
  return [
    'type' => 'promoSliderMini',
    'performance_calendar_id' => 1,
  ];
});
