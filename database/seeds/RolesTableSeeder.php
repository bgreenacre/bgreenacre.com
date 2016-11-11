<?php

use Illuminate\Database\Seeder;
use Bgreenacre\Roles\RoleModel;

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
            [
                'name' => 'Admin',
                'slug' => 'admin',
            ],
            [
                'name' => 'Author',
                'slug' => 'author',
            ],
            [
                'name' => 'Subscriber',
                'slug' => 'subscriber',
            ],
        ];

        foreach ($roles as $role)
        {
            $roleName  = array_get($role, 'name');
            $roleAdded = (bool) DB::table('roles')
                ->where('name', $roleName)
                ->take(1)
                ->count();

            if ($roleAdded === false)
            {
                RoleModel::create($role);
            }
        }
    }
}
