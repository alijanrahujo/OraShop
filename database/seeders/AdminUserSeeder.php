<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions
        $permissions = [
            'create posts',
            'edit posts',
            'delete posts',
            'publish posts',
            'unpublish posts',
            // Add other permissions as needed
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Create roles and assign existing permissions
        $adminRole = Role::firstOrCreate(['name' => 'Admin']);
        $adminRole->syncPermissions($permissions);

        // Create admin user
        $adminUser = User::firstOrCreate(
            ['email' => 'admin@orasoft.pk'],
            [
                'name' => 'Admin',
                'password' => bcrypt('12345678'), // Change 'password' to a secure password
            ]
        );

        // Assign role to admin user
        if (!$adminUser->hasRole('Admin')) {
            $adminUser->assignRole($adminRole);
        }
    }
}
