<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $numberOfUsers = 2;
        for ($i = 0; $i<$numberOfUsers; $i++){
            \App\Models\User::create([
                'name' => $i == 0 ? 'admin' : 'user',
                'email' => $i == 0 ? 'admin@admin.com' : 'user@user.com',
                'email_verified_at' => now(),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'is_admin' => $i == 0 ?? false,
                'remember_token' => Str::random(10),
            ]);
        }
    }
}
