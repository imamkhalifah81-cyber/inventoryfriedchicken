<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StockInController;
use App\Http\Controllers\StockOutController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Products CRUD (FULL)
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');

    // Stock In (Create + View Only)
    Route::get('/stock-ins', [StockInController::class, 'index'])->name('stock-ins.index');
    Route::get('/stock-ins/create', [StockInController::class, 'create'])->name('stock-ins.create');
    Route::post('/stock-ins', [StockInController::class, 'store'])->name('stock-ins.store');
    Route::get('/stock-ins/{stockIn}', [StockInController::class, 'show'])->name('stock-ins.show');

    // Stock Out (Create + View Only)
    Route::get('/stock-outs', [StockOutController::class, 'index'])->name('stock-outs.index');
    Route::get('/stock-outs/create', [StockOutController::class, 'create'])->name('stock-outs.create');
    Route::post('/stock-outs', [StockOutController::class, 'store'])->name('stock-outs.store');
    Route::get('/stock-outs/{stockOut}', [StockOutController::class, 'show'])->name('stock-outs.show');

    // Stock Gudang (View Only)
    Route::get('/stock-gudang', function () {
        $products = \App\Models\Product::all();
        return view('stock-gudang.index', compact('products'));
    })->name('stock-gudang.index');

    // Laporan (View Only)
    Route::get('/laporan', function () {
        $totalProducts = \App\Models\Product::count();
        $totalStok = \App\Models\Product::sum('stok');
        $totalStockValue = \App\Models\Product::selectRaw('SUM(stok * harga) as total')->first()->total ?? 0;
        $totalTransactions = \App\Models\StockIn::count() + \App\Models\StockOut::count();
        return view('laporan.index', compact('totalProducts', 'totalStok', 'totalStockValue', 'totalTransactions'));
    })->name('laporan.index');
});