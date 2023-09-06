<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->createAdminUser();
        $this->createRegularUser();
        $this->createActiveUsers(30);
        $this->createInActiveUsers(30);
    }

    public function createAdminUser() {
        User::factory()
            ->withName('Admin')
            ->withEmail('admin@admin.com')
            ->withAdmin(true)
            ->withActive(true)
            ->create();
    }

    public function createRegularUser() {
        User::factory()
            ->withName('User')
            ->withEmail('user@user.com')
            ->withActive(true)
            ->create();
    }

    public function createActiveUsers($numberOfUsers) {
        User::factory($numberOfUsers)
            ->withActive(true)
            ->create();
    }

    public function createInActiveUsers($numberOfUsers) {
        User::factory($numberOfUsers)->create();
    }
}
