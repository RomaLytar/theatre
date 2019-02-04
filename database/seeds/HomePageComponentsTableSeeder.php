<?php

use Illuminate\Database\Seeder;

class HomePageComponentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      factory(\App\Models\HomePage::class, 'homepage_component1', 1)->create();
      factory(\App\Models\HomePage::class, 'homepage_component2', 1)->create();
      factory(\App\Models\HomePage::class, 'homepage_component3', 1)->create();
      factory(\App\Models\HomePage::class, 'homepage_component4', 1)->create();
    }
}
