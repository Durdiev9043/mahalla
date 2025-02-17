<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role = Role::create(['name' => 'admin']);
        $role1 = Role::create(['name' => 'operator']);
        $role2 = Role::create(['name' => 'xodim']);
        $role3 = Role::create(['name' => 'role1']);
        $role4 = Role::create(['name' => 'role2']);
        $role5 = Role::create(['name' => 'role3']);
        $role6 = Role::create(['name' => 'role4']);

        $permissions = [
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
            'product-list',
            'product-create',
            'product-edit',
            'product-delete'
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
        $permissions = Permission::pluck('id','id')->all();

        $role->syncPermissions($permissions);
        $role1->syncPermissions($permissions);

        $admin = User::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'phone' => '997484390',
            'password' => bcrypt('admin'),
            'role' => 1
        ]);
        $operator = User::create([
            'name' => 'operator',
            'email' => 'operator@admin.com',
            'phone' => '972114426',
            'password' => bcrypt('operator'),
            'district_id' => 183,
            'region_id' => 8,
            'role' => 2
        ]);

        $admin->assignRole([$role->id]);
        $operator->assignRole([$role1->id]);
    }
}
