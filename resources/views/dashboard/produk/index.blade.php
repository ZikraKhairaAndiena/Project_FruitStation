@extends('dashboard.layouts.main')

@section('title', 'Daftar Produk')

@section('navMhs', 'active') <!-- Menandakan menu "Daftar Produk" aktif di sidebar -->

@section('content')

<!-- Judul halaman -->
<h1 class="mb-4 text-center text-success">Daftar Produk Fruit Station</h1>

<!-- Menampilkan pesan jika ada -->
@if(session('pesan'))
<div class="alert alert-warning alert-dismissible fade show" role="alert">
   {{ session('pesan') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<!-- Bagian tombol untuk menambah produk dan mengunduh laporan PDF -->
<div class="d-flex justify-content-between mb-3">
    <div class="d-flex">
        <a href="/produk/create" class="btn btn-success custom-margin-right">Tambah Produk</a> <!-- Tombol untuk menambah produk -->
        <a href="{{ route('produk.cetak-pdf') }}" target="_blank" class="btn btn-custom-green ms-1 d-flex align-items-center justify-content-center p-2" style="width: 40px; height: 40px;">
            <i class="bi bi-file-earmark-pdf fs-4"></i> <!-- Ikon untuk cetak laporan dalam format PDF -->
        </a> <!-- Tombol untuk cetak laporan -->
    </div>
    <!-- Form pencarian produk -->
    <form class="d-flex" method="GET" action="{{ url('/produk') }}">
        <input class="form-control me-2" type="search" name="search" value="{{ request()->get('search') }}" placeholder="Cari Produk..." aria-label="Search">
        <button class="btn btn-primary ms-2" type="submit">Cari</button>
    </form>
</div>

<!-- Tabel untuk menampilkan daftar produk -->
<table class="table table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th>No</th>
            <th>Produk ID</th>
            <th>Kategori</th>
            <th>Nama Produk</th>
            <th>Stok Produk</th>
            <th>Satuan</th>
            <th>Harga Produk</th>
            <th>Deskripsi Produk</th>
            <th>Gambar Produk</th>
            <th class="text-center">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <!-- Loop untuk menampilkan setiap produk -->
        @foreach ($produks as $produk)
        <tr>
            <td>{{ $loop->iteration }}</td> <!-- Menampilkan nomor urut produk -->
            <td>{{ $produk->produk_id }}</td> <!-- Menampilkan ID produk -->
            <td>{{ $produk->kategori->nama_kategori }}</td> <!-- Menampilkan kategori produk -->
            <td>{{ $produk->nama_produk }}</td> <!-- Menampilkan nama produk -->
            <td>{{ $produk->stok_produk }}</td> <!-- Menampilkan stok produk -->
            <td>{{ $produk->satuan }}</td> <!-- Menampilkan satuan produk -->
            <td>Rp {{ number_format($produk->harga_produk, 0, ',', '.') }}</td> <!-- Menampilkan harga produk dengan format angka -->
            <td>{{ $produk->deskripsi_produk }}</td> <!-- Menampilkan deskripsi produk -->
            <td>
                <!-- Menampilkan gambar produk jika ada -->
                @if($produk->gambar_produk)
                    <img src="{{ asset('img/' . $produk->gambar_produk) }}" alt="{{ $produk->nama_produk }}" style="width:100px;">
                @else
                    <p class="text-muted">No Image Available</p> <!-- Pesan jika gambar tidak ada -->
                @endif
            </td>
            <!-- Bagian aksi (lihat detail, edit, hapus) -->
            <td class="text-nowrap text-center" style="width: 120px;">
                <div class="btn-group" role="group" aria-label="Basic example">
                    <a href="/produk/{{ $produk->id }}" title="Lihat Detail" class="btn btn-success btn-sm" style="margin-right: 5px; padding: 0.3rem 0.5rem;">
                        <i class="bi bi-eye" style="font-size: 0.8rem;"></i> <!-- Tombol untuk melihat detail produk -->
                    </a>
                    <a href="/produk/{{ $produk->id }}/edit" title="Edit Data" class="btn btn-warning btn-sm" style="margin-right: 5px; padding: 0.3rem 0.5rem;">
                        <i class="bi bi-pencil" style="font-size: 0.8rem;"></i> <!-- Tombol untuk mengedit produk -->
                    </a>
                    <form action="/produk/{{ $produk->id }}" method="post" class="d-inline">
                        @method('DELETE') <!-- Metode delete untuk menghapus produk -->
                        @csrf
                        <button title="Hapus Data" class="btn btn-danger btn-sm" onclick="return confirm('Yakin akan menghapus data ini?')" style="padding: 0.3rem 0.5rem;">
                            <i class="bi bi-trash" style="font-size: 0.8rem;"></i> <!-- Tombol untuk menghapus produk -->
                        </button>
                    </form>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<!-- Bagian Pagination untuk navigasi halaman -->
<div class="d-flex justify-content-center mt-4">
    <nav aria-label="Page navigation">
        <ul class="pagination">
            <li class="page-item {{ $produks->onFirstPage() ? 'disabled' : '' }}">
                <a class="page-link" href="{{ $produks->previousPageUrl() }}" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span> <!-- Tombol untuk halaman sebelumnya -->
                </a>
            </li>
            <!-- Loop untuk membuat tombol halaman -->
            @for ($i = 1; $i <= $produks->lastPage(); $i++)
                <li class="page-item {{ ($produks->currentPage() == $i) ? 'active' : '' }}">
                    <a class="page-link" href="{{ $produks->url($i) }}">{{ $i }}</a> <!-- Nomor halaman -->
                </li>
            @endfor
            <li class="page-item {{ $produks->hasMorePages() ? '' : 'disabled' }}">
                <a class="page-link" href="{{ $produks->nextPageUrl() }}" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span> <!-- Tombol untuk halaman berikutnya -->
                </a>
            </li>
        </ul>
    </nav>
</div>

@endsection
