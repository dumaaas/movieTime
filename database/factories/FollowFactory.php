<?php

namespace Database\Factories;

use App\Follow;
use App\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class FollowFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Follow::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::all()->unique()->random()->id,
            'following_user_id' => User::all()->unique()->random()->id,
            'created_at' => now()
        ];
    }
}
