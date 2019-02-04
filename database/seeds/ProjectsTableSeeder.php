<?php

use Illuminate\Database\Seeder;

class ProjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\Project::class, 'project', 40)->create()->each(function($project) {
          $project->addMedia(storage_path('111.png'))->preservingOriginal()->toMediaCollection('posters');
          $project->translate('en')->save(factory(\App\Models\ProjectTranslation::class, 'project_en')->make());
          $project->translate('ru')->save(factory(\App\Models\ProjectTranslation::class, 'project_ru')->make());
          $project->translate('ua')->save(factory(\App\Models\ProjectTranslation::class, 'project_ua')->make());
        });
    }
}
