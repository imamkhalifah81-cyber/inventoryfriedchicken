<?php

namespace App\Http\Controllers;

use App\Models\StockIn;
use App\Models\Product;
use Illuminate\Http\Request;

class StockInController extends Controller
{
    public function index()
    {
        $stockIns = StockIn::with('product')->get();
        return view('stock-ins.index', compact('stockIns'));
    }

    public function create()
    {
        $products = Product::all();
        return view('stock-ins.create', compact('products'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'jumlah' => 'required|integer|min:1',
            'tanggal' => 'required|date',
        ], [
            'product_id.required' => 'Produk harus dipilih',
            'product_id.exists' => 'Produk tidak valid',
            'jumlah.required' => 'Jumlah harus diisi',
            'jumlah.integer' => 'Jumlah harus berupa angka',
            'jumlah.min' => 'Jumlah minimal 1',
            'tanggal.required' => 'Tanggal harus diisi',
            'tanggal.date' => 'Format tanggal tidak valid',
        ]);

        StockIn::create($validated);

        $product = Product::find($validated['product_id']);
        $product->stok += $validated['jumlah'];
        $product->save();

        return redirect('/stock-ins')->with('success', 'Barang masuk berhasil dicatat');
    }

    public function show(StockIn $stockIn)
    {
        $stockIn->load('product');
        return view('stock-ins.show', compact('stockIn'));
    }

    public function edit(StockIn $stockIn)
    {
        $products = Product::all();
        return view('stock-ins.edit', compact('stockIn', 'products'));
    }

    public function update(Request $request, StockIn $stockIn)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'jumlah' => 'required|integer|min:1',
            'tanggal' => 'required|date',
        ], [
            'product_id.required' => 'Produk harus dipilih',
            'product_id.exists' => 'Produk tidak valid',
            'jumlah.required' => 'Jumlah harus diisi',
            'jumlah.integer' => 'Jumlah harus berupa angka',
            'jumlah.min' => 'Jumlah minimal 1',
            'tanggal.required' => 'Tanggal harus diisi',
            'tanggal.date' => 'Format tanggal tidak valid',
        ]);

        $oldProduct = Product::find($stockIn->product_id);
        $oldProduct->stok -= $stockIn->jumlah;
        $oldProduct->save();

        $stockIn->update($validated);

        $newProduct = Product::find($validated['product_id']);
        $newProduct->stok += $validated['jumlah'];
        $newProduct->save();

        return redirect('/stock-ins')->with('success', 'Barang masuk berhasil diubah');
    }

    public function destroy(StockIn $stockIn)
    {
        $product = Product::find($stockIn->product_id);
        $product->stok -= $stockIn->jumlah;
        $product->save();

        $stockIn->delete();

        return redirect('/stock-ins')->with('success', 'Barang masuk berhasil dihapus');
    }
}