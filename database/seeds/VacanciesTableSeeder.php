<?php

use Illuminate\Database\Seeder;

class VacanciesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      factory(\App\Models\Vacancy::class, 'vacancy', 5)->create()->each(function($vacancy) {
        $vacancy->translate('en')->save(factory(\App\Models\VacancyTranslation::class, 'vacancy_en')->make());
        $vacancy->translate('ru')->save(factory(\App\Models\VacancyTranslation::class, 'vacancy_ru')->make());
        $vacancy->translate('ua')->save(factory(\App\Models\VacancyTranslation::class, 'vacancy_ua')->make());
      });
    }
}
