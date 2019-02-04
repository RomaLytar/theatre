<?php

use Illuminate\Database\Seeder;

class AttributesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $attributes = [
        'description',
        'email',
        'link',
        'phone',
        'file',
        'map_coordinates',
        'gallery',
      ];
      foreach($attributes as $attribute) {
        factory(\App\Models\Attribute::class, 'attribute', 1)->create(['name' => $attribute]);
      }
    }
}
