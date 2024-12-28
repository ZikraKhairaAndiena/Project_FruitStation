@extends('dashboard.layouts.main')

@section('title', 'Daftar Kategori')

@section('navMhs', 'active')

@section('content')

<!-- Judul Halaman Daftar Kategori -->
<h1 class="mb-4 text-center text-success">Daftar Kategori Produk Fruit Station</h1>

<!-- Menampilkan pesan jika ada session 'pesan' -->
@if(session('pesan'))
<div class="alert alert-warning alert-dismissible fade show" role="alert">
   {{ session('pesan') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<!-- Baris untuk Tombol Tambah Kategori dan Form Pencarian -->
<div class="d-flex justify-content-between mb-3">
    <!-- Tombol untuk menambahkan kategori baru -->
    <a href="/kategori/create" class="btn btn-success">Tambah Kategori</a>

    <!-- Form pencarian kategori berdasarkan input yang dimasukkan pengguna -->
    <form action="{{ url('/kategori') }}" method="GET" class="d-flex">
        <input type="text" name="search" class="form-control" placeholder="Cari kategori..." value="{{ request('search') }}">
        <button type="submit" class="btn btn-primary ms-2">Cari</button>
    </form>
</div>

<!-- Tabel Daftar Kategori -->
<table class="table table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Kategori</th>
            <th class="text-center">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <!-- Looping untuk menampilkan semua kategori -->
        @foreach ($kategoris as $kategori)
        <tr>
            <!-- Menampilkan nomor urut kategori -->
            <td>{{ $loop->iteration }}</td>
            <!-- Menampilkan nama kategori -->
            <td>{{ $kategori->nama_kategori }}</td>
            <td class="text-nowrap text-center" style="width: 120px;">
                <!-- Grup tombol aksi (Lihat Detail, Edit, Hapus) -->
                <div class="btn-group" role="group" aria-label="Basic example">
                    <!-- Tombol untuk melihat detail kategori -->
                    <a href="/kategori/{{ $kategori->id }}" title="Lihat Detail" class="btn btn-success btn-sm" style="margin-right: 5px; padding: 0.3rem 0.5rem;">
                        <i class="bi bi-eye" style="font-size: 0.8rem;"></i>
                    </a>
                    <!-- Tombol untuk mengedit kategori -->
                    <a href="/kategori/{{ $kategori->id }}/edit" title="Edit Data" class="btn btn-warning btn-sm" style="margin-right: 5px; padding: 0.3rem 0.5rem;">
                        <i class="bi bi-pencil" style="font-size: 0.8rem;"></i>
                    </a>
                    <!-- Form untuk menghapus kategori -->
                    <form action="/kategori/{{ $kategori->id }}" method="post" class="d-inline">
                        @method('DELETE') <!-- Menentukan bahwa request ini adalah DELETE untuk menghapus data -->
                        @csrf <!-- Token CSRF untuk keamanan form -->
                        <button title="Hapus Data" class="btn btn-danger btn-sm" onclick="return confirm('Yakin akan menghapus data ini?')" style="padding: 0.3rem 0.5rem;">
                            <i class="bi bi-trash" style="font-size: 0.8rem;"></i>
                        </button>
                    </form>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<!-- Pagination (Navigasi Halaman) -->
<div class="d-flex justify-content-center mt-4">
    <nav aria-label="Page navigation">
        <ul class="pagination">
            <!-- Tombol untuk navigasi ke halaman sebelumnya -->
            <li class="page-item {{ $kategoris->onFirstPage() ? 'disabled' : '' }}">
                <a class="page-link" href="{{ $kategoris->previousPageUrl() }}" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
            <!-- Menampilkan nomor halaman sesuai dengan jumlah halaman yang ada -->
            @for ($i = 1; $i <= $kategoris->lastPage(); $i++)
                <li class="page-item {{ ($kategoris->currentPage() == $i) ? 'active' : '' }}">
                    <a class="page-link" href="{{ $kategoris->url($i) }}">{{ $i }}</a>
                </li>
            @endfor
            <!-- Tombol untuk navigasi ke halaman selanjutnya -->
            <li class="page-item {{ $kategoris->hasMorePages() ? '' : 'disabled' }}">
                <a class="page-link" href="{{ $kategoris->nextPageUrl() }}" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        </ul>
    </nav>
</div>

@endsection
