@extends('dashboard.layouts.main')

@section('title', 'Tambah Pemasok')

@section('content')

<!-- Bagian header halaman dengan judul 'Tambah Data Pemasok' -->
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Tambah Data Pemasok</h1>
</div>

<!-- Formulir untuk menambah pemasok -->
<div class="row">
    <div class="col-lg-8 col-md-10 col-sm-12 mx-auto">
        <!-- Formulir ini akan mengirim data ke route dashboard.pemasok.store menggunakan metode POST -->
        <form action="{{ route('dashboard.pemasok.store') }}" method="POST" class="p-4 border rounded shadow-sm bg-light">
            @csrf <!-- Token CSRF untuk keamanan -->

            <!-- Input untuk Nama Pemasok -->
            <div class="mb-3">
                <label for="nama_pemasok" class="form-label"><i class="fas fa-user"></i> Nama Pemasok</label>
                <!-- Field untuk memasukkan nama pemasok -->
                <input type="text" name="nama_pemasok" class="form-control @error('nama_pemasok') is-invalid @enderror" placeholder="Masukkan Nama Pemasok" required>
                <!-- Menampilkan pesan error jika ada kesalahan pada input nama pemasok -->
                @error('nama_pemasok')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Input untuk Nomor Telepon Pemasok -->
            <div class="mb-3">
                <label for="no_telepon" class="form-label"><i class="fas fa-phone"></i> No Telepon</label>
                <!-- Field untuk memasukkan nomor telepon pemasok -->
                <input type="text" name="no_telepon" class="form-control @error('no_telepon') is-invalid @enderror" placeholder="Masukkan No Telepon Pemasok" required>
                <!-- Menampilkan pesan error jika ada kesalahan pada input nomor telepon -->
                @error('no_telepon')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Input untuk Nomor Rekening Pemasok -->
            <div class="mb-3">
                <label for="no_rekening" class="form-label"><i class="fas fa-credit-card"></i> No Rekening</label>
                <!-- Field untuk memasukkan nomor rekening pemasok -->
                <input type="text" name="no_rekening" class="form-control @error('no_rekening') is-invalid @enderror" placeholder="Masukkan No Rekening Pemasok" required>
                <!-- Menampilkan pesan error jika ada kesalahan pada input nomor rekening -->
                @error('no_rekening')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Input untuk Alamat Pemasok -->
            <div class="mb-3">
                <label for="alamat" class="form-label"><i class="fas fa-home"></i> Alamat</label>
                <!-- Field untuk memasukkan alamat pemasok -->
                <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror" placeholder="Masukkan Alamat Pemasok" required></textarea>
                <!-- Menampilkan pesan error jika ada kesalahan pada input alamat -->
                @error('alamat')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Tombol untuk mengirim data form -->
            <div class="mb-3">
                <button type="submit" class="btn btn-success">Tambah Pemasok</button>
            </div>
        </form>
    </div>
</div>

@endsection
