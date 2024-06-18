<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @method static create(array $validate)
 * @method static filterDate(array $filters)
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

    public function scopeFilterQuantity(Builder $query, array $filters): Builder
    {
        if(isset($filters['min_keluar'])) {
            $query->where('kuantitas_keluar', '>=', $filters['min_keluar']);
        }
        if(isset($filters['max_keluar'])) {
            $query->where('kuantitas_keluar', '<=', $filters['max_keluar']);
        }
        return $query;
    }

    public function scopeFilterDate(Builder $query, array $filters): Builder
    {
        if(isset($filters['min_tanggal'])) {
            $query->where('tanggal_keluar', '>=', $filters['min_tanggal']);
        }
        if(isset($filters['max_tanggal'])) {
            $query->where('tanggal_keluar', '<=', $filters['max_tanggal']);
        }
        return $query;
    }
}
