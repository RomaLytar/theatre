<?php

use Faker\Generator as Faker;

$factory->defineAs(\App\Models\Banner::class, 'banner', function (Faker $faker) {
    return [
    'is_calendar' => rand(0, 1)
    ];
});

$factory->defineAs(App\Models\BannerTranslation::class, 'banner_en', function (Faker $faker) {
    return [
        'language' => 'en',
        'title' => $faker->sentence($nbWords = 3, $variableNbWords = true),
    ];
});

$factory->defineAs(App\Models\BannerTranslation::class, 'banner_ru', function (Faker $faker) {
    return [
        'language' => 'ru',
        'title' => 'НА СЦЕНАХ ОПЕРЫ',
    ];
});

$factory->defineAs(App\Models\BannerTranslation::class, 'banner_ua', function (Faker $faker) {
    return [
        'language' => 'ua',
        'title' => 'НА СЦЕНАХ ОПЕРЫ',
    ];
});
