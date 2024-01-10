<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class PermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Create default permissions
        Permission::create(['name' => 'list attachments']);
        Permission::create(['name' => 'view attachments']);
        Permission::create(['name' => 'create attachments']);
        Permission::create(['name' => 'update attachments']);
        Permission::create(['name' => 'delete attachments']);

        Permission::create(['name' => 'list channels']);
        Permission::create(['name' => 'view channels']);
        Permission::create(['name' => 'create channels']);
        Permission::create(['name' => 'update channels']);
        Permission::create(['name' => 'delete channels']);

        Permission::create(['name' => 'list chats']);
        Permission::create(['name' => 'view chats']);
        Permission::create(['name' => 'create chats']);
        Permission::create(['name' => 'update chats']);
        Permission::create(['name' => 'delete chats']);

        Permission::create(['name' => 'list conversations']);
        Permission::create(['name' => 'view conversations']);
        Permission::create(['name' => 'create conversations']);
        Permission::create(['name' => 'update conversations']);
        Permission::create(['name' => 'delete conversations']);

        Permission::create(['name' => 'list userconversations']);
        Permission::create(['name' => 'view userconversations']);
        Permission::create(['name' => 'create userconversations']);
        Permission::create(['name' => 'update userconversations']);
        Permission::create(['name' => 'delete userconversations']);

        // Create user role and assign existing permissions
        $currentPermissions = Permission::all();
        $userRole = Role::create(['name' => 'user']);
        $userRole->givePermissionTo($currentPermissions);

        // Create admin exclusive permissions
        Permission::create(['name' => 'list roles']);
        Permission::create(['name' => 'view roles']);
        Permission::create(['name' => 'create roles']);
        Permission::create(['name' => 'update roles']);
        Permission::create(['name' => 'delete roles']);

        Permission::create(['name' => 'list permissions']);
        Permission::create(['name' => 'view permissions']);
        Permission::create(['name' => 'create permissions']);
        Permission::create(['name' => 'update permissions']);
        Permission::create(['name' => 'delete permissions']);

        Permission::create(['name' => 'list users']);
        Permission::create(['name' => 'view users']);
        Permission::create(['name' => 'create users']);
        Permission::create(['name' => 'update users']);
        Permission::create(['name' => 'delete users']);

        // Create admin role and assign all permissions
        $allPermissions = Permission::all();
        $adminRole = Role::create(['name' => 'super-admin']);
        $adminRole->givePermissionTo($allPermissions);

        $user = \App\Models\User::whereEmail('admin@admin.com')->first();

        if ($user) {
            $user->assignRole($adminRole);
        }
    }
}
