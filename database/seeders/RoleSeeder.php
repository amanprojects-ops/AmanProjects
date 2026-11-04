<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            'manage-profile',
            'manage-skills',
            'manage-projects',
            'manage-experience',
            'manage-education',
            'manage-posts',
            'manage-categories',
            'manage-contacts',
            'manage-social-links',
            'manage-settings',
            'manage-users',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        $superAdmin = Role::firstOrCreate(['name' => 'super-admin'], ['description' => 'Full access to everything']);
        $admin = Role::firstOrCreate(['name' => 'admin'], ['description' => 'Administrative access']);
        $editor = Role::firstOrCreate(['name' => 'editor'], ['description' => 'Content management only']);

        $superAdmin->permissions()->sync(Permission::all());

        $adminPermissions = Permission::whereNotIn('name', ['manage-users'])->get();
        $admin->permissions()->sync($adminPermissions);

        $editorPermissions = Permission::whereIn('name', [
            'manage-profile',
            'manage-skills',
            'manage-projects',
            'manage-experience',
            'manage-education',
            'manage-posts',
            'manage-categories',
            'manage-social-links',
        ])->get();
        $editor->permissions()->sync($editorPermissions);
    }
}
