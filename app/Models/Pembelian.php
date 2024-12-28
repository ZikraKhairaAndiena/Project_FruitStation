<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembelian extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'ongkir_id',
        'tanggal_pembelian',
        'total_pembelian',
        'nama_kota',
        'discount',
        'tarif',
        'alamat_pengiriman',
        'status_pembelian',
        'resi_pengiriman',
    ];

    // Menentukan nama tabel jika berbeda dari konvensi
    // protected $table = 'pembelian'; // Uncomment jika nama tabel berbeda

    protected $casts = [
        'tanggal_pembelian' => 'datetime',
    ];

    // Relasi ke model Ongkir
    public function ongkir()
    {
        return $this->belongsTo(Ongkir::class);
    }

    // Relasi ke model Pembayaran
    public function pembayaran()
    {
        return $this->hasOne(Pembayaran::class, 'pembelian_id');
    }

    // Relasi ke model PembelianProduk
    public function pembelianProduks()
    {
        return $this->hasMany(PembelianProduk::class, 'pembelian_id');
    }

    // Relasi ke model User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke model Ulasan
    public function ulasan()
    {
        return $this->hasOne(Ulasan::class);
    }

    // Relasi ke model Produk
    public function produk()
    {
        return $this->belongsTo(Produk::class); // Asumsikan Produk adalah model yang menyimpan data produk
    }

}
