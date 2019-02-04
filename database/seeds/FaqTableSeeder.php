<?php

use Illuminate\Database\Seeder;

class FaqTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      factory(\App\Models\Faq::class, 'faq', 5)->create()->each(function($faq) {
        $faq->translate('en')->save(factory(\App\Models\FaqTranslation::class, 'faq_en')->make());
        $faq->translate('ru')->save(factory(\App\Models\FaqTranslation::class, 'faq_ru')->make());
        $faq->translate('ua')->save(factory(\App\Models\FaqTranslation::class, 'faq_ua')->make());
      });
    }
}
