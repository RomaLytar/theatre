<?php

use Illuminate\Database\Seeder;

class BannersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\Banner::class, 'banner', 2)->create()->each(function($banner) {
            $banner->addMedia(storage_path('111.png'))->preservingOriginal()->toMediaCollection('posters');
            $banner->translate('en')->save(factory(\App\Models\BannerTranslation::class, 'banner_en')->make());
            $banner->translate('ru')->save(factory(\App\Models\BannerTranslation::class, 'banner_ru')->make());
            $banner->translate('ua')->save(factory(\App\Models\BannerTranslation::class, 'banner_ua')->make());
        });
    }
}
