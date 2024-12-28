<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $fillable = [
        'produk_id', 'kategori_id', 'nama_produk', 'stok_produk', 'satuan', 'harga_produk', 'deskripsi_produk', 'gambar_produk'
    ];

    // Relasi ke model Kategori
    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    protected $table = 'produks';


    // Relasi ke model Promosi
    public function promosis()
    {
        return $this->hasMany(Promosi::class, 'produk_id');
    }

    // Relasi ke model PembelianProduk
    public function pembelianproduks()
    {
        return $this->hasMany(PembelianProduk::class);
    }
}
