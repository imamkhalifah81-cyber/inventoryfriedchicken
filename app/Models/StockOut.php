<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StockOut extends Model
{
    protected $table = 'stock_outs';

    protected $fillable = [
        'product_id',
        'jumlah',
        'tanggal',
        'jenis_pengeluaran',
        'keterangan',
    ];

    protected $casts = [
        'tanggal' => 'date',
        'jumlah' => 'integer',
    ];

    /**
     * Relasi: Barang keluar milik satu produk
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Enum jenis pengeluaran
     */
    public const JENIS_PENJUALAN = 'penjualan';
    public const JENIS_RUSAK = 'rusak';
    public const JENIS_EXPIRED = 'expired';
    public const JENIS_HILANG = 'hilang';
    public const JENIS_LAINNYA = 'lainnya';
}