@extends('dashboard.layouts.main')

@section('content')

<!-- Bagian Header untuk Judul Halaman Edit Kategori -->
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Edit Data Kategori</h1>
</div>

<!-- Form Edit Data Kategori -->
<div class="row">
    <!-- Form berada di dalam div dengan ukuran 8 kolom untuk layar besar (lg), 10 kolom untuk layar medium (md), dan 12 kolom untuk layar kecil (sm) -->
    <div class="col-lg-8 col-md-10 col-sm-12 mx-auto">
        <!-- Form dengan action untuk memperbarui data kategori menggunakan metode PUT -->
        <form action="/kategori/{{ $kategori->id }}" method="post" enctype="multipart/form-data" class="p-4 border rounded shadow-sm bg-light">
            @method('PUT') <!-- Menentukan bahwa request ini adalah PUT untuk pembaruan data -->
            @csrf <!-- Token CSRF untuk keamanan form -->

            <!-- Input untuk Nama Kategori -->
            <div class="mb-3">
                <label for="nama_kategori" class="form-label"><i class="fas fa-tag"></i>Nama Kategori</label>
                <!-- Menampilkan nilai kategori yang ada saat ini, dengan fallback ke input lama jika ada error -->
                <input type="text" class="form-control @error('nama_kategori') is-invalid @enderror" name="nama_kategori" id="nama_kategori" value="{{ old('nama_kategori', $kategori->nama_kategori) }}" placeholder="Masukkan Nama Kategori">
                <!-- Menampilkan pesan error jika ada kesalahan inputan -->
                @error('nama_kategori')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Tombol Submit untuk Memperbarui Kategori -->
            <div class="mb-3">
                <button type="submit" class="btn btn-success">Perbarui Kategori</button>
            </div>
        </form>
    </div>
</div>

@endsection
