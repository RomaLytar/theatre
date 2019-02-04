<?php

use Illuminate\Database\Seeder;

class PagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $pages = [
        'mission-and-goals',
        'history',
        'friends-club',
        'press-service',
        'promo-opera',
        'contacts',
        'advertising-opportunities',
        'collective-visit',
        'visiting-rules',
        'leave-inheritance',
        'corporate-sponsorship',
        'offstage',
        'friends-maecenas',
        'helpful-job',
        'contests',
        'halls',
        'where-to-go',
        'support',
        'education',
        'board-of-trustees',
        'join-the-league-of-patrons',
        'join-the-club',
        'excursion',
        'other',
        'tour-video',
        'special-needs',
        'visit-holiday',
        'virtual-tour',
        'custom-programs',
        'season-premiere',
        'tour-schedule',
        'special-events',
        'muzhab',
        'festivals',
        'educational-programs',
        'international-partnership',
        'where-are-we',
      ];
      foreach($pages as $pageName) {
        factory(\App\Models\Page::class, 'page', 1)->create(['name' => $pageName])->each(function($page) use ($pageName)  {
          $page->addMedia(storage_path('111.png'))->preservingOriginal()->toMediaCollection('posters');
          $page->translate('en')->save(factory(\App\Models\PageTranslation::class, 'page_en')->create(['page_id' => $page->id, 'title' => $pageName]));
          $page->translate('ru')->save(factory(\App\Models\PageTranslation::class, 'page_ru')->create(['page_id' => $page->id, 'title' => $pageName]));
          $page->translate('ua')->save(factory(\App\Models\PageTranslation::class, 'page_ua')->create(['page_id' => $page->id, 'title' => $pageName]));
        });
      }
    }
}
