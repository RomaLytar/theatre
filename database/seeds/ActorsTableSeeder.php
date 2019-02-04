<?php

use Illuminate\Database\Seeder;

class ActorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      factory(\App\Models\Actor::class, 'actor', 20)->create()->each(function($actor) {
        $actor->images()->save(factory(\App\Models\Image::class, 'actor')->make());
        $actor->images()->save(factory(\App\Models\Image::class, 'actor')->make());
        $actor->images()->save(factory(\App\Models\Image::class, 'actor')->make());
        $actor->videos()->save(factory(\App\Models\Video::class, 'actor')->make());
        $actor->videos()->save(factory(\App\Models\Video::class, 'actor')->make());
        $actor->translate('en')->save(factory(\App\Models\ActorTranslation::class, 'actor_en')->make());
        $actor->translate('ru')->save(factory(\App\Models\ActorTranslation::class, 'actor_ru')->make());
        $actor->translate('ua')->save(factory(\App\Models\ActorTranslation::class, 'actor_ua')->make());
      });
    }
}
