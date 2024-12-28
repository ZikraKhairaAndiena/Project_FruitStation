<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Produk;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Ambil nilai pencarian dari parameter query string
        $search = $request->get('search');

        // Jika ada pencarian, filter produk berdasarkan nama_produk atau kategori
        $produks = Produk::when($search, function ($query, $search) {
            return $query->where('nama_produk', 'like', "%{$search}%")
                         ->orWhereHas('kategori', function ($q) use ($search) {
                             $q->where('nama_kategori', 'like', "%{$search}%");
                         });
        })->latest()->paginate(10);

        // Menampilkan data produk yang sudah difilter sesuai pencarian
        return view('dashboard.produk.index', ['produks' => $produks]);
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Mengambil semua kategori
        $kategoris = Kategori::all();
        return view('dashboard.produk.create', ['kategoris' => $kategoris]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'produk_id' => 'required|unique:produks',
            'kategori_id' => 'required|exists:kategoris,id',
            'nama_produk' => 'required|string|max:255',
            'stok_produk' => 'required|integer|min:0',
            'satuan' => 'required|string|max:50',
            'harga_produk' => 'required|numeric|min:0',
            'deskripsi_produk' => 'nullable|string',
            'gambar_produk' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Maks 2MB
        ]);

        // Handling file upload jika ada gambar produk
        if ($request->hasFile('gambar_produk')) {
            $file = $request->file('gambar_produk');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('img'), $filename);
            $validated['gambar_produk'] = $filename;
        }

        // Simpan produk ke database
        Produk::create($validated);
        return redirect('/produk')->with('pesan', 'Produk berhasil disimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Menampilkan detail produk berdasarkan ID
        $produk = Produk::findOrFail($id);
        return view('dashboard.produk.show', compact('produk'));
    }

    public function showProductForCustomer($id)
{
    // Ambil produk berdasarkan ID
    $produk = Produk::findOrFail($id);

    // Ambil semua kategori untuk ditampilkan sebagai filter (jika diperlukan di tampilan)
    $kategoris = Kategori::all();

    // Tampilkan tampilan dengan detail produk
    return view('customer.show', compact('produk', 'kategoris'));
}

    /**
     * Display products for customer.
     */
    public function showProductsForCustomer(Request $request)
    {
        // Ambil kategori yang dipilih dari query string, jika tidak ada maka default ke 'all'
        $kategoriId = $request->get('kategori_id', 'all');

        // Jika kategori 'all' maka ambil semua produk, jika tidak filter berdasarkan kategori
        if ($kategoriId == 'all') {
            $produks = Produk::all();
        } else {
            $produks = Produk::where('kategori_id', $kategoriId)->get();
        }

        // Ambil semua kategori untuk ditampilkan sebagai filter
        $kategoris = Kategori::all();

        return view('customer.home', ['produks' => $produks, 'kategoris' => $kategoris, 'kategoriId' => $kategoriId]);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Mengambil produk yang akan diedit dan kategori
        $kategoris = Kategori::all();
        $produk = Produk::findOrFail($id);
        return view('dashboard.produk.edit', compact('kategoris', 'produk'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validasi input termasuk unik untuk produk_id kecuali produk yang sedang di-update
        $validated = $request->validate([
            'produk_id' => 'required|unique:produks,produk_id,' . $id,
            'kategori_id' => 'required|exists:kategoris,id',
            'nama_produk' => 'required|string|max:255',
            'stok_produk' => 'required|integer|min:0',
            'satuan' => 'required|string|max:50',
            'harga_produk' => 'required|numeric|min:0',
            'deskripsi_produk' => 'nullable|string',
            'gambar_produk' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Maks 2MB
        ]);

        // Jika ada file baru yang diupload
        if ($request->hasFile('gambar_produk')) {
            $file = $request->file('gambar_produk');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('img'), $filename);

            // Menambahkan nama file baru ke data validasi
            $validated['gambar_produk'] = $filename;

            // Hapus gambar lama jika ada (opsional)
            $produkLama = Produk::find($id);
            if ($produkLama->gambar_produk) {
                $oldFilePath = public_path('img/' . $produkLama->gambar_produk);
                if (file_exists($oldFilePath)) {
                    unlink($oldFilePath);
                }
            }
        }

        // Update produk
        Produk::where('id', $id)->update($validated);
        return redirect('/produk')->with('pesan', 'Produk berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Mengambil produk berdasarkan ID
        $produk = Produk::findOrFail($id);

        // Hapus gambar terkait jika ada
        if ($produk->gambar_produk) {
            $filePath = public_path('img/' . $produk->gambar_produk);
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }

        // Hapus produk dari database
        Produk::destroy($id);
        return redirect('/produk')->with('pesan', 'Produk berhasil dihapus');
    }

    // Fungsi untuk menangani pencarian produk di admin

    public function search(Request $request)
    {
        // Ambil query pencarian dan peran pengguna (admin/customer)
        $query = $request->input('query');
        $role = $request->input('role'); // 'admin' or 'customer'

        // Cari produk berdasarkan nama
        $produk = Produk::where('nama_produk', 'LIKE', '%' . $query . '%')->paginate(10);

        // Tampilkan hasil pencarian sesuai peran pengguna
        if ($role === 'admin') {
            return view('dashboard.produk.search', compact('produk'));
        } else {
            return view('customer.search-results', compact('produk'));
        }
    }

    public function addToCart(Request $request, $id)
    {
        // Ambil produk berdasarkan ID
        $product = Produk::findOrFail($id);
        $cart = session()->get('cart', []);

        // Jika produk sudah ada di keranjang, tambahkan jumlahnya
        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            // Tambahkan produk baru ke keranjang
            $cart[$id] = [
                'name' => $product->nama_produk,
                'quantity' => 1,
                'price' => $product->harga_produk,
                'image' => $product->gambar_produk,
            ];
        }

        // Simpan kembali keranjang ke sesi
        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke keranjang!');
    }

    public function showShop(Request $request)
    {
        // Ambil kategori yang dipilih untuk filter produk
        $kategoriId = $request->input('kategori_id');

        // Fetch products based on selected category
        if ($kategoriId) {
            $produks = Produk::where('kategori_id', $kategoriId)->get();
        } else {
            $produks = Produk::all(); // Fetch all products if no category is selected
        }

        // Ambil kategori untuk dropdown filter
        $kategoris = Kategori::all(); // Fetch all categories for the dropdown
        return view('customer.shop', compact('produks', 'kategoris'));
    }

    // Method untuk mencetak laporan produk ke PDF
    public function cetakPDF()
    {
        // Mengambil data produk
        $produks = Produk::all(); // Sesuaikan dengan query sesuai kebutuhan Anda

        // Memuat view dan mengirimkan data produk
        $pdf = Pdf::loadView('dashboard.produk.cetak_pdf', compact('produks'));

        // Men-download file PDF
        return $pdf->stream('laporan-produk.pdf');
    }
}
