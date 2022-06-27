<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Admin>
 */
class AdminFactory extends Factory
{
    /**
     * Define the model's default state.
     * 使い方：Admin::factory()->create()
     * 
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name'              => $this->faker->name(),
            'email'             => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password'          => '$2y$10$s.7YK6I7yLqgpuEcMlKAyeQzBEAkyjNn.SyD0yFBv/V2FDX5zOqAW', // 12345678
            'remember_token'    => Str::random(10),
            'role'              => 1,
        ];
    }
}
