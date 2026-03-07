<?php

namespace Database\Factories;

use App\Models\User; 
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::all()->random()->id,
            'name' => $this->faker->words(2, true),
            'qty' => $this->faker->numberBetween(1, 100), 
            'price' => $this->faker->numberBetween(10000, 1000000), 
        ];
    }
}