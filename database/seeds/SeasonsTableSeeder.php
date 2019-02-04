<?php

use Illuminate\Database\Seeder;

class SeasonsTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    factory(App\Models\Season::class, 'season', 1)->create()->each(function($season) {
      $season->translate('en')->save(factory(App\Models\SeasonTranslation::class, 'season_en')->make());
      $season->translate('ru')->save(factory(App\Models\SeasonTranslation::class, 'season_ru')->make());
      $season->translate('ua')->save(factory(App\Models\SeasonTranslation::class, 'season_ua')->make());
    });
  }
}
