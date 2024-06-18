<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @method static create(array $all)
 * @method static filterDate(array $filters)
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

    public function scopeFilterQuantity(Builder $query, array $filters): Builder
    {
        if(isset($filters['min_masuk'])) {
            $query->where('kuantitas_masuk', '>=', $filters['min_masuk']);
        }
        if(isset($filters['max_masuk'])) {
            $query->where('kuantitas_masuk', '<=', $filters['max_masuk']);
        }
        return $query;
    }

    public function scopeFilterDate(Builder $query, array $filters): Builder
    {
        if(isset($filters['min_tanggal'])) {
            $query->where('tanggal_masuk', '>=', $filters['min_tanggal']);
        }
        if(isset($filters['max_tanggal'])) {
            $query->where('tanggal_masuk', '<=', $filters['max_tanggal']);
        }
        return $query;
    }
}
