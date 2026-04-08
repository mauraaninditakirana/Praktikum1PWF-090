<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ProductController extends Controller
{
    use AuthorizesRequests;
    public function index()
    {
        $products = Product::all();
        return view('product.index', compact('products'));
    }

    public function create()
    {
        $users = User::orderBy('name')->get();
        return view('product.create', compact('users'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'qty' => 'required|integer',
            'price' => 'required|numeric',
            'user_id' => 'required|exists:users,id',
        ]);

        Product::create($validated);

        return redirect()->route('product.index')->with('success', 'Product created successfully.');
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('product.view', compact('product'));
    }

    // Perbaikan: Ganti (Product $product) menjadi ($id) agar cocok dengan {id} di web.php
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        // Cek apakah user boleh edit (berdasarkan logic di Policy)
        $this->authorize('update', $product);
        $users = User::orderBy('name')->get();

        return view('product.edit', compact('product', 'users'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'qty' => 'sometimes|integer',
            'price' => 'sometimes|numeric',
            'user_id' => 'sometimes|exists:users,id',
        ]);

        $product->update($validated);

        return redirect()->route('product.index')->with('success', 'Product updated successfully.');
    }

    public function delete($id)
    {
        $product = Product::findOrFail($id);
        // Cek apakah user boleh hapus (berdasarkan logic di Policy)
        $this->authorize('delete', $product);
        $product->delete();

        return redirect()->route('product.index')->with('success', 'Product berhasil dihapus');
    }
}