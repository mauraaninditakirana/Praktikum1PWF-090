<?php

namespace Database\Factories;

use App\Models\Product; 
use Illuminate\Database\Eloquent\Factories\Factory;

class KategoriFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->randomElement([
                'Elektronik',
                'Pakaian',
                'Makanan',
                'Otomotif',
                'Perabotan',
                'Olahraga',
            ]),
            'product_id' => Product::all()->random()->id,        
        ];
    }
}