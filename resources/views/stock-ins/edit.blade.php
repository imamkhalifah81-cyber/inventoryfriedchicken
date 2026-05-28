@extends('layouts.app')

@section('title', 'Edit Barang Masuk')

@section('content')
<div style="padding:40px; max-width:700px; margin:auto;">
    <div style="background:white; padding:30px; border-radius:8px;">
        <h1 style="margin-bottom:24px;">Edit Barang Masuk</h1>

        @if($errors->any())
            <div style="background:#f8d7da; color:#721c24; padding:12px; border-radius:4px; margin-bottom:20px;">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('stock-ins.update', $stockIn->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div style="margin-bottom:20px;">
                <label>Produk</label>

                <select name="product_id" required style="width:100%; padding:12px;">
                    @foreach($products as $product)
                        <option value="{{ $product->id }}"
                            {{ $stockIn->product_id == $product->id ? 'selected' : '' }}>
                            {{ $product->name_barang }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div style="margin-bottom:20px;">
                <label>Supplier</label>

                <select name="supplier_id" required style="width:100%; padding:12px;">
                    @foreach($suppliers as $supplier)
                        <option value="{{ $supplier->id }}"
                            {{ $stockIn->supplier_id == $supplier->id ? 'selected' : '' }}>
                            {{ $supplier->nama_supplier }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div style="margin-bottom:20px;">
                <label>Jumlah</label>

                <input type="number"
                       name="jumlah"
                       min="1"
                       value="{{ $stockIn->jumlah }}"
                       required
                       style="width:100%; padding:12px;">
            </div>

            <div style="margin-bottom:20px;">
                <label>Tanggal</label>

                <input type="date"
                       name="tanggal"
                       value="{{ $stockIn->tanggal->format('Y-m-d') }}"
                       required
                       style="width:100%; padding:12px;">
            </div>

            <button type="submit"
                    style="background:#2196F3; color:white; padding:12px 20px; border:none; border-radius:4px;">
                Update
            </button>
        </form>
    </div>
</div>
@endsection