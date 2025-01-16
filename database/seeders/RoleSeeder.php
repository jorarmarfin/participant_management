<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create(['name' => 'super admin']);
        $administrator = Role::create(['name' => 'administrator']);
        $boss = Role::create(['name' => 'boss']);

        Permission::create(['name' => 'menu administrator'])->syncRoles([$administrator, $boss]);
        Permission::create(['name' => 'menu boss'])->syncRoles([$boss]);


    }

}
