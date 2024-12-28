<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    // Menampilkan halaman dashboard dengan informasi produk terlaris, customer teratas, dan notifikasi
    public function dashboard()
    {
        // Mengambil data 5 produk terlaris berdasarkan jumlah pembelian
        $produkTerlaris = Produk::select('id', 'nama_produk', 'gambar_produk') // Pilih hanya kolom yang dibutuhkan (id, nama, gambar produk)
            ->withCount('pembelianproduks') // Hitung jumlah relasi pembelian produk
            ->orderByDesc('pembelianproduks_count') // Urutkan berdasarkan jumlah pembelian terbanyak
            ->take(5) // Ambil 5 produk terlaris
            ->get(); // Ambil data produk terlaris

        // Mengambil 5 customer teratas berdasarkan jumlah pesanan yang sudah dibayar
        $topCustomers = User::select('id', 'name', 'email') // Pilih hanya kolom yang dibutuhkan (id, nama, email)
            ->withCount(['pembelians as total_pembelian' => function ($query) {
                $query->where('status_pembelian', 'sudah kirim pembayaran'); // Hanya menghitung pesanan yang sudah dibayar
            }])
            ->where('role', 'customer') // Filter untuk user dengan role 'customer'
            ->orderByDesc('total_pembelian') // Urutkan berdasarkan total pesanan terbanyak
            ->take(5) // Ambil 5 customer teratas
            ->get(); // Ambil data customer teratas

        // Menemukan admin yang sedang login dan mengambil notifikasi yang belum dibaca
        $admin = auth()->user(); // Mendapatkan informasi admin yang sedang login
        $notifikasi = $admin->notifications; // Mengambil semua notifikasi yang dimiliki admin

        // Mengirimkan data produk terlaris, top customer, dan notifikasi ke tampilan dashboard
        return view('dashboard.index', compact('produkTerlaris', 'topCustomers', 'notifikasi'));
    }
}
