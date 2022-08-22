<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\JobRequest>
 */
class JobRequestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id'              => User::factory()->has(UserProfile::factory()->approved()->count(1))->create(),
            'category_id'          => $this->faker->numberBetween(1, 161),
            'prefecture_id'        => $this->faker->numberBetween(1, 47),
            'title'                => $this->faker->realText(30),
            'content'              => $this->faker->realText(3000),
            'price'                => $this->faker->numberBetween(500, 9990000),
            'application_deadline' => $this->faker->date(),
            'required_date'        => $this->faker->date(),
            'is_online'            => $this->faker->boolean,
            'is_call'              => $this->faker->boolean,
            'is_draft'             => $this->faker->boolean,
            'status'               => $this->faker->numberBetween(1, 2),
        ];
    }
}
