<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            'super-admin',
            'admin',
            'user',
        ];

        if(env('APP_DEBUG') === true) {
            \Spatie\Permission\Models\Role::query()->truncate();
        }

        foreach ($roles as $role) {
            Spatie\Permission\Models\Role::create(['name' => $role]);
        }

        $roles = \Spatie\Permission\Models\Role::where('name', 'admin')->get();
        $permissions = \Spatie\Permission\Models\Permission::select('name')->get()->toArray();
        foreach ($roles as $role) {
            $role->givePermissionTo($permissions);
        }
    }
}
