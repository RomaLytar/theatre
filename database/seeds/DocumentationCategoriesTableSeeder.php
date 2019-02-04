<?php

use Illuminate\Database\Seeder;

class DocumentationCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      {
        factory(App\Models\DocumentationCategory::class, 'doc_category', 3)->create()->each(function ($doc_category) {
          $doc_category->translate('en')->save(factory(App\Models\DocumentationCategoryTranslation::class, 'doc_category_en')->make());
          $doc_category->translate('ru')->save(factory(App\Models\DocumentationCategoryTranslation::class, 'doc_category_ru')->make());
          $doc_category->translate('ua')->save(factory(App\Models\DocumentationCategoryTranslation::class, 'doc_category_ua')->make());
        });
      }
    }
}
