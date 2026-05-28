@extends('layouts.app')
@section('title', 'Detail Barang Keluar')
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
                <a href="{{ route('stock-outs.index') }}" style="padding: 12px 16px; border-radius: 6px; text-decoration: none; color: white; font-weight: 500; font-size: 14px; background: #C4A574; display: flex; align-items: center; gap: 12px;"><span style="font-size: 18px;">📤</span> Barang Keluar</a>
                <a href="{{ route('stock-gudang.index') }}" style="padding: 12px 16px; border-radius: 6px; text-decoration: none; color: #E0E0E0; font-weight: 500; font-size: 14px; display: flex; align-items: center; gap: 12px;"><span style="font-size: 18px;">📊</span> Stok Gudang</a>
                <a href="{{ route('laporan.index') }}" style="padding: 12px 16px; border-radius: 6px; text-decoration: none; color: #E0E0E0; font-weight: 500; font-size: 14px; display: flex; align-items: center; gap: 12px;"><span style="font-size: 18px;">📋</span> Laporan</a>
            </nav>
        </aside>

        <main style="flex: 1; padding: 40px 30px; max-width: 700px; margin: 0 auto;">
            <a href="{{ route('stock-outs.index') }}" style="color: #C4A574; text-decoration: none; font-weight: 600; margin-bottom: 20px; display: inline-block;">← Kembali</a>

            <div style="background: white; border-radius: 8px; box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08); padding: 32px;">
                <h1 style="font-size: 28px; font-weight: 700; color: #1A1A1A; margin: 0 0 24px 0;">📤 Detail Barang Keluar</h1>

                <div style="background: #F0F8FF; padding: 20px; border-radius: 8px; border-left: 4px solid #C4A574; margin-bottom: 24px;">
                    <div style="margin-bottom: 16px;">
                        <label style="font-weight: 600; color: #666; display: block; margin-bottom: 4px; font-size: 13px;">Produk</label>
                        <p style="font-size: 16px; margin: 0; color: #1A1A1A;">{{ $stockOut->product->name_barang }}</p>
                    </div>

                    <div style="margin-bottom: 16px;">
                        <label style="font-weight: 600; color: #666; display: block; margin-bottom: 4px; font-size: 13px;">Jumlah Keluar</label>
                        <p style="font-size: 18px; margin: 0; color: #1A1A1A; font-weight: 700;">{{ $stockOut->jumlah }} {{ $stockOut->product->satuan }}</p>
                    </div>

                    <div style="margin-bottom: 16px;">
                        <label style="font-weight: 600; color: #666; display: block; margin-bottom: 4px; font-size: 13px;">Jenis Pengeluaran</label>
                        <p style="font-size: 16px; margin: 0; color: #1A1A1A;">{{ ucfirst($stockOut->jenis_pengeluaran) }}</p>
                    </div>

                    <div style="margin-bottom: 16px;">
                        <label style="font-weight: 600; color: #666; display: block; margin-bottom: 4px; font-size: 13px;">Tanggal</label>
                        <p style="font-size: 16px; margin: 0; color: #1A1A1A;">{{ $stockOut->tanggal->format('d-m-Y') }}</p>
                    </div>

                    @if ($stockOut->keterangan)
                        <div>
                            <label style="font-weight: 600; color: #666; display: block; margin-bottom: 4px; font-size: 13px;">Keterangan</label>
                            <p style="font-size: 16px; margin: 0; color: #1A1A1A;">{{ $stockOut->keterangan }}</p>
                        </div>
                    @endif
                </div>

                <div style="background: #FFF8F0; padding: 20px; border-radius: 8px; border-left: 4px solid #C4A574;">
                    <div style="margin-bottom: 12px;">
                        <label style="font-weight: 600; color: #666; display: block; margin-bottom: 4px; font-size: 13px;">Harga Satuan</label>
                        <p style="font-size: 16px; margin: 0; color: #1A1A1A;">Rp {{ number_format($stockOut->product->harga, 0, ',', '.') }}</p>
                    </div>

                    <div>
                        <label style="font-weight: 600; color: #666; display: block; margin-bottom: 4px; font-size: 13px;">Total Nilai Keluar</label>
                        <p style="font-size: 18px; margin: 0; color: #C4A574; font-weight: 700;">Rp {{ number_format($stockOut->jumlah * $stockOut->product->harga, 0, ',', '.') }}</p>
                    </div>
                </div>

                <div style="margin-top: 32px; padding-top: 24px; border-top: 1px solid #E0E0E0;">
                    <p style="color: #999; font-size: 12px; margin: 0;">Dibuat: {{ $stockOut->created_at->format('d-m-Y H:i') }}</p>
                </div>
            </div>
        </main>
    </div>
</div>

<style>
    @media (max-width: 768px) {
        aside { display: none; }
        main { padding: 20px 15px; max-width: 100%; }
        h1 { font-size: 24px; }
    }
</style>

@endsection