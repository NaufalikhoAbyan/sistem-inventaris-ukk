<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
