<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AdditionalOption>
 */
class AdditionalOptionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'product_id' => Product::factory()->create(),
            'name'       => $this->faker->name(),
            'price'      => $this->faker->numberBetween(0, 10),
            'is_public'  => $this->faker->boolean,
        ];
    }
}
