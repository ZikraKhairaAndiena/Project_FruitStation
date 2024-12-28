<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pembelian;
use App\Models\PembelianProduk;
use App\Models\Ongkir;

class CheckoutController extends Controller
{
    // Menampilkan form checkout dengan informasi keranjang dan total
    public function showCheckoutForm()
    {
        // Mengambil data keranjang dari session
        $cartItems = session()->get('cart', []);
        $subtotal = session()->get('subtotal', 0); // Subtotal harga produk dalam keranjang
        $discount = session()->get('discount', 0); // Diskon yang diterapkan
        $ongkir_tarif = session()->get('ongkir_tarif', 0); // Ongkos kirim (jika ada)
        $total = $subtotal - $discount + $ongkir_tarif; // Total harga setelah diskon dan ongkir

        // Mengambil semua data ongkir (tarif pengiriman)
        $ongkirs = Ongkir::all();

        // Mengembalikan tampilan checkout dengan data yang diperlukan
        return view('customer.checkout', compact('cartItems', 'subtotal', 'discount', 'total', 'ongkirs', 'ongkir_tarif'));
    }

    // Proses checkout, validasi, dan penyimpanan pembelian
    public function process(Request $request)
    {
        // Validasi data yang masuk dari form checkout
        $request->validate([
            'alamat_pengiriman' => 'required|string|max:255', // Validasi alamat pengiriman
            'ongkir_id' => 'required|exists:ongkirs,id', // Validasi ongkir yang dipilih
        ]);

        // Mengambil subtotal, diskon, dan ongkir dari session
        $subtotal = session('subtotal', 0);
        $discount = session('discount', 0);
        $ongkir = Ongkir::find($request->ongkir_id); // Mencari tarif ongkir berdasarkan ID

        // Pastikan ongkir ditemukan
        if (!$ongkir) {
            return redirect()->back()->withErrors(['ongkir' => 'Ongkir tidak ditemukan.']);
        }

        // Menghitung total pembelian (subtotal - diskon + ongkir)
        $total_pembelian = ($subtotal - $discount) + $ongkir->tarif;

        // Membuat record baru untuk pembelian
        $pembelian = Pembelian::create([
            'user_id' => auth()->id(), // Menyimpan ID pengguna yang sedang login
            'ongkir_id' => $ongkir->id, // Menyimpan ID ongkir yang dipilih
            'tanggal_pembelian' => now(), // Menyimpan tanggal pembelian
            'total_pembelian' => $total_pembelian, // Total harga setelah diskon dan ongkir
            'discount' => $discount, // Menyimpan jumlah diskon
            'nama_kota' => $ongkir->nama_kota, // Nama kota dari ongkir
            'tarif' => $ongkir->tarif, // Tarif ongkir
            'alamat_pengiriman' => $request->alamat_pengiriman, // Alamat pengiriman
            'status_pembelian' => 'pending', // Status pembelian sementara
        ]);

        // Menyimpan produk yang ada di keranjang ke dalam tabel pembelian_produks
        foreach (session('cart', []) as $item) {
            PembelianProduk::create([
                'pembelian_id' => $pembelian->id, // ID pembelian terkait
                'produk_id' => $item['id'], // ID produk
                'nama_produk' => $item['name'], // Nama produk
                'jumlah_produk' => $item['quantity'], // Jumlah produk yang dibeli
                'harga_produk' => $item['price'], // Harga produk per unit
                'subtotal' => $item['quantity'] * $item['price'], // Subtotal harga produk
            ]);
        }

        // Menghapus data keranjang dan informasi terkait dari session setelah checkout selesai
        session()->forget(['cart', 'subtotal', 'discount', 'ongkir_tarif']);

        // Redirect ke halaman nota dengan ID pembelian
        return redirect()->route('nota', ['id' => $pembelian->id]);
    }

    // Menampilkan nota pembelian setelah checkout
    public function nota($id)
    {
        // Mengambil data pembelian beserta informasi ongkir dan produk yang dibeli
        $pembelian = Pembelian::with('ongkir', 'pembelianProduk')->findOrFail($id);

        // Mengembalikan tampilan nota dengan data pembelian yang relevan
        return view('customer.nota', compact('pembelian'));
    }
}
