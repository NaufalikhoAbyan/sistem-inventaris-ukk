<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @method static create(array $all)
 * @method static filterCategory(array $filters)
 */
class Kategori extends Model
{
    protected $table = 'kategori';
    protected $fillable = [
        'deskripsi',
        'kategori'
    ];

    public function barang(): HasMany
    {
        return $this->hasMany(Barang::class);
    }

    public function scopeFilterCategory(Builder $query, array $filters): Builder
    {
        if(isset($filters['A'] ) && $filters['A']){
            $query->orWhere('kategori', '=', 'A');
        }
        if(isset($filters['M']) && $filters['M']){
            $query->orWhere('kategori', '=', 'M');
        }
        if(isset($filters['BHP']) && $filters['BHP']){
            $query->orWhere('kategori', '=', 'BHP');
        }
        if(isset($filters['BTHP']) && $filters['BTHP']){
            $query->orWhere('kategori', '=', 'BTHP');
        }
        if(isset($filters['search'])){
            $query->where('deskripsi', 'like', '%'.$filters['search'].'%');
        }
        return $query;
    }

    public function scopeFilterSearch(Builder $query, array $filters): Builder
    {
        if(isset($filters['search'])){
            $query->where('deskripsi', 'like', '%'.$filters['search'].'%');
        }
        return $query;
    }
}
