<?php

namespace App\Http\Controllers;

use App\Models\StockOut;
use App\Models\Product;
use Illuminate\Http\Request;

class StockOutController extends Controller
{
    /**
     * Display a listing of stock outs
     */
    public function index()
    {
        $stockOuts = StockOut::with('product')->get();
        return view('stock-outs.index', compact('stockOuts'));
    }

    /**
     * Show the form for creating a new stock out
     */
    public function create()
    {
        $products = Product::where('stok', '>', 0)->get();
        return view('stock-outs.create', compact('products'));
    }

    /**
     * Store a newly created stock out in database
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'jumlah' => 'required|integer|min:1',
            'tanggal' => 'required|date',
            'jenis_pengeluaran' => 'required|in:penjualan,rusak,expired,hilang,lainnya',
            'keterangan' => 'nullable|string',
        ], [
            'product_id.required' => 'Produk harus dipilih',
            'product_id.exists' => 'Produk tidak valid',
            'jumlah.required' => 'Jumlah harus diisi',
            'jumlah.integer' => 'Jumlah harus berupa angka',
            'jumlah.min' => 'Jumlah minimal 1',
            'tanggal.required' => 'Tanggal harus diisi',
            'tanggal.date' => 'Format tanggal tidak valid',
            'jenis_pengeluaran.required' => 'Jenis pengeluaran harus dipilih',
            'jenis_pengeluaran.in' => 'Jenis pengeluaran tidak valid',
        ]);

        // Cek stok cukup
        $product = Product::find($validated['product_id']);
        if ($product->stok < $validated['jumlah']) {
            return back()->withErrors(['jumlah' => 'Stok tidak cukup. Stok tersedia: ' . $product->stok])->withInput();
        }

        // Create stock out record
        StockOut::create($validated);

        // Auto update stok produk
        $product->stok -= $validated['jumlah'];
        $product->save();

        return redirect('/stock-outs')->with('success', 'Barang keluar berhasil dicatat');
    }

    /**
     * Display the specified stock out
     */
    public function show(StockOut $stockOut)
    {
        $stockOut->load('product');
        return view('stock-outs.show', compact('stockOut'));
    }

    /**
     * Show the form for editing the specified stock out
     */
    public function edit(StockOut $stockOut)
    {
        $products = Product::all();
        return view('stock-outs.edit', compact('stockOut', 'products'));
    }

    /**
     * Update the specified stock out in database
     */
    public function update(Request $request, StockOut $stockOut)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'jumlah' => 'required|integer|min:1',
            'tanggal' => 'required|date',
            'jenis_pengeluaran' => 'required|in:penjualan,rusak,expired,hilang,lainnya',
            'keterangan' => 'nullable|string',
        ], [
            'product_id.required' => 'Produk harus dipilih',
            'product_id.exists' => 'Produk tidak valid',
            'jumlah.required' => 'Jumlah harus diisi',
            'jumlah.integer' => 'Jumlah harus berupa angka',
            'jumlah.min' => 'Jumlah minimal 1',
            'tanggal.required' => 'Tanggal harus diisi',
            'tanggal.date' => 'Format tanggal tidak valid',
            'jenis_pengeluaran.required' => 'Jenis pengeluaran harus dipilih',
            'jenis_pengeluaran.in' => 'Jenis pengeluaran tidak valid',
        ]);

        // Restore stok lama
        $product = Product::find($stockOut->product_id);
        $product->stok += $stockOut->jumlah;

        // Update stock out
        $stockOut->update($validated);

        // Update stok dengan jumlah baru
        if ($validated['product_id'] == $stockOut->product_id) {
            // Produk sama
            $product->stok -= $validated['jumlah'];
            $product->save();
        } else {
            // Produk berbeda
            $product->save();
            $newProduct = Product::find($validated['product_id']);
            if ($newProduct->stok < $validated['jumlah']) {
                return back()->withErrors(['jumlah' => 'Stok tidak cukup. Stok tersedia: ' . $newProduct->stok])->withInput();
            }
            $newProduct->stok -= $validated['jumlah'];
            $newProduct->save();
        }

        return redirect('/stock-outs')->with('success', 'Barang keluar berhasil diubah');
    }

    /**
     * Delete the specified stock out
     */
    public function destroy(StockOut $stockOut)
    {
        // Restore stok produk
        $product = Product::find($stockOut->product_id);
        $product->stok += $stockOut->jumlah;
        $product->save();

        $stockOut->delete();

        return redirect('/stock-outs')->with('success', 'Barang keluar berhasil dihapus');
    }
}