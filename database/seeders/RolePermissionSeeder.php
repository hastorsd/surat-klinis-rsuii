<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // buat permission
        Permission::create(['name' => 'upload-surat']);
        Permission::create(['name' => 'delete-surat']);

        // buat role dan berikan permission
        $adminRole = Role::create(['name' => 'admin']);
        $adminRole->givePermissionTo(['upload-surat', 'delete-surat']);

        // buat user admin dummy
        $user = User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@rs.com'
        ]);

        $user->assignRole($adminRole);
    }
}
