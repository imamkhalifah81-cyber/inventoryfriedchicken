@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
<div style="min-height: 100vh; background: linear-gradient(135deg, #e3e3eb 0%, #FFFBF7 100%);">
    <nav style="background: white; box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08); position: sticky; top: 0; z-index: 100;">
        <div style="max-width: 1400px; margin: 0 auto; padding: 0 30px; display: flex; justify-content: space-between; align-items: center; height: 70px;">
            <h1 style="font-size: 20px; font-weight: 700; color: #1A1A1A; margin: 0;">👨‍🍳 Fried Chicken</h1>
            <div style="display: flex; gap: 20px; align-items: center;">
                <span style="color: #666; font-size: 14px; font-weight: 500;">{{ Auth::user()->name }}</span>
                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" style="background: #ff7272; color: white; padding: 8px 16px; border: none; border-radius: 4px; font-weight: 500; cursor: pointer; font-size: 13px;">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <div style="display: flex; max-width: 1400px; margin: 0 auto;">
        <aside style="width: 260px; background: #2C2C2C; padding: 30px 0; height: calc(100vh - 70px); position: sticky; top: 70px; overflow-y: auto;">
            <nav style="display: flex; flex-direction: column; gap: 2px; padding: 0 15px;">
                
                <a href="{{ route('dashboard') }}" style="padding: 12px 16px; border-radius: 6px; text-decoration: none; color: white; font-weight: 500; font-size: 14px; background: #C4A574; display: flex; align-items: center; gap: 12px;"><span style="font-size: 18px;">📈</span> Dashboard</a>
                <a href="{{ route('home') }}" style="padding: 12px 16px; border-radius: 6px; text-decoration: none; color: #E0E0E0; font-weight: 500; font-size: 14px; display: flex; align-items: center; gap: 12px;"><span style="font-size: 18px;">🏠</span> Home </a>
                <a href="{{ route('products.index') }}" style="padding: 12px 16px; border-radius: 6px; text-decoration: none; color: #E0E0E0; font-weight: 500; font-size: 14px; display: flex; align-items: center; gap: 12px;"><span style="font-size: 18px;">📦</span> Data Barang</a>
                <a href="{{ route('stock-ins.index') }}" style="padding: 12px 16px; border-radius: 6px; text-decoration: none; color: #E0E0E0; font-weight: 500; font-size: 14px; display: flex; align-items: center; gap: 12px;"><span style="font-size: 18px;">📥</span> Barang Masuk</a>
                <a href="{{ route('stock-outs.index') }}" style="padding: 12px 16px; border-radius: 6px; text-decoration: none; color: #E0E0E0; font-weight: 500; font-size: 14px; display: flex; align-items: center; gap: 12px;"><span style="font-size: 18px;">📤</span> Barang Keluar</a>
                <a href="{{ route('stock-gudang.index') }}" style="padding: 12px 16px; border-radius: 6px; text-decoration: none; color: #E0E0E0; font-weight: 500; font-size: 14px; display: flex; align-items: center; gap: 12px;"><span style="font-size: 18px;">📊</span> Stok Gudang</a>
                <a href="{{ route('laporan.index') }}" style="padding: 12px 16px; border-radius: 6px; text-decoration: none; color: #E0E0E0; font-weight: 500; font-size: 14px; display: flex; align-items: center; gap: 12px;"><span style="font-size: 18px;">📋</span> Laporan</a>
            </nav>
        </aside>

        <main style="flex: 1; padding: 40px 30px; overflow-y: auto;">
            <div style="margin-bottom: 40px;">
                <h1 style="font-size: 32px; font-weight: 700; color: #1A1A1A; margin: 0 0 8px 0;">Kelola Data</h1>
                <p style="color: #999; font-size: 14px; margin: 0;">Ringkasan data inventaris Fried Chicken Bu Asih</p>
            </div>

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 20px; margin-bottom: 40px;">
                <div style="background: white; padding: 24px; border-radius: 8px; box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08);">
                    <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 16px;">
                        <div>
                            <p style="margin: 0 0 8px 0; font-size: 13px; color: #999; font-weight: 500;">Total Produk</p>
                            <p style="font-size: 36px; font-weight: 700; color: #1A1A1A; margin: 0;">{{ $totalProducts }}</p>
                        </div>
                        <span style="font-size: 32px;">📦</span>
                    </div>
                    <p style="font-size: 12px; color: #999; margin: 0;">Item aktif dalam inventaris</p>
                </div>

                <div style="background: white; padding: 24px; border-radius: 8px; box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08);">
                    <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 16px;">
                        <div>
                            <p style="margin: 0 0 8px 0; font-size: 13px; color: #999; font-weight: 500;">Total Kategori</p>
                            <p style="font-size: 36px; font-weight: 700; color: #1A1A1A; margin: 0;">{{ $totalCategories }}</p>
                        </div>
                        <span style="font-size: 32px;">📁</span>
                    </div>
                    <p style="font-size: 12px; color: #999; margin: 0;">Kategori produk tersedia</p>
                </div>

                <div style="background: white; padding: 24px; border-radius: 8px; box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08);">
                    <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 16px;">
                        <div>
                            <p style="margin: 0 0 8px 0; font-size: 13px; color: #999; font-weight: 500;">Stok Kritis</p>
                            <p style="font-size: 36px; font-weight: 700; color: #E74C3C; margin: 0;">{{ $criticalStockProducts }}</p>
                        </div>
                        <span style="font-size: 32px;">⚠️</span>
                    </div>
                    <p style="font-size: 12px; color: #999; margin: 0;">Produk dengan stok dibawah 5</p>
                </div>

                <div style="background: white; padding: 24px; border-radius: 8px; box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08);">
                    <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 16px;">
                        <div>
                            <p style="margin: 0 0 8px 0; font-size: 13px; color: #999; font-weight: 500;">Nilai Stok Total</p>
                            <p style="font-size: 28px; font-weight: 700; color: #1A1A1A; margin: 0;">Rp {{ number_format($totalStockValue, 0, ',', '.') }}</p>
                        </div>
                        <span style="font-size: 32px;">💰</span>
                    </div>
                    <p style="font-size: 12px; color: #999; margin: 0;">Total nilai stok × harga</p>
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 20px;">
                <div style="background: white; padding: 24px; border-radius: 8px; box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08);">
                    <h3 style="font-size: 16px; font-weight: 700; color: #1A1A1A; margin: 0 0 20px 0;">Transaksi 7 Hari Terakhir</h3>
                    <canvas id="transactionChart" style="max-height: 300px;"></canvas>
                </div>

                <div style="display: flex; flex-direction: column; gap: 16px;">
                    <div style="background: white; padding: 20px; border-radius: 8px; box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08);">
                        <p style="margin: 0 0 8px 0; font-size: 12px; color: #999; font-weight: 500;">Masuk Hari Ini</p>
                        <p style="font-size: 32px; font-weight: 700; color: #A8D66D; margin: 0;">{{ $stockInToday }}</p>
                    </div>
                    <div style="background: white; padding: 20px; border-radius: 8px; box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08);">
                        <p style="margin: 0 0 8px 0; font-size: 12px; color: #999; font-weight: 500;">Keluar Hari Ini</p>
                        <p style="font-size: 32px; font-weight: 700; color: #F39C12; margin: 0;">{{ $stockOutToday }}</p>
                    </div>
                    <div style="background: white; padding: 20px; border-radius: 8px; box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08);">
                        <p style="margin: 0 0 8px 0; font-size: 12px; color: #999; font-weight: 500;">Transaksi Bulan Ini</p>
                        <p style="font-size: 32px; font-weight: 700; color: #C4A574; margin: 0;">{{ $transactionsThisMonth }}</p>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
<script>
    const ctx = document.getElementById('transactionChart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: @json($chartData['days']),
            datasets: [{
                label: 'Barang Masuk',
                data: @json($chartData['stockIn']),
                borderColor: '#A8D66D',
                backgroundColor: 'rgba(168, 214, 109, 0.1)',
                borderWidth: 2,
                tension: 0.4,
                fill: true,
            }, {
                label: 'Barang Keluar',
                data: @json($chartData['stockOut']),
                borderColor: '#F39C12',
                backgroundColor: 'rgba(243, 156, 18, 0.1)',
                borderWidth: 2,
                tension: 0.4,
                fill: true,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: { legend: { position: 'top' } },
            scales: { y: { beginAtZero: true } }
        }
    });
</script>

<style>
    @media (max-width: 1200px) {
        [style*="grid-template-columns: 2fr 1fr"] { grid-template-columns: 1fr !important; }
    }
    @media (max-width: 768px) {
        aside { display: none; }
        main { padding: 20px 15px; }
    }
</style>

@endsection