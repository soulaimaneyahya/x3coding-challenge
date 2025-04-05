<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Restaurant>
 */
class RestaurantFactory extends Factory
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
            'description' => fake()->sentence(50, true),
            'latitude' => fake()->randomFloat(8, -100, 100),
            'longitude' => fake()->randomFloat(8, -100, 100),
            'image_url' => fake()->randomElement([
                'restaurant-imgs/restaurant-img-1.png',
                'restaurant-imgs/restaurant-img-2.png',
                'restaurant-imgs/restaurant-img-3.png',
            ]),
        ];
    }
}
