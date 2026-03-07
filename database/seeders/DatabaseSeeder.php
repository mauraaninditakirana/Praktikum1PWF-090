<?php
namespace Database\Seeders;

use App\Models\Kategori;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
        
        Product::factory(20)->create();
        Kategori::factory(10)->create();
    }
}