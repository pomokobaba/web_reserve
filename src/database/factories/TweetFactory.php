<?php

namespace Database\Factories;
use Carbon\Carbon;

use Illuminate\Database\Eloquent\Factories\Factory;

class TweetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => 1,
            'content' => $this->faker->realText(100),
            'created_at' => Carbon::now()->yesterday()
        ];
    }
}
