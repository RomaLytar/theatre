<?php

use Illuminate\Database\Seeder;

class AlbumsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
  public function run()
  {
    factory(\App\Models\Album::class, 'album', 150)->create()->each(function($album) {
      $album->addMedia(storage_path('111.png'))->preservingOriginal()->toMediaCollection('posters');
      for($i = 0; $i < rand(3,5); $i++) {
        $album->addMedia(storage_path('111.png'))->preservingOriginal()->toMediaCollection('album-images');
      }
      $album->translate('en')->save(factory(\App\Models\AlbumTranslation::class, 'album_en')->make());
      $album->translate('ru')->save(factory(\App\Models\AlbumTranslation::class, 'album_ru')->make());
      $album->translate('ua')->save(factory(\App\Models\AlbumTranslation::class, 'album_ua')->make());
    });
  }
}
