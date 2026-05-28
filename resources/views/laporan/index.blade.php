@extends('layouts.app')
@section('title', 'Laporan Inventaris')
@section('content')
<div style="min-height: 100vh; background: linear-gradient(135deg, #F5F3F0 0%, #FFFBF7 100%);">
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
                <a href="{{ route('dashboard') }}" style="padding: 12px 16px; border-radius: 6px; text-decoration: none; color: #E0E0E0; font-weight: 500; font-size: 14px; display: flex; align-items: center; gap: 12px;"><span style="font-size: 18px;">📈</span> Dashboard</a>
                <a href="{{ route('home') }}" style="padding: 12px 16px; border-radius: 6px; text-decoration: none; color: #E0E0E0; font-weight: 500; font-size: 14px; display: flex; align-items: center; gap: 12px;"><span style="font-size: 18px;">🏠</span> Home </a>
                <a href="{{ route('products.index') }}" style="padding: 12px 16px; border-radius: 6px; text-decoration: none; color: #E0E0E0; font-weight: 500; font-size: 14px; display: flex; align-items: center; gap: 12px;"><span style="font-size: 18px;">📦</span> Data Barang</a>
                <a href="{{ route('stock-ins.index') }}" style="padding: 12px 16px; border-radius: 6px; text-decoration: none; color: #E0E0E0; font-weight: 500; font-size: 14px; display: flex; align-items: center; gap: 12px;"><span style="font-size: 18px;">📥</span> Barang Masuk</a>
                <a href="{{ route('stock-outs.index') }}" style="padding: 12px 16px; border-radius: 6px; text-decoration: none; color: #E0E0E0; font-weight: 500; font-size: 14px; display: flex; align-items: center; gap: 12px;"><span style="font-size: 18px;">📤</span> Barang Keluar</a>
                <a href="{{ route('stock-gudang.index') }}" style="padding: 12px 16px; border-radius: 6px; text-decoration: none; color: #E0E0E0; font-weight: 500; font-size: 14px; display: flex; align-items: center; gap: 12px;"><span style="font-size: 18px;">📊</span> Stok Gudang</a>
                <a href="{{ route('laporan.index') }}" style="padding: 12px 16px; border-radius: 6px; text-decoration: none; color: white; font-weight: 500; font-size: 14px; background: #C4A574; display: flex; align-items: center; gap: 12px;"><span style="font-size: 18px;">📋</span> Laporan</a>
            </nav>
        </aside>

        <main style="flex: 1; padding: 40px 30px; overflow-y: auto;">
            <div style="margin-bottom: 40px;">
                <h1 style="font-size: 32px; font-weight: 700; color: #1A1A1A; margin: 0 0 8px 0;">📋 Laporan Inventaris</h1>
                <p style="color: #999; font-size: 14px; margin: 0;">Ringkasan data inventaris Fried Chicken Bu Asih</p>
            </div>

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; margin-bottom: 40px;">
                <div style="background: white; padding: 24px; border-radius: 8px; box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08);">
                    <p style="margin: 0 0 8px 0; font-size: 13px; color: #999; font-weight: 500;">Total Produk</p>
                    <p style="font-size: 36px; font-weight: 700; color: #1A1A1A; margin: 0;">{{ $totalProducts }}</p>
                </div>

                <div style="background: white; padding: 24px; border-radius: 8px; box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08);">
                    <p style="margin: 0 0 8px 0; font-size: 13px; color: #999; font-weight: 500;">Total Stok</p>
                    <p style="font-size: 36px; font-weight: 700; color: #1A1A1A; margin: 0;">{{ $totalStok }}</p>
                </div>

                <div style="background: white; padding: 24px; border-radius: 8px; box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08);">
                    <p style="margin: 0 0 8px 0; font-size: 13px; color: #999; font-weight: 500;">Nilai Stok Total</p>
                    <p style="font-size: 28px; font-weight: 700; color: #C4A574; margin: 0;">Rp {{ number_format($totalStockValue, 0, ',', '.') }}</p>
                </div>

                <div style="background: white; padding: 24px; border-radius: 8px; box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08);">
                    <p style="margin: 0 0 8px 0; font-size: 13px; color: #999; font-weight: 500;">Total Transaksi</p>
                    <p style="font-size: 36px; font-weight: 700; color: #A8D66D; margin: 0;">{{ $totalTransactions }}</p>
                </div>
            </div>

            <div style="background: white; padding: 24px; border-radius: 8px; box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08);">
                <h3 style="font-size: 18px; font-weight: 700; color: #1A1A1A; margin: 0 0 20px 0;">Informasi Laporan</h3>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                    <div>
                        <p style="font-size: 13px; color: #999; margin: 0 0 8px 0; font-weight: 600;">Tanggal Laporan</p>
                        <p style="font-size: 16px; color: #1A1A1A; margin: 0;">{{ \Carbon\Carbon::now()->format('d F Y') }}</p>
                    </div>
                    <div>
                        <p style="font-size: 13px; color: #999; margin: 0 0 8px 0; font-weight: 600;">Periode</p>
                        <p style="font-size: 16px; color: #1A1A1A; margin: 0;">Sampai dengan hari ini</p>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<style>
    @media (max-width: 768px) {
        aside { display: none; }
        main { padding: 20px 15px; }
        [style*="grid-template-columns: repeat"] { grid-template-columns: 1fr !important; }
        [style*="grid-template-columns: 1fr 1fr"] { grid-template-columns: 1fr !important; }
    }
</style>

@endsection