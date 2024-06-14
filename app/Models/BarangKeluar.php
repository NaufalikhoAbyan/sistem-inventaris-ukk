<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @method static create(array $validate)
 */
class BarangKeluar extends Model
{
    protected $table = 'barang_keluar';

    protected $fillable = [
        'tanggal_keluar',
        'kuantitas_keluar',
        'barang_id'
    ];

    public function barang(): BelongsTo
    {
        return $this->belongsTo(Barang::class, 'barang_id');
    }
}
