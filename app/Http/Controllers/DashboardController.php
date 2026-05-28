<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\StockIn;
use App\Models\StockOut;
use App\Models\Category;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProducts = Product::count();
        $totalCategories = Category::count();
        $lowStockProducts = Product::where('stok', '<', 10)->count();
        $stockInToday = StockIn::whereDate('tanggal', Carbon::today())->sum('jumlah');
        $stockOutToday = StockOut::whereDate('tanggal', Carbon::today())->sum('jumlah');
        $totalStockValue = Product::selectRaw('SUM(stok * harga) as total')->first()->total ?? 0;
        $chartData = $this->getChartData();
        $transactionsThisMonth = StockIn::whereMonth('tanggal', Carbon::now()->month)
            ->whereYear('tanggal', Carbon::now()->year)
            ->count() + 
            StockOut::whereMonth('tanggal', Carbon::now()->month)
            ->whereYear('tanggal', Carbon::now()->year)
            ->count();
        $criticalStockProducts = Product::where('stok', '<', 5)->count();

        return view('dashboard', compact(
            'totalProducts',
            'totalCategories',
            'lowStockProducts',
            'stockInToday',
            'stockOutToday',
            'totalStockValue',
            'chartData',
            'transactionsThisMonth',
            'criticalStockProducts'
        ));
    }

    private function getChartData()
    {
        $days = [];
        $stockInData = [];
        $stockOutData = [];

        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::today()->subDays($i);
            $days[] = $date->format('d M');
            $stockInData[] = StockIn::whereDate('tanggal', $date)->sum('jumlah');
            $stockOutData[] = StockOut::whereDate('tanggal', $date)->sum('jumlah');
        }

        return ['days' => $days, 'stockIn' => $stockInData, 'stockOut' => $stockOutData];
    }
}