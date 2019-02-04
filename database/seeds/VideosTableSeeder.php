<?php

use Illuminate\Database\Seeder;

class VideosTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    factory(\App\Models\Video::class, 'video', 5)->create()->each(function($video) {
      $video->addMedia(storage_path('111.png'))->preservingOriginal()->toMediaCollection('posters');
      $video->translate('en')->save(factory(\App\Models\VideoTranslation::class, 'video_en')->make());
      $video->translate('ru')->save(factory(\App\Models\VideoTranslation::class, 'video_ru')->make());
      $video->translate('ua')->save(factory(\App\Models\VideoTranslation::class, 'video_ua')->make());
    });
  }
}
