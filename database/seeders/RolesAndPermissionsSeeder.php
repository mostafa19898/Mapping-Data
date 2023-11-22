<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Seeder;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Roles
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'user']);

        // Permissions
        Permission::create(['name' => 'create data']);
        Permission::create(['name' => 'edit data']);
        Permission::create(['name' => 'delete data']);

        // Assign permissions to roles
        //$adminRole = Role::findByName('admin');
        //$adminRole->givePermissionTo('create data', 'edit data', 'delete data');
    }
}
