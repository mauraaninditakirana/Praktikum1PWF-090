<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    // Menghubungkan model Kategori dengan tabel 'categories' di database
    protected $table = 'categories';

    // Yang boleh diisi dari form hanya 'name'
    protected $fillable = [
        'name',
    ];

    // Relasi yang benar: 1 Kategori memiliki BANYAK Produk (hasMany)
    public function products()
    {
        // Kita sebutkan 'category_id' secara eksplisit agar Laravel tidak bingung
        return $this->hasMany(Product::class, 'category_id');
    }
}