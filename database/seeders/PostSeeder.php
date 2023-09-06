<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->createUsersPost();
//        $this->createParticularUsersPost(User::orderBy('id', 'DESC')->first(), 30);
    }

    public function createUsersPost() {
        $users = User::whereIsAdmin(false)->get();

        if (!empty($users)) {
            foreach ($users as $user) {
                Post::factory(20)
                    ->withUser($user)
                    ->create();
            }
        }
    }

    public function createParticularUsersPost($user, $numberOfPosts) {

        Post::factory($numberOfPosts)
            ->withUser($user)
            ->create();
    }
}
