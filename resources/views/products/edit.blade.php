@extends('layouts.app')
@section('title', 'Edit Barang')
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
                <a href="{{ route('products.index') }}" style="padding: 12px 16px; border-radius: 6px; text-decoration: none; color: white; font-weight: 500; font-size: 14px; background: #C4A574; display: flex; align-items: center; gap: 12px;"><span style="font-size: 18px;">📦</span> Data Barang</a>
                <a href="{{ route('stock-ins.index') }}" style="padding: 12px 16px; border-radius: 6px; text-decoration: none; color: #E0E0E0; font-weight: 500; font-size: 14px; display: flex; align-items: center; gap: 12px;"><span style="font-size: 18px;">📥</span> Barang Masuk</a>
                <a href="{{ route('stock-outs.index') }}" style="padding: 12px 16px; border-radius: 6px; text-decoration: none; color: #E0E0E0; font-weight: 500; font-size: 14px; display: flex; align-items: center; gap: 12px;"><span style="font-size: 18px;">📤</span> Barang Keluar</a>
                <a href="{{ route('stock-gudang.index') }}" style="padding: 12px 16px; border-radius: 6px; text-decoration: none; color: #E0E0E0; font-weight: 500; font-size: 14px; display: flex; align-items: center; gap: 12px;"><span style="font-size: 18px;">📊</span> Stok Gudang</a>
                <a href="{{ route('laporan.index') }}" style="padding: 12px 16px; border-radius: 6px; text-decoration: none; color: #E0E0E0; font-weight: 500; font-size: 14px; display: flex; align-items: center; gap: 12px;"><span style="font-size: 18px;">📋</span> Laporan</a>
            </nav>
        </aside>

        <main style="flex: 1; padding: 40px 30px; max-width: 700px; margin: 0 auto;">
            <a href="{{ route('products.index') }}" style="color: #C4A574; text-decoration: none; font-weight: 600; margin-bottom: 20px; display: inline-block;">← Kembali</a>

            <div style="background: white; border-radius: 8px; box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08); padding: 32px;">
                <h1 style="font-size: 28px; font-weight: 700; color: #1A1A1A; margin: 0 0 24px 0;">Edit Barang</h1>

                @if ($errors->any())
                    <div style="background: #F8D7DA; color: #721C24; border: 1px solid #F5C6CB; padding: 12px 16px; border-radius: 4px; margin-bottom: 20px;">
                        <strong>Error:</strong>
                        <ul style="margin-top: 8px; margin-left: 20px;">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div style="margin-bottom: 20px;">
                        <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #333; font-size: 14px;">Nama Barang</label>
                        <input type="text" name="name_barang" value="{{ $product->name_barang }}" style="width: 100%; padding: 10px 12px; border: 1px solid #E0E0E0; border-radius: 4px; font-size: 14px;" required>
                    </div>

                    <div style="margin-bottom: 20px;">
                        <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #333; font-size: 14px;">Kategori</label>
                        <select name="category_id" style="width: 100%; padding: 10px 12px; border: 1px solid #E0E0E0; border-radius: 4px; font-size: 14px;" required>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>{{ $category->name_kategori }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 20px;">
                        <div>
                            <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #333; font-size: 14px;">Stok</label>
                            <input type="number" name="stok" value="{{ $product->stok }}" style="width: 100%; padding: 10px 12px; border: 1px solid #E0E0E0; border-radius: 4px; font-size: 14px;" min="0" required>
                        </div>
                        <div>
                            <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #333; font-size: 14px;">Satuan</label>
                            <input type="text" name="satuan" value="{{ $product->satuan }}" style="width: 100%; padding: 10px 12px; border: 1px solid #E0E0E0; border-radius: 4px; font-size: 14px;" required>
                        </div>
                    </div>

                    <div style="margin-bottom: 20px;">
                        <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #333; font-size: 14px;">Harga</label>
                        <input type="number" name="harga" value="{{ $product->harga }}" step="0.01" style="width: 100%; padding: 10px 12px; border: 1px solid #E0E0E0; border-radius: 4px; font-size: 14px;" min="0" required>
                    </div>

                    <div style="margin-bottom: 20px;">
                        <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #333; font-size: 14px;">Gambar Produk</label>
                        @if ($product->gambar)
                            <div style="margin-bottom: 12px;">
                                <img src="{{ asset($product->gambar) }}" alt="{{ $product->name_barang }}" style="max-width: 200px; height: auto; border-radius: 4px;">
                                <p style="color: #999; font-size: 12px; margin-top: 8px;">Gambar saat ini</p>
                            </div>
                        @endif
                        <input type="file" name="gambar" accept="image/*" style="width: 100%; padding: 10px 12px; border: 1px solid #E0E0E0; border-radius: 4px; font-size: 14px;">
                        <p style="color: #999; font-size: 12px; margin-top: 8px;">Format: JPG, PNG, GIF (Max 2MB) - Kosongkan jika tidak ingin mengubah</p>
                    </div>

                    <div style="display: flex; gap: 12px;">
                        <button type="submit" style="flex: 1; background: #C4A574; color: white; padding: 12px; border: none; border-radius: 4px; font-weight: 600; cursor: pointer; font-size: 14px;">Simpan Perubahan</button>
                        <a href="{{ route('products.index') }}" style="flex: 1; background: #E0E0E0; color: #333; padding: 12px; border-radius: 4px; text-decoration: none; font-weight: 600; text-align: center; font-size: 14px;">Batal</a>
                    </div>
                </form>
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