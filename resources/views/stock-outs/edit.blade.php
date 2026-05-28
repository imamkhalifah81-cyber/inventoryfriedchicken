@extends('layouts.app')

@section('title', 'Edit Barang Keluar')

@section('content')
<div style="max-width:600px; margin:auto; padding:30px;">

    <h2>Edit Barang Keluar</h2>

    <form action="{{ route('stock-outs.update', $stockOut->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label>Produk</label>
            <select name="product_id">
                @foreach($products as $p)
                    <option value="{{ $p->id }}"
                        {{ $stockOut->product_id == $p->id ? 'selected' : '' }}>
                        {{ $p->name_barang }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label>Jumlah</label>
            <input type="number" name="jumlah" value="{{ $stockOut->jumlah }}">
        </div>

        <div>
            <label>Jenis</label>
            <select name="jenis_pengeluaran">
                @foreach(['penjualan','rusak','expired','hilang','lainnya'] as $jenis)
                    <option value="{{ $jenis }}"
                        {{ $stockOut->jenis_pengeluaran == $jenis ? 'selected' : '' }}>
                        {{ $jenis }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label>Tanggal</label>
            <input type="date" name="tanggal" value="{{ $stockOut->tanggal->format('Y-m-d') }}">
        </div>

        <div>
            <label>Keterangan</label>
            <input type="text" name="keterangan" value="{{ $stockOut->keterangan }}">
        </div>

        <button type="submit">Update</button>
    </form>

</div>
@endsection