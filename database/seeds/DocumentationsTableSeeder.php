<?php

use Illuminate\Database\Seeder;

class DocumentationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      factory(\App\Models\Documentation::class, 'doc', 5)->create()->each(function($doc) {
        $doc->translate('en')->save(factory(\App\Models\DocumentationTranslation::class, 'doc_en')->make());
        $doc->translate('ru')->save(factory(\App\Models\DocumentationTranslation::class, 'doc_ru')->make());
        $doc->translate('ua')->save(factory(\App\Models\DocumentationTranslation::class, 'doc_ua')->make());
      });
    }
}
