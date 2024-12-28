@extends('dashboard.layouts.main')

@section('content')

<!-- Header Section dengan Judul -->
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Detail Data Pengguna</h1> <!-- Judul Halaman -->
</div>

<!-- Kontainer Konten Utama -->
<div class="row">
    <div class="col-lg-8 col-md-10 col-sm-12 mx-auto">
        <!-- Card untuk Menampilkan Informasi Pengguna -->
        <div class="card shadow-sm border rounded">
            <!-- Header Card -->
            <div class="card-header bg-light">
                <h5 class="mb-0">Informasi Pengguna</h5> <!-- Subjudul untuk Informasi Pengguna -->
            </div>
            <!-- Body Card yang berisi Detail Pengguna -->
            <div class="card-body bg-light">
                <!-- Menampilkan Nama Pengguna -->
                <div class="mb-3">
                    <label for="name" class="form-label"><i class="fas fa-user"></i> Nama Pengguna</label>
                    <p class="form-control-plaintext border p-2 rounded bg-white">{{ $user->name }}</p> <!-- Menampilkan nama pengguna -->
                </div>

                <!-- Menampilkan Email Pengguna -->
                <div class="mb-3">
                    <label for="email" class="form-label"><i class="fas fa-envelope"></i> Email</label>
                    <p class="form-control-plaintext border p-2 rounded bg-white">{{ $user->email }}</p> <!-- Menampilkan email pengguna -->
                </div>

                <!-- Menampilkan Peran Pengguna -->
                <div class="mb-3">
                    <label for="role" class="form-label"><i class="fas fa-user-shield"></i> Peran</label>
                    <p class="form-control-plaintext border p-2 rounded bg-white">{{ $user->role }}</p> <!-- Menampilkan peran pengguna -->
                </div>

                <!-- Menampilkan Tanggal Pembuatan Akun -->
                <div class="mb-3">
                    <label for="created_at" class="form-label"><i class="fas fa-calendar-alt"></i> Tanggal Dibuat</label>
                    <p class="form-control-plaintext border p-2 rounded bg-white">{{ $user->created_at->format('d-m-Y') }}</p> <!-- Menampilkan tanggal pembuatan akun -->
                </div>

                <!-- Menampilkan Tanggal Pembaruan Akun -->
                <div class="mb-3">
                    <label for="updated_at" class="form-label"><i class="fas fa-calendar-edit"></i> Tanggal Diperbarui</label>
                    <p class="form-control-plaintext border p-2 rounded bg-white">{{ $user->updated_at->format('d-m-Y') }}</p> <!-- Menampilkan tanggal pembaruan akun -->
                </div>

            </div>
            <!-- Footer Card dengan Tombol Kembali -->
            <div class="card-footer text-end">
                <a href="/dashboard/pengguna" class="btn btn-success btn-sm">Kembali</a> <!-- Tombol Kembali ke Daftar Pengguna -->
            </div>
        </div>
    </div>
</div>

@endsection
