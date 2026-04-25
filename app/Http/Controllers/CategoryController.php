<?php

namespace App\Http\Controllers;

use App\Models\Kategori; 
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Kategori::withCount('products')->get();
        return view('category.index', compact('categories'));
    }

    public function create()
    {
        // Menampilkan form tambah
        return view('category.create');
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|unique:categories,name|max:255',
        ]);

        // Simpan ke database
        Kategori::create([
            'name' => $request->name
        ]);

        return redirect()->route('category.index')->with('success', 'Category saved successfully!');
    }

    public function edit($id)
    {
        $category = Kategori::findOrFail($id);
        return view('category.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:255|unique:categories,name,' . $id,
        ]);

        $category = Kategori::findOrFail($id);
        $category->update(['name' => $request->name]);

        return redirect()->route('category.index')->with('success', 'Category updated successfully!');
    }

    public function destroy($id)
    {
        $category = Kategori::findOrFail($id);
        $category->delete();

        return redirect()->route('category.index')->with('success', 'Category deleted successfully!');
    }
}