<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->get();
        return view('products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name_barang' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'stok' => 'required|integer|min:0',
            'satuan' => 'required|string|max:50',
            'harga' => 'required|numeric|min:0',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'name_barang.required' => 'Nama barang harus diisi',
            'category_id.required' => 'Kategori harus dipilih',
            'category_id.exists' => 'Kategori tidak valid',
            'stok.required' => 'Stok harus diisi',
            'stok.integer' => 'Stok harus berupa angka',
            'satuan.required' => 'Satuan harus diisi',
            'harga.required' => 'Harga harus diisi',
            'harga.numeric' => 'Harga harus berupa angka',
            'gambar.image' => 'File harus berupa gambar',
            'gambar.mimes' => 'Format gambar harus jpeg, png, jpg, atau gif',
            'gambar.max' => 'Ukuran gambar maksimal 2MB',
        ]);

        // Handle upload gambar - simpan di folder public/uploads
        $gambarName = null;
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $gambarName = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads'), $gambarName);
        }

        $validated['gambar'] = $gambarName;

        Product::create($validated);

        return redirect('/products')->with('success', 'Produk berhasil ditambahkan');
    }

    public function show(Product $product)
    {
        $product->load('category');
        return view('products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name_barang' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'stok' => 'required|integer|min:0',
            'satuan' => 'required|string|max:50',
            'harga' => 'required|numeric|min:0',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'name_barang.required' => 'Nama barang harus diisi',
            'category_id.required' => 'Kategori harus dipilih',
            'category_id.exists' => 'Kategori tidak valid',
            'stok.required' => 'Stok harus diisi',
            'stok.integer' => 'Stok harus berupa angka',
            'satuan.required' => 'Satuan harus diisi',
            'harga.required' => 'Harga harus diisi',
            'harga.numeric' => 'Harga harus berupa angka',
            'gambar.image' => 'File harus berupa gambar',
            'gambar.mimes' => 'Format gambar harus jpeg, png, jpg, atau gif',
            'gambar.max' => 'Ukuran gambar maksimal 2MB',
        ]);

        // Handle upload gambar baru - simpan di folder
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama kalau ada
            if ($product->gambar && File::exists(public_path('uploads/' . $product->gambar))) {
                File::delete(public_path('uploads/' . $product->gambar));
            }

            $file = $request->file('gambar');
            $gambarName = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads'), $gambarName);
            $validated['gambar'] = $gambarName;
        }

        $product->update($validated);

        return redirect('/products')->with('success', 'Produk berhasil diubah');
    }

    public function destroy(Product $product)
    {
        // Cek apakah produk punya stok masuk/keluar
        if ($product->stockIns()->exists() || $product->stockOuts()->exists()) {
            return redirect('/products')->with('error', 'Produk tidak bisa dihapus karena sudah ada transaksi');
        }

        // Hapus gambar kalau ada
        if ($product->gambar && File::exists(public_path('uploads/' . $product->gambar))) {
            File::delete(public_path('uploads/' . $product->gambar));
        }

        $product->delete();

        return redirect('/products')->with('success', 'Produk berhasil dihapus');
    }
}