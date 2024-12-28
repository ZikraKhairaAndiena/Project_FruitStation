<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemasok extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_pemasok',
        'no_telepon',
        'no_rekening',
        'alamat',
    ];

    // Relasi ke model TransaksiPemasok
    public function transaksiPemasoks()
    {
        return $this->hasMany(TransaksiPemasok::class, 'pemasok_id');
    }
}
