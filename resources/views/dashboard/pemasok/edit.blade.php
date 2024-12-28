@extends('dashboard.layouts.main')

@section('title', 'Edit Pemasok')

@section('content')

<!-- Bagian header halaman dengan judul 'Edit Data Pemasok' -->
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Edit Data Pemasok</h1>
</div>

<!-- Formulir untuk mengedit data pemasok -->
<div class="row">
    <div class="col-lg-8 col-md-10 col-sm-12 mx-auto">
        <!-- Formulir ini akan mengirimkan data yang telah diperbarui ke route dashboard.pemasok.update dengan metode PUT -->
        <form action="{{ route('dashboard.pemasok.update', $pemasok->id) }}" method="POST" class="p-4 border rounded shadow-sm bg-light">
            @csrf <!-- Token CSRF untuk keamanan -->
            @method('PUT') <!-- Menggunakan metode PUT untuk pembaruan data -->

            <!-- Input untuk Nama Pemasok -->
            <div class="mb-3">
                <label for="nama_pemasok" class="form-label"><i class="fas fa-truck"></i> Nama Pemasok</label>
                <!-- Field untuk memasukkan nama pemasok dengan nilai yang sudah ada sebelumnya -->
                <input type="text" name="nama_pemasok" class="form-control @error('nama_pemasok') is-invalid @enderror" value="{{ $pemasok->nama_pemasok }}" required>
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
                <!-- Field untuk memasukkan nomor telepon pemasok dengan nilai yang sudah ada sebelumnya -->
                <input type="text" name="no_telepon" class="form-control @error('no_telepon') is-invalid @enderror" value="{{ $pemasok->no_telepon }}" required>
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
                <!-- Field untuk memasukkan nomor rekening pemasok dengan nilai yang sudah ada sebelumnya -->
                <input type="text" name="no_rekening" class="form-control @error('no_rekening') is-invalid @enderror" value="{{ $pemasok->no_rekening }}" required>
                <!-- Menampilkan pesan error jika ada kesalahan pada input nomor rekening -->
                @error('no_rekening')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Input untuk Alamat Pemasok -->
            <div class="mb-3">
                <label for="alamat" class="form-label"><i class="fas fa-map-marker-alt"></i> Alamat</label>
                <!-- Field untuk memasukkan alamat pemasok dengan nilai yang sudah ada sebelumnya -->
                <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror" required>{{ $pemasok->alamat }}</textarea>
                <!-- Menampilkan pesan error jika ada kesalahan pada input alamat -->
                @error('alamat')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Tombol untuk mengirim data form yang sudah diperbarui -->
            <div class="mb-3">
                <button type="submit" class="btn btn-success">Perbarui Pemasok</button>
            </div>
        </form>
    </div>
</div>

@endsection
