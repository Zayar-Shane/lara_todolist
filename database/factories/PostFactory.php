<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $arr = ['pyay', 'mogok', 'yangon', 'mandalay', 'bago'];
        return [
            'title' => $this->faker->sentence(9),
            'description' => $this->faker->paragraph(10),
            'price' => rand(2000, 9000),
            'address' => $arr[array_rand(['pyay', 'mogok', 'yangon', 'mandalay', 'bago'])],
            'rating' => rand(0, 5),
        ];
    }
}
