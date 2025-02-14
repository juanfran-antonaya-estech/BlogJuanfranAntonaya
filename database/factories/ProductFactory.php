<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->text(20),
            'description' => $this->faker->text(200),
            'quantity' => $this->faker->numberBetween(1, 100),
            'status' => $this->faker->boolean(),
            'user_id' => User::all()->random()->id,
        ];
    }
}
