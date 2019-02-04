<?php

use Illuminate\Database\Seeder;

class VideoCategoriesTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    factory(App\Models\VideoCategory::class, 'video_category', 3)->create()->each(function($video_category) {
      $video_category->translate('en')->save(factory(App\Models\VideoCategoryTranslation::class, 'video_category_en')->make());
      $video_category->translate('ru')->save(factory(App\Models\VideoCategoryTranslation::class, 'video_category_ru')->make());
      $video_category->translate('ua')->save(factory(App\Models\VideoCategoryTranslation::class, 'video_category_ua')->make());
    });
  }
}
