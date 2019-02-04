<?php

use Illuminate\Database\Seeder;

class ProjectCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $categories = [
        'friends-maecenas',
        'helpful-job',
        'contests',
        'education',
        'opera-projects',
        'creative',
        'international-partnership',
      ];
        foreach ($categories as $category) {
          factory(App\Models\ProjectCategory::class, 'project_category', 1)->create(['name' =>$category])->each(function ($project) use ($category) {
            $project->translate('en')->save(factory(App\Models\ProjectCategoryTranslation::class, 'project_category_en')
              ->create(['project_cat_id' => $project->id, 'title' => $category]));
            $project->translate('ru')->save(factory(App\Models\ProjectCategoryTranslation::class, 'project_category_ru')
              ->create(['project_cat_id' => $project->id, 'title' => $category]));
            $project->translate('ua')->save(factory(App\Models\ProjectCategoryTranslation::class, 'project_category_ua')
              ->create(['project_cat_id' => $project->id, 'title' => $category]));
          });
        }
      }
}
