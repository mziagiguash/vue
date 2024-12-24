<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Permission;
use App\Models\User;

class PermissionRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Создание ролей
        $adminRole = Role::firstOrCreate(['id' => 3, 'name' => 'admin']);
        $managerRole = Role::firstOrCreate(['id' => 2, 'name' => 'manager']);
        $userRole = Role::firstOrCreate(['id' => 1, 'name' => 'user']);

        // Создание разрешений
        $viewPostsPermission = Permission::firstOrCreate(['name' => 'view posts']);
        $editPostsPermission = Permission::firstOrCreate(['name' => 'edit posts']);
        $manageUsersPermission = Permission::firstOrCreate(['name' => 'manage users']);

        // Связь ролей и разрешений
        $adminRole->permissions()->sync([$viewPostsPermission->id, $editPostsPermission->id, $manageUsersPermission->id]);
        $managerRole->permissions()->sync([$viewPostsPermission->id, $editPostsPermission->id]);
        $userRole->permissions()->sync([$viewPostsPermission->id]);

        // Создание пользователей и назначение ролей
        $adminUser = User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
        ]);
        $adminUser->roles()->attach($adminRole->id);

        $managerUser = User::create([
            'name' => 'Manager User',
            'email' => 'manager@example.com',
            'password' => bcrypt('password'),
        ]);
        $managerUser->roles()->attach($managerRole->id);

        $normalUser = User::create([
            'name' => 'Normal User',
            'email' => 'user@example.com',
            'password' => bcrypt('password'),
        ]);
        $normalUser->roles()->attach($userRole->id);
    }
}
