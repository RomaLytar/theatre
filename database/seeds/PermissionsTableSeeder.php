<?php

use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'admin-browse',

            'home-page-list',
            'home-page-edit',

            'performance-list',
            'performance-create',
            'performance-edit',
            'performance-delete',
            'performance-actor-role-edit',

            'performance-type-list',
            'performance-type-create',
            'performance-type-edit',
            'performance-type-delete',

            'festival-list',
            'festival-create',
            'festival-edit',
            'festival-delete',

            'actor-list',
            'actor-create',
            'actor-edit',
            'actor-delete',
            'actor-group-list',
            'actor-group-create',
            'actor-group-edit',
            'actor-group-delete',
            'actor-role-list',
            'actor-role-create',
            'actor-role-edit',
            'actor-role-delete',

            'article-list',
            'article-create',
            'article-edit',
            'article-delete',

            'article-category-list',
            'article-category-create',
            'article-category-edit',
            'article-category-delete',

            'faq-list',
            'faq-create',
            'faq-edit',
            'faq-delete',
            'faq-category-list',
            'faq-category-create',
            'faq-category-edit',
            'faq-category-delete',

            'e-book-list',
            'e-book-create',
            'e-book-edit',
            'e-book-delete',

            'feed-back-list',
            'feed-back-edit',
            'feed-back-delete',

            'doc-list',
            'doc-create',
            'doc-edit',
            'doc-delete',

            'doc-category-list',
            'doc-category-create',
            'doc-category-edit',
            'doc-category-delete',

            'hall-list',
            'hall-edit',
            'hall-seat-image-edit',
            'hall-seat-best-choice-edit',

            'service-list',
            'service-create',
            'service-edit',
            'service-delete',

            'project-list',
            'project-create',
            'project-edit',
            'project-delete',
            'project-category-list',
            'project-category-create',
            'project-category-edit',
            'project-category-delete',

            'program-list',
            'program-create',
            'program-edit',
            'program-delete',

            'banner-list',
            'banner-edit',

            'vacancy-list',
            'vacancy-create',
            'vacancy-edit',
            'vacancy-delete',

            'season-list',
            'season-create',
            'season-edit',
            'season-delete',

            'album-list',
            'album-create',
            'album-edit',
            'album-delete',

            'album-category-list',
            'album-category-create',
            'album-category-edit',
            'album-category-delete',

            'video-list',
            'video-create',
            'video-edit',
            'video-delete',

            'video-category-list',
            'video-category-create',
            'video-category-edit',
            'video-category-delete',

            'partner-list',
            'partner-create',
            'partner-edit',
            'partner-delete',

            'partner-category-list',
            'partner-category-create',
            'partner-category-edit',
            'partner-category-delete',

            'page-list',
            'page-edit',
            'page-delete',
            'attribute-list',

            'subscriber-list',
            'subscriber-delete',

            'menu-item-list',
            'menu-item-create',
            'menu-item-edit',
            'menu-item-delete',

            'user-list',
            'user-create',
            'user-show',
            'user-edit',
            'user-delete',
            'user-role-list',
            'user-role-create',
            'user-role-edit',
            'user-role-delete',
            'user-permission-list',

            'setting-list',
            'setting-create',
            'setting-edit',
            'setting-delete',

            'translation-list',

            'price-pattern-list',
            'price-pattern-create',
            'price-pattern-show',
            'price-pattern-edit',
            'price-pattern-delete',

            'hall-price-pattern-list',
            'hall-price-pattern-create',
            'hall-price-pattern-show',
            'hall-price-pattern-edit',
            'hall-price-pattern-delete',

            'distributor-list',
            'distributor-create',
            'distributor-edit',
            'distributor-delete',

            'event-manage',

            'tickets-sold',

            'report-list',
            'report-list-own',
            'report-list-total',

            'ticket-designer-manage',

            'ticket-activation',

            'donation-list',
        ];

        if(env('APP_DEBUG') === true) {
            \Spatie\Permission\Models\Permission::query()->truncate();
        }

        foreach ($permissions as $permission) {
            Spatie\Permission\Models\Permission::create(['name' => $permission]);
        }
    }
}
