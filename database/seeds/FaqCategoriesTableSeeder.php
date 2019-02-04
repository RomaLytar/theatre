<?php

use Illuminate\Database\Seeder;

class FaqCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      {
        factory(App\Models\FaqCategory::class, 'faq_category', 3)->create()->each(function ($faq_category) {
          $faq_category->translate('en')->save(factory(App\Models\FaqCategoryTranslation::class, 'faq_category_en')->make());
          $faq_category->translate('ru')->save(factory(App\Models\FaqCategoryTranslation::class, 'faq_category_ru')->make());
          $faq_category->translate('ua')->save(factory(App\Models\FaqCategoryTranslation::class, 'faq_category_ua')->make());
        });
      }
    }
}
