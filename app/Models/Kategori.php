<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @method static create(array $all)
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
}
