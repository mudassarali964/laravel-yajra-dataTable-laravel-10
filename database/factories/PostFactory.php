<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->title(),
            'description' => fake()->text(),
            'user_id' => $this->withUser()
        ];
    }

    /**
     * Indicate that the user should have a specific user.
     *
     * @param  mixed  $user
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function withUser($user = null)
    {
        if ($user instanceof \App\Models\User) {
            $user = $user->id;
        }

        return $this->state(fn (array $attributes) => [
            'user_id' => is_null($user)
                ? User::factory()->create()
                : $user,
        ]);
    }
}
