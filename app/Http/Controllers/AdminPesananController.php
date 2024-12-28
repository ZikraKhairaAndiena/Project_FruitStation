<?php

namespace App\Http\Controllers;

use App\Models\Pembelian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class AdminPesananController extends Controller
{
    // Menampilkan daftar pesanan dengan fitur pencarian dan pengurutan
    public function index(Request $request)
    {
        // Mendapatkan query pencarian dari inputan user
        $search = $request->input('search');

        // Query untuk mengambil data pesanan dengan pencarian dan pengurutan
        $pesanans = Pembelian::when($search, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                // Pencarian berdasarkan nama pengguna yang terkait dengan pesanan
                $query->whereHas('user', function ($query) use ($search) {
                    $query->where('name', 'like', "%{$search}%"); // Mencocokkan nama pengguna
                })
                // Pencarian berdasarkan alamat pengiriman
                ->orWhere('alamat_pengiriman', 'like', "%{$search}%"); // Mencocokkan alamat pengiriman
            });
        })
        ->with('user', 'ongkir') // Memuat relasi dengan model User dan Ongkir secara eager loading
        // Urutkan berdasarkan status pembelian, 'sudah kirim pembayaran' di urutan pertama
        ->orderByRaw("FIELD(status_pembelian, 'sudah kirim pembayaran') DESC")
        // Urutkan berdasarkan tanggal pembelian terbaru
        ->orderBy('tanggal_pembelian', 'desc')
        // Urutkan berdasarkan status 'barang dikirim' di urutan tengah
        ->orderByRaw("FIELD(status_pembelian, 'barang dikirim') DESC")
        // Urutkan status 'selesai' di urutan terakhir
        ->orderByRaw("FIELD(status_pembelian, 'selesai') ASC")
        // Paginasi hasil query, menampilkan 10 data per halaman
        ->paginate(10);

        // Mengembalikan view dengan data pesanan yang telah difilter dan diurutkan
        return view('dashboard.pesanan.index', compact('pesanans'));
    }

    // Menampilkan detail pesanan berdasarkan ID
    public function show($id)
    {
        // Menemukan data pesanan berdasarkan ID dan memuat relasi user dan ongkir
        $pesanan = Pembelian::with('user', 'ongkir')->findOrFail($id);
        // Mengembalikan view untuk menampilkan detail pesanan
        return view('dashboard.pesanan.show', compact('pesanan'));
    }

    // Menampilkan form untuk mengedit pesanan berdasarkan ID
    public function edit($id)
    {
        // Menemukan data pesanan berdasarkan ID
        $pesanan = Pembelian::findOrFail($id);
        // Mengembalikan view untuk menampilkan form edit pesanan
        return view('dashboard.pesanan.edit', compact('pesanan'));
    }

    // Mengupdate data pesanan berdasarkan ID
    public function update(Request $request, $id)
    {
        // Mendapatkan informasi user yang sedang login
        $user = Auth::user();

        // Mengecek apakah pengguna memiliki role yang sesuai
        if (!$user || !isset($user->role)) {
            return redirect()->route('dashboard.pesanan.index')->with('error', 'Pengguna tidak memiliki akses.');
        }

        // Menemukan data pesanan berdasarkan ID
        $pesanan = Pembelian::findOrFail($id);

        // Validasi inputan berdasarkan role user
        if ($user->role === 'kurir') {
            // Validasi untuk kurir, hanya dapat mengubah status pembelian
            $request->validate([
                'status_pembelian' => 'required|string|in:barang dikirim,selesai,batal',
            ]);
            // Update status pembelian pesanan
            $pesanan->status_pembelian = $request->status_pembelian;
        } elseif ($user->role === 'admin') {
            // Validasi untuk admin, hanya dapat mengubah resi pengiriman
            $request->validate([
                'resi_pengiriman' => 'nullable|string|unique:pembelians,resi_pengiriman,' . $id,
            ], [
                // Pesan error jika resi pengiriman sudah ada
                'resi_pengiriman.unique' => 'Resi pengiriman sudah digunakan, harap gunakan resi yang berbeda.',
            ]);
            // Update resi pengiriman pesanan
            $pesanan->resi_pengiriman = $request->resi_pengiriman;
        } else {
            // Jika pengguna tidak memiliki akses yang tepat
            return redirect()->route('dashboard.pesanan.index')->with('error', 'Anda tidak memiliki izin untuk melakukan perubahan ini.');
        }

        // Simpan perubahan ke database
        $pesanan->save();

        // Mengalihkan pengguna ke halaman pesanan dengan pesan sukses
        return redirect()->route('dashboard.pesanan.index')->with('pesan', 'Data pesanan berhasil diperbarui.');
    }

    // Fungsi untuk mencetak laporan pesanan dalam format PDF
    public function cetakPdf(Request $request)
    {
        // Membuat query untuk mengambil data pesanan
        $query = Pembelian::query();

        // Filter berdasarkan bulan jika ada inputan bulan
        if ($request->filled('bulan')) {
            $query->whereMonth('tanggal_pembelian', $request->bulan);
        }
        // Filter berdasarkan tahun jika ada inputan tahun
        if ($request->filled('tahun')) {
            $query->whereYear('tanggal_pembelian', $request->tahun);
        }

        // Menyertakan relasi 'user' dan 'ongkir' dalam query
        $pesanans = $query->with('user', 'ongkir')->get();

        // Menghasilkan file PDF dengan view tertentu dan data pesanan
        $pdf = Pdf::loadView('dashboard.pesanan.cetak_pdf', compact('pesanans'));
        // Menampilkan PDF sebagai stream (langsung diunduh atau ditampilkan)
        return $pdf->stream('laporan_pesanan.pdf');
    }

}
