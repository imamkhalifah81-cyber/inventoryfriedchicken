@extends('layouts.app')
@section('title', 'Barang Keluar')
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

        <main style="flex: 1; padding: 40px 30px; overflow-y: auto;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 40px;">
                <div>
                    <h1 style="font-size: 32px; font-weight: 700; color: #1A1A1A; margin: 0 0 8px 0;">📤 Barang Keluar</h1>
                    <p style="color: #999; font-size: 14px; margin: 0;">Catat dan kelola barang keluar dari gudang</p>
                </div>
                <a href="{{ route('stock-outs.create') }}" style="background: #C4A574; color: white; padding: 12px 24px; border-radius: 4px; text-decoration: none; font-weight: 600; font-size: 14px;">+ Catat Barang Keluar</a>
            </div>

            @if (session('success'))
                <div style="background: #D4EDDA; color: #155724; border: 1px solid #C3E6CB; padding: 12px 16px; border-radius: 4px; margin-bottom: 20px;">
                    ✅ {{ session('success') }}
                </div>
            @endif

            @if ($stockOuts->isEmpty())
                <div style="background: white; padding: 60px 20px; border-radius: 8px; text-align: center; box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08);">
                    <p style="color: #999; margin: 0; font-size: 16px;">Belum ada pencatatan barang keluar. <a href="{{ route('stock-outs.create') }}" style="color: #C4A574; text-decoration: none;">Mulai catat sekarang</a></p>
                </div>
            @else
                <div style="background: white; border-radius: 8px; box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08); overflow: hidden;">
                    <table style="width: 100%; border-collapse: collapse;">
                        <thead>
                            <tr style="background: #F9F9F9; border-bottom: 1px solid #E0E0E0;">
                                <th style="padding: 16px; text-align: left; font-weight: 600; font-size: 13px; color: #666;">No</th>
                                <th style="padding: 16px; text-align: left; font-weight: 600; font-size: 13px; color: #666;">Produk</th>
                                <th style="padding: 16px; text-align: center; font-weight: 600; font-size: 13px; color: #666;">Jumlah</th>
                                <th style="padding: 16px; text-align: left; font-weight: 600; font-size: 13px; color: #666;">Jenis</th>
                                <th style="padding: 16px; text-align: left; font-weight: 600; font-size: 13px; color: #666;">Tanggal</th>
                                <th style="padding: 16px; text-align: center; font-weight: 600; font-size: 13px; color: #666;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($stockOuts as $stockOut)
                                <tr style="border-bottom: 1px solid #F0F0F0;">
                                    <td style="padding: 16px; font-size: 14px;">{{ $loop->iteration }}</td>
                                    <td style="padding: 16px; font-size: 14px; font-weight: 500;">{{ $stockOut->product->name_barang }}</td>
                                    <td style="padding: 16px; text-align: center; font-size: 14px; font-weight: 600;">{{ $stockOut->jumlah }} {{ $stockOut->product->satuan }}</td>
                                    <td style="padding: 16px; font-size: 14px; color: #999;">{{ ucfirst($stockOut->jenis_pengeluaran) }}</td>
                                    <td style="padding: 16px; font-size: 14px;">{{ $stockOut->tanggal->format('d-m-Y') }}</td>
                                    <td style="padding: 16px; text-align: center;">
                                        <a href="{{ route('stock-outs.show', $stockOut->id) }}" style="background: #A8D66D; color: white; padding: 6px 12px; border-radius: 4px; text-decoration: none; font-size: 12px; margin-right: 4px; display: inline-block;">View</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </main>
    </div>
</div>

<style>
    @media (max-width: 768px) {
        aside { display: none; }
        main { padding: 20px 15px; }
        table { font-size: 12px; }
        th, td { padding: 12px 8px !important; }
    }
</style>

@endsection