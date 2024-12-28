@extends('dashboard.layouts.main')

@section('content')

<!-- Judul Halaman Detail Data Kategori -->
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Detail Data Kategori</h1>
</div>

<div class="row">
    <div class="col-lg-8 col-md-10 col-sm-12 mx-auto">
        <!-- Card untuk Menampilkan Detail Kategori -->
        <div class="card shadow-sm border rounded">
            <div class="card-header bg-light">
                <!-- Judul Header Card -->
                <h5 class="mb-0">Informasi Kategori</h5>
            </div>
            <div class="card-body bg-light">
                <!-- Menampilkan Detail Nama Kategori -->
                <div class="mb-3">
                    <label for="nama_kategori" class="form-label"><i class="fas fa-tag"></i> Nama Kategori</label>
                    <!-- Menampilkan Nama Kategori dalam bentuk teks biasa (readonly) -->
                    <p class="form-control-plaintext border p-2 rounded bg-white">{{ $kategori->nama_kategori }}</p>
                </div>
            </div>
            <div class="card-footer text-end">
                <!-- Tombol untuk kembali ke halaman daftar kategori -->
                <a href="/kategori/" class="btn btn-success btn-sm">Kembali</a>
            </div>
        </div>
    </div>
</div>

@endsection
