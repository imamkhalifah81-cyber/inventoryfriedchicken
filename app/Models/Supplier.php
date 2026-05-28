<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Supplier extends Model
{
    protected $table = 'suppliers';

    protected $fillable = [
        'nama_supplier',
        'no_hp',
        'alamat',
    ];

    /**
     * Relasi: Satu supplier bisa punya banyak barang masuk
     */
    public function stockIns(): HasMany
    {
        return $this->hasMany(StockIn::class);
    }
}