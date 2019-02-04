<?php

use Illuminate\Database\Seeder;

class ProgramsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      factory(\App\Models\Program::class, 'program', 5)->create()->each(function($program) {
        $program->addMedia(storage_path('111.png'))->preservingOriginal()->toMediaCollection('posters');
        $program->translate('en')->save(factory(\App\Models\ProgramTranslation::class, 'program_en')->make());
        $program->translate('ru')->save(factory(\App\Models\ProgramTranslation::class, 'program_ru')->make());
        $program->translate('ua')->save(factory(\App\Models\ProgramTranslation::class, 'program_ua')->make());
      });
    }
}
