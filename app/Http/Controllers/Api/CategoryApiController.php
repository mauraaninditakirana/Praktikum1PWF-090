<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// PERUBAHAN PENTING: Menggunakan model Kategori milikmu, bukan Category
use App\Models\Kategori; 

class CategoryApiController extends Controller
{
    public function index()
    {
        // Mengambil semua kategori beserta jumlah produknya
        $categories = Kategori::withCount('products')->get();
        return response()->json(['message' => 'Success', 'data' => $categories], 200);
    }

    public function store(Request $request)
    {
        // Pengecekan role, misal hanya admin yang boleh tambah kategori
        if (Auth::user()->role !== 'admin') {
            return response()->json(['message' => 'Hanya admin yang boleh menambah kategori'], 403);
        }

        // PERUBAHAN: Validasi unique disesuaikan langsung ke model Kategori
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:App\Models\Kategori,name'
        ]);

        $category = Kategori::create($validated);
        return response()->json(['message' => 'Kategori berhasil ditambahkan', 'data' => $category], 201);
    }

    public function show($id)
    {
        // Mengambil kategori beserta data produk di dalamnya
        $category = Kategori::with('products')->find($id);
        
        if (!$category) {
            return response()->json(['message' => 'Kategori tidak ditemukan'], 404);
        }
        return response()->json(['message' => 'Success', 'data' => $category], 200);
    }

    public function update(Request $request, $id)
    {
        if (Auth::user()->role !== 'admin') {
            return response()->json(['message' => 'Hanya admin yang boleh mengubah kategori'], 403);
        }

        $category = Kategori::find($id);
        if (!$category) {
            return response()->json(['message' => 'Kategori tidak ditemukan'], 404);
        }

        // PERUBAHAN: Validasi unique disesuaikan ke model Kategori
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:App\Models\Kategori,name,' . $id
        ]);

        $category->update($validated);
        return response()->json(['message' => 'Kategori berhasil diubah', 'data' => $category], 200);
    }

    public function destroy($id)
    {
        if (Auth::user()->role !== 'admin') {
            return response()->json(['message' => 'Hanya admin yang boleh menghapus kategori'], 403);
        }

        $category = Kategori::find($id);
        if (!$category) {
            return response()->json(['message' => 'Kategori tidak ditemukan'], 404);
        }

        $category->delete();
        return response()->json(['message' => 'Kategori berhasil dihapus'], 200);
    }
}