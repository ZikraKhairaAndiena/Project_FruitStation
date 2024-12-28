<?php

namespace App\Http\Controllers;

use App\Models\Pembelian;
use Illuminate\Http\Request;

class NotaController extends Controller
{
    /**
     * Menampilkan halaman nota pembelian berdasarkan ID pembelian.
     */
    public function show($id)
    {
        // Mengambil data pembelian dengan relasi 'ongkir' dan 'pembelianProduks' berdasarkan ID
        $pembelian = Pembelian::with('ongkir', 'pembelianProduks')->findOrFail($id);

        // Inisialisasi total pembelian
        $totalPembelian = 0;

        // Iterasi melalui setiap produk yang dibeli dalam pembelian ini
        foreach ($pembelian->pembelianProduks as $produk) {

            // Pembagian diskon di sini dihitung berdasarkan jumlah produk yang dibeli
            $hargaSetelahDiskon = $produk->harga_produk - ($pembelian->discount / count($pembelian->pembelianProduks));

            // Hitung total pembelian untuk produk ini (harga setelah diskon dikali jumlah produk yang dibeli)
            $totalPembelian += $hargaSetelahDiskon * $produk->jumlah_produk;
        }

        // Data yang dikirimkan ke view: 'pembelian' (detail pembelian) dan 'totalPembelian' (total harga setelah diskon)
        return view('customer.nota', compact('pembelian', 'totalPembelian'));
    }
}
