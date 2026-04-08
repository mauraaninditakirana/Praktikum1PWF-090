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
    // 1. Buat akun Admin
    User::factory()->create([
        'name' => 'Maura Admin',
        'email' => 'admin@gmail.com',
        'password' => bcrypt('password'), // Password: password
        'role' => 'admin', // Ini role yang baru kita tambahkan
    ]);

    // 2. Buat akun User Biasa
    User::factory()->create([
        'name' => 'Maura User',
        'email' => 'user@gmail.com',
        'password' => bcrypt('password'), // Password: password
        'role' => 'user',
    ]);

    // 3. data dummy untuk Kategori & Product
    Kategori::factory(10)->create();
    Product::factory(20)->create();
    }
}