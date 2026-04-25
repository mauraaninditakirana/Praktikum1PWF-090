<?php

namespace App\Http\Controllers;

use App\Models\Kategori; // Pastikan sesuai nama Model kamu (Kategori atau Category)
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        // Mengambil semua kategori dan menghitung jumlah produk di setiap kategori
        $categories = Kategori::withCount('products')->get();
        
        return view('category.index', compact('categories'));
    }

    public function create()
    {
        return view('category.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories,name|max:255',
        ]);

        Kategori::create($request->all());

        return redirect()->route('category.index')->with('success', 'Kategori berhasil ditambahkan!');
    }
    
    // ... method lainnya (edit, update, destroy) bisa menyusul
}