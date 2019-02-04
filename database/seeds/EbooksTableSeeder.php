<?php

use Illuminate\Database\Seeder;

class EbooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      factory(\App\Models\Ebook::class, 'ebook', 5)->create()->each(function($ebook) {
        $ebook->addMedia(storage_path('111.png'))->preservingOriginal()->toMediaCollection('posters');
        $ebook->translate('en')->save(factory(\App\Models\EbookTranslation::class, 'ebook_en')->make());
        $ebook->translate('ru')->save(factory(\App\Models\EbookTranslation::class, 'ebook_ru')->make());
        $ebook->translate('ua')->save(factory(\App\Models\EbookTranslation::class, 'ebook_ua')->make());
      });
    }
}
