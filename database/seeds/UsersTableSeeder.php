<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(env('APP_DEBUG') === true) {
            $users = \App\Models\User::withTrashed()->get();
            foreach ($users as $user) {
                $user->forceDelete();
            }
        }

        factory(\App\Models\User::class, 's-user', 1)->create()->each(function($user) {
            $user->assignRole('super-admin');
        });
        factory(\App\Models\User::class, 'admin', 1)->create()->each(function($user) {
            $user->assignRole('admin');
        });
        factory(\App\Models\User::class, 'user', 1)->create()->each(function($user) {
            $user->assignRole('user');
        });
    }
}
