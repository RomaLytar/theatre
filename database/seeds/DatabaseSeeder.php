<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CountriesTableSeeder::class);
        $this->call(PermissionsTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(ActorGroupsTableSeeder::class);
        $this->call(ActorsTableSeeder::class);
        $this->call(PerformanceTypesTableSeeder::class);
        $this->call(PerformancesTableSeeder::class);
        $this->call(ArticleCategoriesTableSeeder::class);
        $this->call(ArticlesTableSeeder::class);
        $this->call(BannersTableSeeder::class);
        $this->call(HomePageComponentsTableSeeder::class);
        $this->call(SeasonsTableSeeder::class);
        $this->call(SettingsTableSeeder::class);
        $this->call(AlbumCategoriesTableSeeder::class);
        $this->call(AlbumsTableSeeder::class);
        $this->call(VideoCategoriesTableSeeder::class);
        $this->call(VideosTableSeeder::class);
        $this->call(AttributesTableSeeder::class);
        $this->call(PagesTableSeeder::class);
        $this->call(FaqCategoriesTableSeeder::class);
        $this->call(FaqTableSeeder::class);
        $this->call(EbooksTableSeeder::class);
        $this->call(DocumentationCategoriesTableSeeder::class);
        $this->call(DocumentationsTableSeeder::class);
        $this->call(ServicesTableSeeder::class);
        $this->call(ProjectCategoriesTableSeeder::class);
        $this->call(ProjectsTableSeeder::class);
        $this->call(VacanciesTableSeeder::class);
        $this->call(ProgramsTableSeeder::class);
        $this->call(ColorsTableSeeder::class);
        $this->call(HallsTableSeeder::class);
        $this->call(DistributorsTableSeeder::class);
    }
}
