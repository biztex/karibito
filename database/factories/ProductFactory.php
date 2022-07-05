<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     * 使い方：Product::factory()->create()
     * 
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id'        => User::factory()->has(UserProfile::factory()->approved()->count(1))->create(),
            'category_id'    => $this->faker->numberBetween(1, 161),
            'prefecture_id'  => $this->faker->numberBetween(1, 47),
            'title'          => $this->faker->realText(30),
            'content'        => $this->faker->realText(3000),
            'price'          => $this->faker->numberBetween(500, 9990000),
            'is_online'      => $this->faker->boolean,
            'number_of_day'  => $this->faker->numberBetween(1, 100),
            'is_call'        => $this->faker->boolean,
            'number_of_sale' => $this->faker->randomElement([0, 99]),
            'is_draft'       => $this->faker->boolean,
            'status'         => $this->faker->numberBetween(1, 2),
        ];
    }
}
