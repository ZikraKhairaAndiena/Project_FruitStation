<?php

namespace App\Http\Controllers;

use App\Models\Pemasok;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PemasokController extends Controller
{
    /**
     * Menampilkan daftar pemasok dengan fitur pencarian dan pagination.
     */
    public function index(Request $request)
    {
        // Mendapatkan nilai pencarian dari request (jika ada)
        $search = $request->get('search');

        // Mengambil data pemasok dengan filter pencarian jika ada
        // Filter berdasarkan nama_pemasok, alamat, atau no_telepon
        $pemasoks = Pemasok::when($search, function ($query, $search) {
            return $query->where('nama_pemasok', 'like', '%' . $search . '%')
                ->orWhere('alamat', 'like', '%' . $search . '%')
                ->orWhere('no_telepon', 'like', '%' . $search . '%');
        })
        ->paginate(10); // Pagination 10 item per halaman

        // Mengirim data pemasok ke view
        return view('dashboard.pemasok.index', compact('pemasoks'));
    }

    /**
     * Menampilkan form untuk menambah pemasok baru.
     */
    public function create()
    {
        return view('dashboard.pemasok.create');
    }

    /**
     * Menyimpan data pemasok baru ke dalam database.
     */
    public function store(Request $request)
    {
        // Validasi input data yang diterima dari form
        $request->validate([
            'nama_pemasok' => 'required|string|max:255',
            'no_telepon' => 'required|string|max:15',
            'no_rekening' => 'required|string|max:30',
            'alamat' => 'required|string',
        ]);

        // Menyimpan data pemasok baru ke database
        Pemasok::create($request->all());

        // Redirect ke halaman daftar pemasok dengan pesan sukses
        return redirect()->route('dashboard.pemasok.index')->with('success', 'Pemasok berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail informasi pemasok berdasarkan ID.
     */
    public function show($id)
    {
        // Mengambil data pemasok berdasarkan ID yang diberikan
        $pemasok = Pemasok::findOrFail($id);

        // Mengirim data pemasok ke view
        return view('dashboard.pemasok.show', compact('pemasok'));
    }

    /**
     * Menampilkan form untuk mengedit informasi pemasok berdasarkan ID.
     */
    public function edit($id)
    {
        // Mengambil data pemasok berdasarkan ID yang diberikan
        $pemasok = Pemasok::findOrFail($id);

        // Mengirim data pemasok ke view untuk diedit
        return view('dashboard.pemasok.edit', compact('pemasok'));
    }

    /**
     * Memperbarui informasi pemasok yang sudah ada di database.
     */
    public function update(Request $request, $id)
    {
        // Mengambil data pemasok berdasarkan ID yang diberikan
        $pemasok = Pemasok::findOrFail($id);

        // Validasi input data yang diterima dari form
        $request->validate([
            'nama_pemasok' => 'required|string|max:255',
            'no_telepon' => 'required|string|max:15',
            'no_rekening' => 'required|string|max:30',
            'alamat' => 'required|string',
        ]);

        // Memperbarui data pemasok dengan data yang baru
        $pemasok->update($request->all());

        // Redirect ke halaman daftar pemasok dengan pesan sukses
        return redirect()->route('dashboard.pemasok.index')->with('success', 'Pemasok berhasil diperbarui.');
    }

    /**
     * Menghapus pemasok dari database berdasarkan ID.
     */
    public function destroy($id)
    {
        // Mengambil data pemasok berdasarkan ID yang diberikan
        $pemasok = Pemasok::findOrFail($id);

        // Menghapus data pemasok dari database
        $pemasok->delete();

        // Redirect ke halaman daftar pemasok dengan pesan sukses
        return redirect()->route('dashboard.pemasok.index')->with('success', 'Pemasok berhasil dihapus.');
    }

    /**
     * Menghasilkan file PDF yang berisi daftar semua pemasok.
     */
    public function cetakPdf()
    {
        // Mengambil semua data pemasok dari database
        $pemasoks = Pemasok::all();

        // Membuat file PDF dengan menggunakan data pemasok
        $pdf = Pdf::loadView('dashboard.pemasok.cetak_pdf', compact('pemasoks'));

        // Menampilkan file PDF sebagai stream (file langsung didownload atau ditampilkan di browser)
        return $pdf->stream('daftar_pemasok.pdf');
    }
}
