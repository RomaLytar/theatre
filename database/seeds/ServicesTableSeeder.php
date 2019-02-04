<?php

use Illuminate\Database\Seeder;

class ServicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      factory(\App\Models\Service::class, 'service', 7)->create()->each(function($service) {
        for($i = 0; $i < rand(1, 4); $i++) {
          $service->addMedia(storage_path('111.png'))->preservingOriginal()->toMediaCollection('service-images');
        }
        $service->translate('en')->save(factory(\App\Models\ServiceTranslation::class, 'service_en')->make());
        $service->translate('ru')->save(factory(\App\Models\ServiceTranslation::class, 'service_ru')->make());
        $service->translate('ua')->save(factory(\App\Models\ServiceTranslation::class, 'service_ua')->make());
      });
    }
}
