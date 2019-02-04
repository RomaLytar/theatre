<?php

use Illuminate\Database\Seeder;

class PerformancesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      factory(\App\Models\Performance::class, 'performance', 5)->create()->each(function($performance) {
        $performance->addMedia(storage_path('111.png'))->preservingOriginal()->toMediaCollection('posters');
        $performance->addMedia(storage_path('111.png'))->preservingOriginal()->toMediaCollection('directors');
        $performance->addMedia(storage_path('111.png'))->preservingOriginal()->toMediaCollection('directors2');
        $performance->translate('en')->save(factory(\App\Models\PerformanceTranslation::class, 'performance_en')->make());
        $performance->translate('ru')->save(factory(\App\Models\PerformanceTranslation::class, 'performance_ru')->make());
        $performance->translate('ua')->save(factory(\App\Models\PerformanceTranslation::class, 'performance_ua')->make());
        for($i = 0; $i < rand(1, 5); $i++) {
          $performanceDate = $performance->dates()->save(factory(\App\Models\PerformanceCalendar::class, 'performance_calendar')->make());
          for($j = 0; $j < rand(1, 2); $j++) {
            $performanceDate->actors()->save(factory(\App\Models\PerformanceActor::class, 'performance_calendar')->make());
          }
        }
      });
    }
}
