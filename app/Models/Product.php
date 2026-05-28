<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = [
        'name_barang',
        'stok',
        'satuan',
        'harga',
        'gambar',
        'category_id',
    ];

    protected $casts = [
        'harga' => 'decimal:2',
        'stok' => 'integer',
    ];

    /**
     * Relasi: Produk milik satu kategori
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Relasi: Satu produk bisa punya banyak stok masuk
     */
    public function stockIns(): HasMany
    {
        return $this->hasMany(StockIn::class);
    }

    /**
     * Relasi: Satu produk bisa punya banyak stok keluar
     */
    public function stockOuts(): HasMany
    {
        return $this->hasMany(StockOut::class);
    }
}