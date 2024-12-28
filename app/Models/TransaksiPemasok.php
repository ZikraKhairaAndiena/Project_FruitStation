<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiPemasok extends Model
{
    use HasFactory;

    protected $fillable = [
        'pemasok_id',
        'produk_id',  // Menggunakan produk_id untuk relasi dengan produk
        'jumlah',
        'total_harga',
        'tanggal_transaksi',
    ];

    protected $casts = [
        'tanggal_transaksi' => 'datetime',  // Ensure the date is cast to Carbon
    ];

    // Relasi ke model Pemasok
    public function pemasok()
    {
        return $this->belongsTo(Pemasok::class, 'pemasok_id');
    }

    // Relasi ke model Produk
    public function produk()
    {
        return $this->belongsTo(Produk::class, 'produk_id');
    }
}
