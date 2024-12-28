<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pembelian;
use Illuminate\Support\Facades\Auth;

class RiwayatBelanjaController extends Controller
{
    public function index()
    {
        // Mendapatkan pengguna yang terautentikasi
        $user = Auth::user();

        // Mengambil riwayat belanja pengguna, termasuk produk yang dibeli dan ulasan terkait
        $pembelian = Pembelian::with(['pembelianProduks', 'ulasan']) // Memuat relasi: produk pembelian dan ulasan
            ->where('user_id', $user->id) // Menyaring data berdasarkan ID pengguna yang sedang login
            ->get(); // Mengambil semua data yang sesuai

        // Mengembalikan view dengan data riwayat belanja pengguna
        return view('customer.riwayat', compact('user', 'pembelian'));
    }
}
