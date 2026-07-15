<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Buat role
        $ownerRole   = Role::create(['name' => 'owner']);
        $studentRole = Role::create(['name' => 'student']);
        $teacherRole = Role::create(['name' => 'teacher']);

        // Buat akun superadmin/owner
        $user = User::create([
            'name'       => 'Super Admin',
            'email'      => 'admin@gmail.com',
            'occupation' => 'Owner',
            'avatar'     => 'images/avatar-default.png',
            'password'   => Hash::make('password'),
        ]);

        // Assign role owner ke user tersebut
        $user->assignRole($ownerRole);
    }
}