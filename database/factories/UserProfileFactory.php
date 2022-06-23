<?php

namespace Database\Factories;

use App\Models\User;
use Faker\Provider\DateTime;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserProfile>
 */
class UserProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     * 使い方：UserProfile::factory()->create()
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id'             => User::factory(),
            'first_name'          => $this->faker->lastName(),
            'last_name'           => $this->faker->firstName(),
            'gender'              => $this->faker->numberBetween(1, 2),
            'prefecture_id'       => $this->faker->numberBetween(1, 47),
            'birthday'            => DateTime::dateTimeThisDecade(),
            'zip'                 => $this->faker->postcode,
            'address'             => $this->faker->address,
            'introduction'        => $this->faker->sentence(),
            'identification_path' => null,
            'is_identify'         => $this->faker->boolean,
        ];
    }

    /**
     * 認証済みユーザー
     * 使い方：UserProfile::factory()->approved()->create()
     * @return static
     */
    public function approved()
    {
        return $this->state(function (array $attributes) {
            return [
                'identification_path' => null,
                'is_identify'         => 0,
            ];
        });
    }
}
