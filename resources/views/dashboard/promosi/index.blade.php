@extends('dashboard.layouts.main')

@section('title', 'Daftar Promosi') <!-- Menetapkan judul halaman -->

@section('navPromosi', 'active') <!-- Menandai menu promosi sebagai aktif -->

@section('content')

<!-- Judul Halaman -->
<h1 class="mb-4 text-center text-success">Daftar Promosi Fruit Station</h1>

<!-- Menampilkan pesan dari session jika ada -->
@if(session('pesan'))
<div class="alert alert-warning alert-dismissible fade show" role="alert">
   {{ session('pesan') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<!-- Form Pencarian dan Tombol Tambah Promosi Sejajar -->
<div class="d-flex justify-content-between mb-3">
    <div class="d-flex">
        <!-- Tombol untuk menambah promosi baru -->
        <a href="/promosi/create" class="btn btn-success custom-margin-right">Tambah Promosi</a>
        <!-- Tombol untuk mencetak laporan dalam format PDF -->
        <a href="{{ route('promosi.cetak-pdf') }}" target="_blank" class="btn btn-custom-green ms-1 d-flex align-items-center justify-content-center p-2" style="width: 40px; height: 40px;">
            <i class="bi bi-file-earmark-pdf fs-4"></i> <!-- Icon PDF dengan ukuran yang lebih besar -->
        </a>
    </div>

    <!-- Form Pencarian -->
    <form class="d-flex" method="GET" action="{{ route('promosi.index') }}" class="d-flex" style="max-width: 300px; width: 100%;">
        <input class="form-control me-2" type="search" name="search" value="{{ request()->get('search') }}" placeholder="Cari Promosi..." aria-label="Search">
        <button class="btn btn-primary ms-2" type="submit">Cari</button>
    </form>
</div>

<!-- Tabel Daftar Promosi -->
<table class="table table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Produk</th>
            <th>Deskripsi</th>
            <th>Jumlah Minimum</th>
            <th>Persentase Diskon</th>
            <th>Tanggal Mulai</th>
            <th>Tanggal Berakhir</th>
            <th class="text-center">Aksi</th> <!-- Kolom aksi untuk melihat, mengedit, dan menghapus data -->
        </tr>
    </thead>
    <tbody>
        @foreach ($promosis as $promosi)
        <tr>
            <td>{{ $loop->iteration }}</td> <!-- Nomor urut daftar promosi -->
            <td>{{ $promosi->produk_id ? $promosi->produk->nama_produk : 'Semua Produk' }}</td> <!-- Menampilkan nama produk atau 'Semua Produk' jika tidak ada produk terkait -->
            <td>{{ $promosi->description }}</td> <!-- Deskripsi promosi -->
            <td>{{ $promosi->quantity_required }}</td> <!-- Jumlah pembelian minimum -->
            <td>{{ $promosi->discount_percentage }}%</td> <!-- Persentase diskon -->
            <td>{{ \Carbon\Carbon::parse($promosi->start_date)->format('d-m-Y') }}</td> <!-- Format tanggal mulai -->
            <td>{{ \Carbon\Carbon::parse($promosi->end_date)->format('d-m-Y') }}</td> <!-- Format tanggal berakhir -->
            <td class="text-nowrap text-center" style="width: 120px;">
                <div class="btn-group" role="group" aria-label="Basic example">
                    <!-- Tombol untuk melihat detail promosi -->
                    <a href="/promosi/{{ $promosi->id }}" title="Lihat Detail" class="btn btn-success btn-sm" style="margin-right: 5px; padding: 0.3rem 0.5rem;">
                        <i class="bi bi-eye" style="font-size: 0.8rem;"></i>
                    </a>
                    <!-- Tombol untuk mengedit data promosi -->
                    <a href="/promosi/{{ $promosi->id }}/edit" title="Edit Data" class="btn btn-warning btn-sm" style="margin-right: 5px; padding: 0.3rem 0.5rem;">
                        <i class="bi bi-pencil" style="font-size: 0.8rem;"></i>
                    </a>
                    <!-- Form untuk menghapus data promosi -->
                    <form action="/promosi/{{ $promosi->id }}" method="post" class="d-inline">
                        @method('DELETE') <!-- Menunjukkan bahwa ini adalah permintaan DELETE -->
                        @csrf <!-- Token CSRF untuk keamanan -->
                        <!-- Tombol untuk menghapus data dengan konfirmasi -->
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

<!-- Pagination untuk navigasi halaman -->
<div class="d-flex justify-content-center mt-4">
    <nav aria-label="Page navigation">
        <ul class="pagination">
            <!-- Tombol Previous untuk navigasi ke halaman sebelumnya -->
            <li class="page-item {{ $promosis->onFirstPage() ? 'disabled' : '' }}">
                <a class="page-link" href="{{ $promosis->previousPageUrl() }}" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
            <!-- Menampilkan nomor halaman -->
            @for ($i = 1; $i <= $promosis->lastPage(); $i++)
                <li class="page-item {{ ($promosis->currentPage() == $i) ? 'active' : '' }}">
                    <a class="page-link" href="{{ $promosis->url($i) }}">{{ $i }}</a>
                </li>
            @endfor
            <!-- Tombol Next untuk navigasi ke halaman berikutnya -->
            <li class="page-item {{ $promosis->hasMorePages() ? '' : 'disabled' }}">
                <a class="page-link" href="{{ $promosis->nextPageUrl() }}" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        </ul>
    </nav>
</div>

@endsection
