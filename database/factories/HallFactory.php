<?php

use Faker\Generator as Faker;

$factory->defineAs(\App\Models\Hall::class, 'hall', function (Faker $faker) {
  return [
      'spaciousness' => 100,
  ];
});

$factory->defineAs(\App\Models\HallTranslation::class, 'hall_translation', function (Faker $faker) {
  return [
    'description' => $faker->text(1000),
  ];
});

$factory->defineAs(\App\Models\Section::class, 'section', function (Faker $faker) {
    return [

    ];
});

$factory->defineAs(\App\Models\SectionTranslation::class, 'section_translation', function (Faker $faker) {
    return [
        'language' => 'en',
    ];
});

$factory->defineAs(\App\Models\Row::class, 'row', function (Faker $faker) {
    return [

    ];
});

$factory->defineAs(\App\Models\Seat::class, 'seat', function (Faker $faker) {
    return [

    ];
});