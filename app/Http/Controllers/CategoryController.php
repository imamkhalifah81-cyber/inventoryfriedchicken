<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of categories
     */
    public function index()
    {
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new category
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created category in database
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name_kategori' => 'required|string|max:255|unique:categories,name_kategori',
        ], [
            'name_kategori.required' => 'Nama kategori harus diisi',
            'name_kategori.unique' => 'Nama kategori sudah ada',
        ]);

        Category::create($validated);

        return redirect('/categories')->with('success', 'Kategori berhasil ditambahkan');
    }

    /**
     * Display the specified category
     */
    public function show(Category $category)
    {
        return view('categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified category
     */
    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified category in database
     */
    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name_kategori' => 'required|string|max:255|unique:categories,name_kategori,' . $category->id,
        ], [
            'name_kategori.required' => 'Nama kategori harus diisi',
            'name_kategori.unique' => 'Nama kategori sudah ada',
        ]);

        $category->update($validated);

        return redirect('/categories')->with('success', 'Kategori berhasil diubah');
    }

    /**
     * Delete the specified category
     */
    public function destroy(Category $category)
    {
        // Cek apakah kategori punya produk
        if ($category->products()->exists()) {
            return redirect('/categories')->with('error', 'Kategori tidak bisa dihapus karena masih punya produk');
        }

        $category->delete();

        return redirect('/categories')->with('success', 'Kategori berhasil dihapus');
    }
}