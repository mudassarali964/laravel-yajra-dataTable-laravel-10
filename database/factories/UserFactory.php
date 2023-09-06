<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'is_admin' => false,
            'is_active' => false,
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }

    /**
     * Indicate that the user should have a specific name.
     *
     * @param  string  $name
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function withName(string $name)
    {
        return $this->state(fn (array $attributes) => [
            'name' => $name,
        ]);
    }

    /**
     * Indicate that the user should have a specific email.
     *
     * @param  string  $email
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function withEmail(string $email)
    {
        return $this->state(fn (array $attributes) => [
            'email' => $email,
        ]);
    }

    /**
     * Indicate that the user should have a specific password.
     *
     * @param  string  $password
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function withPassword(string $password)
    {
        $password = Hash::make($password);

        return $this->state(fn (array $attributes) => [
            'password' => $password,
        ]);
    }

    /**
     * Indicate that the user should have a specific password.
     *
     * @param  string  $isAdmin
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function withAdmin(string $isAdmin)
    {
        return $this->state(fn (array $attributes) => [
            'is_admin' => $isAdmin ?? false,
        ]);
    }

    /**
     * Indicate that the user should have a specific password.
     *
     * @param  string  $isActive
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function withActive(string $isActive)
    {
        return $this->state(fn (array $attributes) => [
            'is_active' => $isActive ?? false,
        ]);
    }
}
