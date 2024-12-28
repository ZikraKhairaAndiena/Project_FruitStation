@extends('dashboard.layouts.main')

@section('title', 'Daftar Pemasok')

@section('content')
<!-- Judul Halaman -->
<h1 class="mb-4 text-center text-success">Daftar Pemasok</h1>

<!-- Menampilkan notifikasi sukses jika ada -->
@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<!-- Menampilkan notifikasi error jika ada -->
@if(session('error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    {{ session('error') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<!-- Tombol untuk menambah pemasok dan cetak PDF -->
<div class="d-flex justify-content-between mb-3">
    <div class="d-flex">
        <!-- Tombol Tambah Pemasok -->
        <a href="{{ route('dashboard.pemasok.create') }}" class="btn btn-success custom-margin-right">Tambah Pemasok</a>
        <!-- Tombol Cetak Laporan PDF -->
        <a href="{{ route('pemasok.cetak-pdf') }}" target="_blank" class="btn btn-custom-green ms-1 d-flex align-items-center justify-content-center p-2" style="width: 40px; height: 40px;">
            <i class="bi bi-file-earmark-pdf fs-4"></i> <!-- Icon PDF dengan ukuran lebih besar dan rata tengah -->
        </a> <!-- Button untuk print report -->
    </div>
    <!-- Form Pencarian untuk mencari pemasok -->
    <form class="d-flex" method="GET" action="{{ route('dashboard.pemasok.index') }}" class="d-flex mb-3" style="max-width: 300px; width: 100%;">
        <input class="form-control me-2" type="search" name="search" value="{{ request()->get('search') }}" placeholder="Cari Pemasok..." aria-label="Search">
        <button class="btn btn-primary ms-2" type="submit">Cari</button>
    </form>
</div>

<!-- Tabel untuk menampilkan daftar pemasok -->
<table class="table table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>No Telepon</th>
            <th>No Rekening</th>
            <th>Alamat</th>
            <th class="text-center">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <!-- Iterasi setiap pemasok yang ada dalam variabel $pemasoks -->
        @foreach ($pemasoks as $pemasok)
        <tr>
            <td>{{ $loop->iteration }}</td> <!-- Menampilkan nomor urut pemasok -->
            <td>{{ $pemasok->nama_pemasok }}</td> <!-- Menampilkan nama pemasok -->
            <td>{{ $pemasok->no_telepon ?? '-' }}</td> <!-- Menampilkan nomor telepon pemasok, jika kosong menampilkan tanda '-' -->
            <td>{{ $pemasok->no_rekening ?? '-' }}</td> <!-- Menampilkan nomor rekening pemasok, jika kosong menampilkan tanda '-' -->
            <td>{{ $pemasok->alamat ?? '-' }}</td> <!-- Menampilkan alamat pemasok, jika kosong menampilkan tanda '-' -->
            <td class="text-nowrap text-center" style="width: 150px;">
                <!-- Tombol Aksi: Lihat, Edit, Hapus -->
                <div class="btn-group" role="group" aria-label="Aksi">
                    <!-- Tombol untuk melihat detail pemasok -->
                    <a href="{{ route('dashboard.pemasok.show', $pemasok->id) }}" title="Lihat Detail" class="btn btn-success btn-sm" style="margin-right: 5px; padding: 0.3rem 0.5rem;">
                        <i class="bi bi-eye" style="font-size: 0.8rem;"></i>
                    </a>
                    <!-- Tombol untuk mengedit data pemasok -->
                    <a href="{{ route('dashboard.pemasok.edit', $pemasok->id) }}" title="Edit Data" class="btn btn-warning btn-sm" style="margin-right: 5px; padding: 0.3rem 0.5rem;">
                        <i class="bi bi-pencil" style="font-size: 0.8rem;"></i>
                    </a>
                    <!-- Form untuk menghapus pemasok -->
                    <form action="{{ route('dashboard.pemasok.destroy', $pemasok->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus pemasok ini?')">
                        @csrf
                        @method('DELETE')
                        <!-- Tombol untuk menghapus data pemasok -->
                        <button title="Hapus Data" class="btn btn-danger btn-sm" style="padding: 0.3rem 0.5rem;">
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
    {{ $pemasoks->links('pagination::bootstrap-4') }}
</div>

@endsection
