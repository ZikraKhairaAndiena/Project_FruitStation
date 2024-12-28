@extends('dashboard.layouts.main')

@section('content')

<!-- Bagian judul halaman -->
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Detail Data Produk</h1>
</div>

<!-- Container untuk menampilkan detail produk -->
<div class="row">
    <div class="col-lg-8 col-md-10 col-sm-12 mx-auto">
        <div class="card shadow-sm border rounded">
            <!-- Header kartu yang menampilkan judul informasi produk -->
            <div class="card-header bg-light">
                <h5 class="mb-0">Informasi Produk</h5>
            </div>
            <div class="card-body bg-light">
                <!-- Menampilkan informasi produk dalam bentuk label dan data yang tidak bisa diedit (plaintext) -->

                <!-- Produk ID -->
                <div class="mb-3">
                    <label for="produk_id" class="form-label"><i class="fas fa-tag"></i> Produk ID</label>
                    <p class="form-control-plaintext border p-2 rounded bg-white">{{ $produk->produk_id }}</p>
                </div>

                <!-- Kategori Produk -->
                <div class="mb-3">
                    <label for="kategori_id" class="form-label"><i class="fas fa-list-alt"></i> Kategori</label>
                    <p class="form-control-plaintext border p-2 rounded bg-white">{{ $produk->kategori->nama_kategori }}</p>
                </div>

                <!-- Nama Produk -->
                <div class="mb-3">
                    <label for="nama_produk" class="form-label"><i class="fas fa-apple-alt"></i> Nama Produk</label>
                    <p class="form-control-plaintext border p-2 rounded bg-white">{{ $produk->nama_produk }}</p>
                </div>

                <!-- Stok Produk -->
                <div class="mb-3">
                    <label for="stok_produk" class="form-label"><i class="fas fa-box"></i> Stok Produk</label>
                    <p class="form-control-plaintext border p-2 rounded bg-white">{{ $produk->stok_produk }}</p>
                </div>

                <!-- Satuan Produk -->
                <div class="mb-3">
                    <label for="satuan" class="form-label"><i class="fas fa-weight-hanging"></i> Satuan</label>
                    <p class="form-control-plaintext border p-2 rounded bg-white">{{ $produk->satuan }}</p>
                </div>

                <!-- Harga Produk -->
                <div class="mb-3">
                    <label for="satuan" class="form-label"><i class="fas fa-weight-hanging"></i> Harga Produk</label>
                    <p class="form-control-plaintext border p-2 rounded bg-white">Rp {{ number_format($produk->harga_produk, 0, ',', '.') }}</p>
                </div>

                <!-- Deskripsi Produk -->
                <div class="mb-3">
                    <label for="deskripsi_produk" class="form-label"><i class="fas fa-info-circle"></i> Deskripsi Produk</label>
                    <p class="form-control-plaintext border p-2 rounded bg-white">{{ $produk->deskripsi_produk }}</p>
                </div>

                <!-- Gambar Produk -->
                <div class="mb-3">
                    <label for="gambar_produk" class="form-label"><i class="fas fa-image"></i> Gambar Produk</label>
                    <div class="border p-2 rounded bg-white text-center">
                        <img src="{{ asset('img/' . $produk->gambar_produk) }}" alt="Gambar Produk" class="img-fluid rounded" style="max-height: 300px; object-fit: cover;">
                    </div>
                </div>

            </div>
            <!-- Footer kartu dengan tombol untuk kembali ke daftar produk -->
            <div class="card-footer text-end">
                <a href="/produk/" class="btn btn-success btn-sm">Kembali</a>
            </div>
        </div>
    </div>
</div>

@endsection
