<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Teacher;
use App\Models\User;

class TeacherSeeder extends Seeder
{
    public function run(): void
    {
        // Try to attach teacher record to existing admin user if present
        $user = User::where('email', 'admin@gmail.com')->first();

        if ($user && ! Teacher::where('user_id', $user->id)->exists()) {
            Teacher::create([
                'user_id' => $user->id,
                'is_active' => true,
            ]);
        }

        // If no admin user, optionally create a dummy user and teacher
        if (! $user) {
            $user = User::create([
                'name' => 'Demo Teacher',
                'email' => 'teacher@example.com',
                'password' => bcrypt('password'),
            ]);

            Teacher::create([
                'user_id' => $user->id,
                'is_active' => true,
            ]);
        }
    }
}
