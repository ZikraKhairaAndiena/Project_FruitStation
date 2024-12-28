@extends('dashboard.layouts.main')

@section('title', 'Daftar Pengguna')

@section('content')
<h1 class="mb-4 text-center text-success">Daftar Pengguna</h1>

<!-- Menampilkan pesan sukses jika ada session dengan key 'success' -->
@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<!-- Menampilkan pesan error jika ada session dengan key 'error' -->
@if(session('error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    {{ session('error') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<div class="d-flex justify-content-between mb-3">
    <div class="d-flex">
        <!-- Tombol untuk menambah pengguna -->
        <a href="{{ route('dashboard.pengguna.create') }}" class="btn btn-success custom-margin-right">Tambah Pengguna</a>
        <!-- Tombol untuk mencetak laporan dalam format PDF -->
        <a href="{{ route('pengguna.cetak-pdf') }}" target="_blank" class="btn btn-custom-green ms-1 d-flex align-items-center justify-content-center p-2" style="width: 40px; height: 40px;">
            <i class="bi bi-file-earmark-pdf fs-4"></i> <!-- Icon PDF dengan alignment dan ukuran lebih besar -->
        </a> <!-- Tombol untuk laporan PDF -->
    </div>

    <!-- Form pencarian pengguna -->
    <form class="d-flex" method="GET" action="{{ route('dashboard.pengguna.index') }}" style="max-width: 300px; width: 100%;">
        <input class="form-control me-2" type="search" name="search" value="{{ request()->get('search') }}" placeholder="Cari Pengguna..." aria-label="Search">
        <button class="btn btn-primary ms-2" type="submit">Cari</button> <!-- Tombol pencarian -->
    </form>
</div>

<!-- Tabel daftar pengguna -->
<table class="table table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Role</th>
            <th>No Telepon</th>
            <th>Alamat</th>
            <th class="text-center">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
        <tr>
            <td>{{ $loop->iteration }}</td> <!-- Menampilkan nomor urut pengguna -->
            <td>{{ $user->name }}</td> <!-- Nama pengguna -->
            <td>{{ $user->email }}</td> <!-- Email pengguna -->
            <td>{{ ucfirst($user->role) }}</td> <!-- Menampilkan role dengan format kapital pertama -->
            <td>{{ $user->no_telepon ?? '-' }}</td> <!-- Menampilkan nomor telepon atau '-' jika tidak ada -->
            <td>{{ $user->alamat ?? '-' }}</td> <!-- Menampilkan alamat atau '-' jika tidak ada -->
            <td class="text-nowrap text-center" style="width: 150px;">
                <!-- Grup tombol aksi (lihat detail, edit, hapus) -->
                <div class="btn-group" role="group" aria-label="Basic example">
                    <!-- Tombol untuk melihat detail pengguna -->
                    <a href="{{ route('dashboard.pengguna.show', $user->id) }}" title="Lihat Detail" class="btn btn-success btn-sm" style="margin-right: 5px; padding: 0.3rem 0.5rem;">
                        <i class="bi bi-eye" style="font-size: 0.8rem;"></i>
                    </a>
                    <!-- Tombol untuk mengedit data pengguna -->
                    <a href="{{ route('dashboard.pengguna.edit', $user->id) }}" title="Edit Data" class="btn btn-warning btn-sm" style="margin-right: 5px; padding: 0.3rem 0.5rem;">
                        <i class="bi bi-pencil" style="font-size: 0.8rem;"></i>
                    </a>
                    <!-- Tombol untuk menghapus data pengguna (dengan pengecekan role super_admin) -->
                    @if($user->role !== 'super_admin')
                    <form action="{{ route('dashboard.pengguna.destroy', $user->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus pengguna ini?')">
                        @csrf
                        @method('DELETE')
                        <button title="Hapus Data" class="btn btn-danger btn-sm" style="padding: 0.3rem 0.5rem;">
                            <i class="bi bi-trash" style="font-size: 0.8rem;"></i>
                        </button>
                    </form>
                    @else
                    <!-- Jika role pengguna adalah super_admin, tampilkan tombol tidak bisa dihapus -->
                    <button title="Tidak Bisa Dihapus" class="btn btn-secondary btn-sm" style="padding: 0.3rem 0.5rem;" disabled>
                        <i class="bi bi-lock" style="font-size: 0.8rem;"></i>
                    </button>
                    @endif
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<!-- Menampilkan pagination (navigasi halaman) -->
<div class="d-flex justify-content-center mt-4">
    {{ $users->links('pagination::bootstrap-4') }}
</div>

@endsection
