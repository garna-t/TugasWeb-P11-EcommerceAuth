<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        app(PermissionRegistrar::class)->forgetCachedPermissions();

        $adminRole = Role::firstOrCreate([
            'name' => 'admin',
            'guard_name' => 'web',
        ]);

        $editorRole = Role::firstOrCreate([
            'name' => 'editor',
            'guard_name' => 'web',
        ]);

        $userRole = Role::firstOrCreate([
            'name' => 'user',
            'guard_name' => 'web',
        ]);

        $permissions = collect([
            'ViewAny:Product',
            'View:Product',
            'Create:Product',
            'Update:Product',
            'Delete:Product',
        ])->map(fn (string $name) => Permission::firstOrCreate([
            'name' => $name,
            'guard_name' => 'web',
        ]));

        $adminRole->syncPermissions($permissions);

        $editorRole->syncPermissions(
            $permissions->filter(fn ($permission) => in_array($permission->name, [
                'ViewAny:Product',
                'View:Product',
                'Create:Product',
                'Update:Product',
            ], true))
        );

        $userRole->syncPermissions(
            $permissions->filter(fn ($permission) => in_array($permission->name, [
                'ViewAny:Product',
                'View:Product',
                'Create:Product',
            ], true))
        );
    }
}