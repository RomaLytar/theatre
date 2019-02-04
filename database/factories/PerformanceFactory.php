<?php

use Faker\Generator as Faker;

$factory->defineAs(\App\Models\Performance::class, 'performance', function (Faker $faker) {
  return [
    'duration' => $faker->time($format = 'H:i', $max = '10800'),
    'isPremiere' => false,
    'type_id' => rand(1, 5),
    'price' => $faker->randomNumber(2),
  ];
});


$factory->defineAs(\App\Models\PerformanceTranslation::class, 'performance_en', function (Faker $faker) {
  return [
    'performance_id' => 1,
    'language' => 'en',
    'title' => $faker->sentence($nbWords = 2, $variableNbWords = true),
    'descriptions' => $faker->text(1000),
    'directors' => $faker->text(1000),
    'author' => 'Author name',
    'directors2' => $faker->text(1000),
    'lang' => 'Russian',
  ];
});

$factory->defineAs(\App\Models\PerformanceTranslation::class, 'performance_ru', function (Faker $faker) {
  return [
    'performance_id' => 1,
    'language' => 'ru',
    'title' => 'Выступление',
    'descriptions' => $faker->text(1000),
    'directors' => 'Директор 1, Директор 2',
    'author' => 'Имя автора',
    'directors2' => 'Директор 1, Директор 2',
    'lang' => 'Русский',
  ];
});

$factory->defineAs(\App\Models\PerformanceTranslation::class, 'performance_ua', function (Faker $faker) {
  return [
    'performance_id' => 1,
    'language' => 'ua',
    'title' => 'Вистава',
    'descriptions' => $faker->text(1000),
    'directors' => 'Директор 1, Директор 2',
    'author' => 'Имя автора',
    'directors2' => 'Директор 1, Директор 2',
    'lang' => 'Російською',
  ];
});

$factory->defineAs(\App\Models\PerformanceCalendar::class, 'performance_calendar', function (Faker $faker) {
//  $eventTypes = ['opera', 'ballet', 'concert', 'children', 'tour', 'festival', 'muzhab'];
  return [
//    'performance_id' => \App\Models\Performance::latest()->select('id')->limit(1)->first(),
    'date' => $faker->dateTimeInInterval('+10 days', '+180 days'),
//    'event_type' => $eventTypes[rand(1, 7) - 1],
  ];
});

$factory->defineAs(\App\Models\PerformanceActor::class, 'performance_calendar', function (Faker $faker) {
  return [
    'actor_id' => rand(1, 10),
  ];
});
