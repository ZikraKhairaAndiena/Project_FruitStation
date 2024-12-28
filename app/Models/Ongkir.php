<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ongkir extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_kota',
        'tarif',
    ];

    // Relasi ke model Pembelian
    public function pembelians()
    {
        return $this->hasMany(Pembelian::class);
    }

}
