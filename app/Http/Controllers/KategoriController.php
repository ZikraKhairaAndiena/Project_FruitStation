<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Ambil nilai pencarian dari query string
        $search = $request->get('search'); // Mendapatkan nilai pencarian dari parameter URL 'search'

        // Jika ada pencarian, filter kategori berdasarkan nama_kategori
        $kategoris = Kategori::when($search, function ($query, $search) {
            // Filter berdasarkan nama kategori yang mengandung kata kunci pencarian
            return $query->where('nama_kategori', 'like', "%{$search}%");
        })->latest()->paginate(10);  // Urutkan kategori berdasarkan yang terbaru dan paginate 10 data per halaman

        // Mengirim data ke view
        return view('dashboard.kategori.index', ['kategoris' => $kategoris]); // Mengirim variabel kategoris ke view
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategoris = Kategori::all(); // Mengambil semua kategori (bisa digunakan untuk dropdown atau referensi)
        return view('dashboard.kategori.create', ['kategoris'=>$kategoris]); // Menampilkan halaman form untuk menambah kategori baru
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi inputan form
        $validated = $request->validate([
            'nama_kategori' => 'required|min:3', // Pastikan nama kategori minimal 3 karakter
        ]);

        // Menyimpan kategori baru ke dalam database
        Kategori::create($validated); // Menggunakan metode create untuk menyimpan data kategori
        return redirect('/kategori'); // Setelah menyimpan, redirect kembali ke halaman kategori
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Mengambil kategori berdasarkan ID yang diberikan
        $kategori = Kategori::findOrFail($id); // Jika kategori tidak ditemukan, akan throw exception
        return view('dashboard.kategori.show', compact('kategori')); // Mengirim data kategori ke view
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Mengambil kategori berdasarkan ID untuk diedit
        $kategori = Kategori::findOrFail($id); // Ambil satu instance kategori berdasarkan id
        return view('dashboard.kategori.edit', compact('kategori')); // Mengirim data kategori ke view edit
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validasi inputan form untuk update
        $validated = $request->validate([
            'nama_kategori' => 'required|min:3', // Pastikan nama kategori minimal 3 karakter
        ]);

        // Melakukan update kategori berdasarkan ID
        Kategori::where('id', $id)->update($validated); // Update data kategori yang sesuai dengan ID
        return redirect('kategori')->with('pesan', 'Data berhasil diubah'); // Redirect ke halaman kategori dengan pesan sukses
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Menghapus kategori berdasarkan ID
        Kategori::destroy($id); // Menghapus kategori yang sesuai dengan ID
        return redirect('kategori')->with('pesan','Data berhasil dihapus'); // Redirect ke halaman kategori dengan pesan sukses
    }
}
