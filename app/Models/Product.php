<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // Pastikan 'category_id' sudah masuk ke dalam array ini
    protected $fillable = [
        'name',
        'qty',
        'price',
        'user_id',
        'category_id', // <--- Wajib ditambahkan
    ];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke Kategori: 1 Produk dimiliki oleh 1 Kategori (belongsTo)
    public function kategori()
    {
        // Sebutkan 'category_id' agar nyambung ke tabel categories
        return $this->belongsTo(Kategori::class, 'category_id');
    }
}