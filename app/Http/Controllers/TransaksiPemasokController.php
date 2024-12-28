<?php

namespace App\Http\Controllers;

use App\Models\Pemasok;
use App\Models\Produk;
use App\Models\TransaksiPemasok;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class TransaksiPemasokController extends Controller
{
    /**
     * Menampilkan daftar transaksi pemasok.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        // Ambil nilai pencarian dan rentang tanggal dari request
        $search = $request->get('search');
        $start_date = $request->get('start_date');
        $end_date = $request->get('end_date');

        // Ambil transaksi pemasok dengan filter pencarian
        $transaksis = TransaksiPemasok::with('pemasok', 'produk')
            ->when($search, function ($query, $search) {
                // Mencari berdasarkan nama pemasok atau produk
                return $query->whereHas('pemasok', function($q) use ($search) {
                        $q->where('nama_pemasok', 'like', '%'.$search.'%');
                    })
                    ->orWhereHas('produk', function($q) use ($search) {
                        $q->where('nama_produk', 'like', '%'.$search.'%');
                    });
            })
            ->when($start_date && $end_date, function ($query) use ($start_date, $end_date) {
                // Mencari berdasarkan rentang tanggal
                return $query->whereBetween('tanggal_transaksi', [$start_date, $end_date]);
            })
            ->paginate(10);

        // Kembalikan data ke view
        return view('dashboard.transaksipemasok.index', compact('transaksis'));
    }


    /**
     * Menampilkan form untuk membuat transaksi baru.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // Ambil semua data pemasok dan produk untuk dropdown
        $pemasoks = Pemasok::all();
        $produks = Produk::all();

        // Kembalikan ke view untuk form pembuatan transaksi
        return view('dashboard.transaksipemasok.create', compact('pemasoks', 'produks'));
    }

    /**
     * Menyimpan transaksi pemasok baru ke dalam database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validasi data input
        $request->validate([
            'pemasok_id' => 'required|exists:pemasoks,id', // Validasi pemasok_id
            'produk_id' => 'required|exists:produks,id',   // Validasi produk_id
            'jumlah' => 'required|integer|min:1',          // Validasi jumlah harus positif
            'total_harga' => 'required|numeric|min:1',     // Validasi total harga
            'tanggal_transaksi' => 'required|date',        // Validasi tanggal transaksi
        ]);

        // Ambil data produk yang terlibat dalam transaksi
        $produk = Produk::findOrFail($request->produk_id);

        // Simpan transaksi pemasok baru
        $transaksi = TransaksiPemasok::create([
            'pemasok_id' => $request->pemasok_id,
            'produk_id' => $request->produk_id,
            'jumlah' => $request->jumlah,
            'total_harga' => $request->total_harga,
            'tanggal_transaksi' => $request->tanggal_transaksi,
        ]);

        // Update stok produk setelah transaksi
        $produk->stok_produk += $request->jumlah; // Tambah jumlah stok sesuai jumlah yang dibeli
        $produk->save();

        // Redirect ke halaman daftar transaksi dengan pesan sukses
        return redirect()->route('dashboard.transaksipemasok.index')->with('success', 'Transaksi berhasil ditambahkan dan stok produk diperbarui.');
    }

    /**
     * Menampilkan detail transaksi pemasok berdasarkan ID.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        // Ambil transaksi dengan relasi ke pemasok dan produk
        $transaksi = TransaksiPemasok::with('produk', 'pemasok')->findOrFail($id);

        // Kembalikan ke view dengan data transaksi
        return view('dashboard.transaksipemasok.show', compact('transaksi'));
    }

    /**
     * Menampilkan form untuk mengedit transaksi pemasok.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        // Retrieve the transaksi data by its ID
        $transaksi = TransaksiPemasok::findOrFail($id);

        // Get any other necessary data like pemasok and produk
        $pemasok = Pemasok::all();
        $produk = Produk::all();

        // Return the edit view with the transaksi, pemasok, and produk data
        return view('dashboard.transaksipemasok.edit', compact('transaksi', 'pemasok', 'produk'));
    }

    /**
     * Memperbarui transaksi pemasok yang sudah ada.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        // Ambil data transaksi pemasok berdasarkan ID
        $transaksiPemasok = TransaksiPemasok::findOrFail($id);

        // Validasi data input
        $request->validate([
            'pemasok_id' => 'required|exists:pemasoks,id',
            'produk_id' => 'required|exists:produks,id',
            'jumlah' => 'required|integer|min:1',
            'total_harga' => 'required|numeric|min:1',
            'tanggal_transaksi' => 'required|date',
        ]);

        // Ambil data produk lama dan baru
        $produkLama = Produk::findOrFail($transaksiPemasok->produk_id);
        $produkBaru = Produk::findOrFail($request->produk_id);

        // Jika produk yang diubah, kita harus mengupdate stok pada produk yang lama dan yang baru
        if ($produkLama->id != $produkBaru->id) {
            // Mengurangi stok produk lama
            $produkLama->stok_produk -= $transaksiPemasok->jumlah;
            $produkLama->save();

            // Menambah stok produk baru
            $produkBaru->stok_produk += $request->jumlah;
            $produkBaru->save();
        } else {
            // Jika produk tidak berubah, kita hanya update stok produk yang sama
            $produkLama->stok_produk -= $transaksiPemasok->jumlah;
            $produkLama->stok_produk += $request->jumlah;
            $produkLama->save();
        }

        // Update transaksi dengan data yang baru
        $transaksiPemasok->update($request->all());

        // Redirect ke halaman daftar transaksi dengan pesan sukses
        return redirect()->route('dashboard.transaksipemasok.index')->with('success', 'Transaksi berhasil diperbarui dan stok produk diperbarui.');
    }

    /**
     * Menghapus transaksi pemasok berdasarkan ID.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        // Ambil data transaksi pemasok yang ingin dihapus
        $transaksiPemasok = TransaksiPemasok::findOrFail($id);

        // Ambil produk yang terkait
        $produk = Produk::findOrFail($transaksiPemasok->produk_id);

        // Kurangi stok produk berdasarkan jumlah yang dibeli pada transaksi yang dihapus
        $produk->stok_produk -= $transaksiPemasok->jumlah;
        $produk->save();

        // Hapus transaksi
        $transaksiPemasok->delete();

        // Redirect ke halaman daftar transaksi dengan pesan sukses
        return redirect()->route('dashboard.transaksipemasok.index')->with('success', 'Transaksi berhasil dihapus dan stok produk diperbarui.');
    }

    public function cetakPdf(Request $request)
    {
        // Ambil filter bulan dan tahun
        $bulan = $request->get('bulan');
        $tahun = $request->get('tahun');

        // Build the query for filtering transaksi
        $transaksis = TransaksiPemasok::query();

        // Pastikan bulan dan tahun ada dan valid
        if ($bulan) {
            // Pastikan bulan adalah angka antara 1 dan 12
            if ($bulan >= 1 && $bulan <= 12) {
                $transaksis = $transaksis->whereMonth('tanggal_transaksi', $bulan);
            }
        }

        if ($tahun) {
            // Pastikan tahun adalah angka yang valid
            $transaksis = $transaksis->whereYear('tanggal_transaksi', $tahun);
        }

        // Ambil data transaksi tanpa pagination untuk keperluan cetak PDF
        $transaksis = $transaksis->get();

        // Gunakan view untuk menghasilkan PDF
        $pdf = Pdf::loadView('dashboard.transaksipemasok.cetak_pdf', compact('transaksis', 'bulan', 'tahun'));

        // Return PDF
        return $pdf->stream('laporan_transaksi_pemasok.pdf');
    }

}
