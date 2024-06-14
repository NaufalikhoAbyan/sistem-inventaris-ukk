<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @method static create(array $all)
 * @method static find(mixed $item_id)
 */
class Barang extends Model
{
    protected $table = 'barang';

    protected $fillable = [
        'merk',
        'seri',
        'spesifikasi',
        'stok',
        'kategori_id'
    ];

    public function kategori(): BelongsTo
    {
        return $this->belongsTo(Kategori::class);
    }

    public function barangMasuk(): HasMany
    {
        return $this->hasMany(BarangMasuk::class);
    }

    public function barangKeluar(): HasMany
    {
        return $this->hasMany(BarangKeluar::class);
    }
}
