<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    /** @use HasFactory<\Database\Factories\KategoriFactory> */
    use HasFactory;

    protected $fillable = ['nama_kategori'];

    // Relasi ke model Produk
    public function produk()
    {
        return $this->hasMany(Produk::class);
    }

    protected $table = 'kategoris';
}
