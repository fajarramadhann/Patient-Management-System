<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Role::create(['name' => 'admin']);
        Role::create(['name' => 'customer']);
        Role::create(['name' => 'panel_user']);

        $roleAdmin = Role::findByName('admin');
        $roleUser = Role::findByName('customer');

        $roleAdmin->givePermissionTo('admin');
        $roleUser->givePermissionTo('customer');
    }
}
