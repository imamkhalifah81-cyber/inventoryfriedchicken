@extends('layouts.app')

@section('title', 'Home')

@section('content')
<div style="min-height: 100vh; background: linear-gradient(135deg, #F5F3F0 0%, #FFFBF7 100%);">
    <!-- Navbar -->
    <nav style="
        background: white;
        box-shadow: 0 1px 3px rgba(0,0,0,0.08);
        position: sticky;
        top: 0;
        z-index: 100;
    ">
        <div style="
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 70px;
        ">
            <h1 style="font-size: 20px; font-weight: 700; color: #1A1A1A; margin: 0;">
                👨‍🍳 Fried Chicken Inventory
            </h1>
            <div style="display: flex; gap: 20px; align-items: center;">
                @auth
                    <span style="color: #666; font-size: 14px; font-weight: 500;">{{ Auth::user()->name }}</span>

                    <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" style="
                            background: #ff7272;
                            color: white;
                            padding: 8px 16px;
                            border: none;
                            border-radius: 4px;
                            font-weight: 500;
                            cursor: pointer;
                            font-size: 13px;
                        ">Logout</button>
                    </form>
                @else

                @endauth
            </div>
        </div>
    </nav>

    <!-- Hero -->
    <div style="
        background: linear-gradient(135deg, #040225 0%, #053532 100%);
        color: white;
        padding: 80px 20px;
        text-align: center;
    ">
        <div style="max-width: 800px; margin: 0 auto;">
            <h1 style="font-size: 42px; margin-bottom: 16px; font-weight: 700;">
                Inventory Barang
            </h1>
            <p style="font-size: 16px; margin-bottom: 32px; opacity: 0.9;">
                Kelola stok barang dan laporan dengan mudah dan efisien
            </p>
            <div style="display: flex; gap: 12px; justify-content: center;">
                @guest
                    <a href="{{ route('login') }}" style="
                        background: white;
                        color: #0a0600;
                        padding: 12px 32px;
                        border-radius: 4px;
                        text-decoration: none;
                        font-weight: 600;
                        font-size: 14px;
                    ">Mulai Login</a>
                    <a href="{{ route('register') }}" style="
                        background: rgba(255,255,255,0.2);
                        color: white;
                        border: 2px solid white;
                        padding: 12px 32px;
                        border-radius: 4px;
                        text-decoration: none;
                        font-weight: 600;
                        font-size: 14px;
                    ">Daftar Akun</a>
                @else
                    <a href="{{ route('dashboard') }}" style="
                        background: #daa147;
                        color: white;
                        padding: 12px 32px;
                        border-radius: 4px;
                        text-decoration: none;
                        font-weight: 600;
                        font-size: 14px;
                    ">Ke DashBoard</a>
                @endguest
            </div>
        </div>
    </div>

    <!-- Features -->
    <div style="max-width: 1200px; margin: 0 auto; padding: 60px 20px;">
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 24px;">
            <div style="
                background: white;
                padding: 24px;
                border-radius: 8px;
                box-shadow: 0 1px 3px rgba(0,0,0,0.08);
                border-left: 4px solid #C4A574;
            ">
                <div style="font-size: 32px; margin-bottom: 12px;">📦</div>
                <h3 style="font-size: 16px; margin-bottom: 8px; color: #1A1A1A; font-weight: 600;">Kelola Produk</h3>
                <p style="color: #666; line-height: 1.6; font-size: 14px;">Tambah, edit, dan hapus produk dengan mudah</p>
            </div>

            <div style="
                background: white;
                padding: 24px;
                border-radius: 8px;
                box-shadow: 0 1px 3px rgba(0,0,0,0.08);
                border-left: 4px solid #C4A574;
            ">
                <div style="font-size: 32px; margin-bottom: 12px;">📥</div>
                <h3 style="font-size: 16px; margin-bottom: 8px; color: #1A1A1A; font-weight: 600;">Barang Masuk</h3>
                <p style="color: #666; line-height: 1.6; font-size: 14px;">Catat barang masuk dari supplier</p>
            </div>

            <div style="
                background: white;
                padding: 24px;
                border-radius: 8px;
                box-shadow: 0 1px 3px rgba(0,0,0,0.08);
                border-left: 4px solid #C4A574;
            ">
                <div style="font-size: 32px; margin-bottom: 12px;">📤</div>
                <h3 style="font-size: 16px; margin-bottom: 8px; color: #1A1A1A; font-weight: 600;">Barang Keluar</h3>
                <p style="color: #666; line-height: 1.6; font-size: 14px;">Catat barang keluar dengan mudah</p>
            </div>

            <div style="
                background: white;
                padding: 24px;
                border-radius: 8px;
                box-shadow: 0 1px 3px rgba(0,0,0,0.08);
                border-left: 4px solid #C4A574;
            ">
                <div style="font-size: 32px; margin-bottom: 12px;">📊</div>
                <h3 style="font-size: 16px; margin-bottom: 8px; color: #1A1A1A; font-weight: 600;">Laporan</h3>
                <p style="color: #666; line-height: 1.6; font-size: 14px;">Lihat laporan stok dan transaksi</p>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer style="
        background: #2C2C2C;
        padding: 24px;
        text-align: center;
    ">
        <p style="color: #E0E0E0; font-size: 14px;">&copy; 2026 Fried Chicken Bu Asih. Semua hak cipta dilindungi.</p>
    </footer>
</div>
@endsection