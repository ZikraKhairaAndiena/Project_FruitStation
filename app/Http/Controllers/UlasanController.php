<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pembelian;
use App\Models\Ulasan;

class UlasanController extends Controller
{
    /**
     * Menampilkan halaman formulir untuk membuat ulasan baru.
     *
     * @param int $id ID pembelian yang akan diulas
     * @return \Illuminate\View\View
     */
    public function create($id)
    {
        // Mencari data pembelian berdasarkan ID atau menampilkan error jika tidak ditemukan
        $pembelian = Pembelian::findOrFail($id);

        // Mengembalikan view dengan data pembelian
        return view('customer.ulasan', compact('pembelian'));
    }

    /**
     * Menyimpan ulasan baru ke dalam database.
     *
     * @param \Illuminate\Http\Request $request Data request yang dikirim dari formulir
     * @param int $id ID pembelian yang diulas
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, $id)
    {
        // Validasi input dari pengguna
        $request->validate([
            'rating' => 'required|integer|min:1|max:5', // Rating harus berupa angka antara 1-5
            'komentar' => 'required|string|max:500',   // Komentar harus berupa string dengan panjang maksimal 500 karakter
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Foto harus berupa file gambar dengan ukuran maksimal 2 MB
        ]);

        // Menyiapkan data ulasan
        $ulasanData = [
            'pembelian_id' => $id,       // Menyimpan ID pembelian yang diulas
            'rating' => $request->rating, // Menyimpan nilai rating
            'komentar' => $request->komentar, // Menyimpan komentar
        ];

        // Memeriksa apakah ada file foto yang diunggah
        if ($request->hasFile('foto')) {
            // Membuat nama file unik berdasarkan waktu
            $fileName = time() . '.' . $request->foto->extension();

            // Menyimpan file ke direktori penyimpanan dengan nama yang ditentukan
            $path = $request->foto->storeAs('public/img', $fileName);

            // Memeriksa apakah file berhasil diunggah
            if ($path) {
                // Menyimpan path relatif ke data ulasan
                $ulasanData['foto'] = 'img/' . $fileName;
            } else {
                // Mengembalikan pesan error jika unggahan foto gagal
                return redirect()->back()->withErrors(['foto' => 'Gagal mengunggah foto.']);
            }
        }

        // Menyimpan data ulasan ke dalam database
        Ulasan::create($ulasanData);

        // Redirect ke halaman riwayat belanja dengan pesan sukses
        return redirect()->route('riwayat.belanja')->with('success', 'Ulasan berhasil disimpan!');
    }
}
