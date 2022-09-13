<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory
 */
class UserNotificationSettingFactory extends Factory
{
    /**
     * Define the model's default state.
     * 使い方：UserNotificationSetting::factory()->create()
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id'    => User::factory(),
            'is_like'    => 0,
            'is_news'    => 0,
            'is_message' => 0,
            'is_posting' => 0,
            'is_fav'     => 0,
        ];
    }
}
