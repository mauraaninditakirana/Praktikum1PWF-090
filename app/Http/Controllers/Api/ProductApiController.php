<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Import Model dan Request yang dibutuhkan
use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest; // Ditambahkan agar update tidak error
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ProductApiController extends Controller
{
    /**
     * TUGAS 1: GET (Menampilkan semua produk)
     */
    public function index()
    {
        // Mengambil semua produk beserta data kategorinya
        $products = Product::with('category')->get();

        return response()->json([
            'message' => 'Success',
            'data' => $products
        ], 200);
    }

    /**
     * Menyimpan produk (Sudah dari modul)
     */
    public function store(StoreProductRequest $request)
    {
        try {
            $validated = $request->validated();
            $validated['user_id'] = Auth::id(); // Menyimpan ID user yang sedang login

            $product = Product::create($validated);

            Log::info('Menambah data produk', ['list' => $product]);

            return response()->json([
                'message' => 'Produk berhasil ditambahkan!!',
                'data' => $product,
            ], 201);
        } catch (\Throwable $e) {
            Log::error('Error saat menambah product', ['message' => $e->getMessage()]);

            return response()->json([
                'message' => 'Terjadi kesalahan pada server',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Menampilkan 1 produk spesifik (Sudah dari modul)
     */
    public function show(int $id)
    {
        try {
            $product = Product::with('category')->find($id);

            if (!$product) {
                return response()->json(['message' => 'Product tidak ditemukan'], 404);
            }

            return response()->json([
                'message' => 'Product retrieved successfully',
                'data' => $product
            ], 200);
        } catch (\Throwable $e) {
            Log::error('Gagal mengambil data produk', ['message' => $e->getMessage()]);
            return response()->json(['message' => 'Terjadi kesalahan pada server'], 500);
        }
    }

    /**
     * TUGAS 2: PUT (Update data produk)
     */
    public function update(UpdateProductRequest $request, $id)
    {
        try {
            $product = Product::find($id);

            if (!$product) {
                return response()->json(['message' => 'Product tidak ditemukan'], 404);
            }

            // Mengupdate data produk sesuai validasi
            $product->update($request->validated());

            return response()->json([
                'message' => 'Product berhasil diupdate',
                'data' => $product
            ], 200);
        } catch (\Throwable $e) {
            Log::error('Error saat update product', ['message' => $e->getMessage()]);
            return response()->json([
                'message' => 'Terjadi kesalahan pada server',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * TUGAS 3: DELETE (Menghapus data produk)
     */
    public function destroy($id)
    {
        try {
            $product = Product::find($id);

            if (!$product) {
                return response()->json(['message' => 'Product tidak ditemukan'], 404);
            }

            $product->delete();

            return response()->json([
                'message' => 'Product berhasil dihapus'
            ], 200);
        } catch (\Throwable $e) {
            Log::error('Error saat menghapus product', ['message' => $e->getMessage()]);
            return response()->json(['message' => 'Terjadi kesalahan pada server'], 500);
        }
    }
}