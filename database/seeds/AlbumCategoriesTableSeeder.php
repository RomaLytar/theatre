<?php

use Illuminate\Database\Seeder;

class AlbumCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
  public function run()
  {
    factory(App\Models\AlbumCategory::class, 'album_category', 3)->create()->each(function($album_category) {
      $album_category->translate('en')->save(factory(App\Models\AlbumCategoryTranslation::class, 'album_category_en')->make());
      $album_category->translate('ru')->save(factory(App\Models\AlbumCategoryTranslation::class, 'album_category_ru')->make());
      $album_category->translate('ua')->save(factory(App\Models\AlbumCategoryTranslation::class, 'album_category_ua')->make());
    });
  }
}
