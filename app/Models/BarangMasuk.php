<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @method static create(array $all)
 */
class BarangMasuk extends Model
{
    protected $table = 'barang_masuk';

    protected $fillable = [
        'tanggal_masuk',
        'kuantitas_masuk',
        'barang_id'
    ];

    public function barang(): BelongsTo
    {
        return $this->belongsTo(Barang::class, 'barang_id');
    }
}
