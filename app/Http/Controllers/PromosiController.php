<?php

namespace App\Http\Controllers;

use App\Models\Promosi;
use App\Models\Produk;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PromosiController extends Controller
{
    // Menampilkan daftar promosi
    public function index(Request $request)
    {
        // Mendapatkan nilai pencarian dari request
        $search = $request->get('search');

            // Mengambil data promosi dengan relasi produk dan menambahkan pencarian
            $promosis = Promosi::with('produk')
            ->when($search, function ($query, $search) {
                // Menambahkan filter pencarian jika ada
                return $query->whereHas('produk', function ($query) use ($search) {
                    $query->where('nama_produk', 'like', '%' . $search . '%'); // Mencari berdasarkan nama produk
                })
                ->orWhere('description', 'like', '%' . $search . '%'); // Mencari berdasarkan deskripsi
            })
            ->paginate(10); // Menampilkan 10 item per halaman


        // Mengirimkan data ke view
        return view('dashboard.promosi.index', compact('promosis'));
    }

    // Menampilkan detail promosi tertentu
    public function show(Promosi $promosi)
    {
        return view('dashboard.promosi.show', compact('promosi'));
    }

    // Menampilkan form tambah promosi
    public function create()
    {
        $produks = Produk::all(); // Mendapatkan semua produk
        return view('dashboard.promosi.create', compact('produks'));
    }

    // Menyimpan data promosi baru
    public function store(Request $request)
    {
        // Validasi data
        $validatedData = $request->validate([
            'produk_id' => 'required|exists:produks,id',
            'description' => 'nullable|string',
            'quantity_required' => 'required|integer',
            'discount_percentage' => 'required|numeric|min:0|max:100',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        // Simpan data ke database
        Promosi::create($validatedData);

        // Redirect dengan pesan sukses
        return redirect('/promosi')->with('pesan', 'Promosi berhasil ditambahkan!');
    }

    // Menampilkan form edit promosi
    public function edit($id)
    {
        $promosi = Promosi::findOrFail($id);
        $produks = Produk::all(); // Mendapatkan semua produk
        return view('dashboard.promosi.edit', compact('promosi', 'produks'));
    }

    // Memperbarui data promosi
    public function update(Request $request, $id)
    {
        // Validasi data
        $validatedData = $request->validate([
            'produk_id' => 'required|exists:produks,id',
            'description' => 'nullable|string',
            'quantity_required' => 'required|integer',
            'discount_percentage' => 'required|numeric|min:0|max:100',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        // Update data di database
        $promosi = Promosi::findOrFail($id);
        $promosi->update($validatedData);

        // Redirect dengan pesan sukses
        return redirect('/promosi')->with('pesan', 'Promosi berhasil diperbarui!');
    }

    // Menghapus data promosi
    public function destroy($id)
    {
        $promosi = Promosi::findOrFail($id);
        $promosi->delete();

        return redirect('/promosi')->with('pesan', 'Promosi berhasil dihapus!');
    }

    // Mencetak laporan promosi dalam format PDF
    public function cetakPdf()
    {
        $promosis = Promosi::with('produk')->get();
        $pdf = Pdf::loadView('dashboard.promosi.cetak_pdf', compact('promosis'))->setPaper('a4', 'landscape');
        return $pdf->stream('laporan-promosi.pdf');
    }
}
