<?php

use Illuminate\Database\Seeder;

class PerformanceTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $types = [
        'opera',
        'ballet',
        'concert',
        'children',
        'tour',
        'festival',
        'muzhab',
      ];

      foreach($types as $type) {
        factory(App\Models\PerformanceType::class, 'performance_type', 1)->create(['name' => $type])->each(function($performance_type) use ($type) {
          $performance_type->translate('en')->save(factory(App\Models\PerformanceTypeTranslation::class, 'performance_type_en')->create(['performance_type_id' => $performance_type->id, 'title' => $type]));
          $performance_type->translate('ru')->save(factory(App\Models\PerformanceTypeTranslation::class, 'performance_type_ru')->create(['performance_type_id' => $performance_type->id, 'title' => $type]));
          $performance_type->translate('ua')->save(factory(App\Models\PerformanceTypeTranslation::class, 'performance_type_ua')->create(['performance_type_id' => $performance_type->id, 'title' => $type]));
        });
      }
    }
}
