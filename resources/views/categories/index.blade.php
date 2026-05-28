@extends('layouts.app')

@section('title', 'Daftar Kategori')

@section('content')
<div style="min-height: 100vh; background: #f5f5f5;">
    <!-- Navbar -->
    <nav style="
        background: white;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        position: sticky;
        top: 0;
        z-index: 50;
    ">
        <div style="
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 60px;
        ">
            <h1 style="font-size: 18px; font-weight: bold; color: #333; margin: 0;">
                📊 INVENTORY
            </h1>
            <div style="display: flex; gap: 12px; align-items: center;">
                <span style="color: #333; font-weight: 500;">{{ Auth::user()->name }}</span>
                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" style="
                        background: #f44336;
                        color: white;
                        padding: 8px 16px;
                        border: none;
                        border-radius: 4px;
                        font-weight: 500;
                        cursor: pointer;
                    ">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <!-- Sidebar & Content -->
    <div style="display: flex; max-width: 1200px; margin: 0 auto;">
        <!-- Sidebar -->
        <aside style="
            width: 250px;
            background: white;
            padding: 20px;
            box-shadow: 2px 0 4px rgba(0,0,0,0.1);
            height: calc(100vh - 60px);
            position: sticky;
            top: 60px;
        ">
            <h3 style="font-size: 14px; font-weight: 600; text-transform: uppercase; color: #666; margin-bottom: 16px;">Menu</h3>
            <nav style="display: flex; flex-direction: column; gap: 8px;">
                <a href="{{ route('dashboard') }}" style="
                    padding: 10px 16px;
                    border-radius: 4px;
                    text-decoration: none;
                    color: #333;
                    transition: all 0.3s;
                " onmouseover="this.style.backgroundColor='#f0f0f0'" onmouseout="this.style.backgroundColor='transparent'">
                    📈 Dashboard
                </a>
                <a href="{{ route('categories.index') }}" style="
                    padding: 10px 16px;
                    border-radius: 4px;
                    text-decoration: none;
                    background: #e3f2fd;
                    color: #1976d2;
                    font-weight: 600;
                ">
                    📁 Kategori
                </a>
                <a href="#" style="
                    padding: 10px 16px;
                    border-radius: 4px;
                    text-decoration: none;
                    color: #999;
                    cursor: not-allowed;
                ">
                    📦 Produk (soon)
                </a>
                <a href="#" style="
                    padding: 10px 16px;
                    border-radius: 4px;
                    text-decoration: none;
                    color: #999;
                    cursor: not-allowed;
                ">
                    🏢 Supplier (soon)
                </a>
            </nav>
        </aside>

        <!-- Main Content -->
        <main style="flex: 1; padding: 40px 20px;">
            <div style="
                background: white;
                border-radius: 8px;
                box-shadow: 0 2px 8px rgba(0,0,0,0.1);
                padding: 32px;
            ">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 32px;">
                    <h1 style="font-size: 32px; margin: 0; color: #333;">Daftar Kategori</h1>
                    <a href="{{ route('categories.create') }}" style="
                        background: #4CAF50;
                        color: white;
                        padding: 12px 24px;
                        border-radius: 4px;
                        text-decoration: none;
                        font-weight: 600;
                    ">+ Tambah Kategori</a>
                </div>

                <!-- Alert -->
                @if (session('success'))
                    <div style="
                        background: #d4edda;
                        color: #155724;
                        border: 1px solid #c3e6cb;
                        padding: 12px 16px;
                        border-radius: 4px;
                        margin-bottom: 20px;
                    ">
                        ✅ {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div style="
                        background: #f8d7da;
                        color: #721c24;
                        border: 1px solid #f5c6cb;
                        padding: 12px 16px;
                        border-radius: 4px;
                        margin-bottom: 20px;
                    ">
                        ❌ {{ session('error') }}
                    </div>
                @endif

                <!-- Table -->
                @if ($categories->isEmpty())
                    <div style="
                        background: #f9f9f9;
                        padding: 40px;
                        text-align: center;
                        border-radius: 4px;
                    ">
                        <p style="color: #999; margin: 0;">Belum ada kategori. Silakan tambah kategori baru.</p>
                    </div>
                @else
                    <table style="width: 100%; border-collapse: collapse; background: white;">
                        <thead>
                            <tr style="background: #f5f5f5; border-bottom: 2px solid #ddd;">
                                <th style="padding: 12px; text-align: left; font-weight: 600;">No</th>
                                <th style="padding: 12px; text-align: left; font-weight: 600;">Nama Kategori</th>
                                <th style="padding: 12px; text-align: left; font-weight: 600;">Dibuat</th>
                                <th style="padding: 12px; text-align: center; font-weight: 600;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                                <tr style="border-bottom: 1px solid #eee;">
                                    <td style="padding: 12px;">{{ $loop->iteration }}</td>
                                    <td style="padding: 12px;">{{ $category->name_kategori }}</td>
                                    <td style="padding: 12px;">{{ $category->created_at->format('d-m-Y H:i') }}</td>
                                    <td style="padding: 12px; text-align: center;">
                                        <a href="{{ route('categories.show', $category->id) }}" style="
                                            background: #4CAF50;
                                            color: white;
                                            padding: 6px 12px;
                                            border-radius: 4px;
                                            text-decoration: none;
                                            font-size: 12px;
                                            margin-right: 4px;
                                            display: inline-block;
                                        ">View</a>
                                        <a href="{{ route('categories.edit', $category->id) }}" style="
                                            background: #2196F3;
                                            color: white;
                                            padding: 6px 12px;
                                            border-radius: 4px;
                                            text-decoration: none;
                                            font-size: 12px;
                                            margin-right: 4px;
                                            display: inline-block;
                                        ">Edit</a>
                                        <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" style="
                                                background: #f44336;
                                                color: white;
                                                padding: 6px 12px;
                                                border: none;
                                                border-radius: 4px;
                                                cursor: pointer;
                                                font-size: 12px;
                                            " onclick="return confirm('Yakin hapus?')">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </main>
    </div>
</div>
@endsection