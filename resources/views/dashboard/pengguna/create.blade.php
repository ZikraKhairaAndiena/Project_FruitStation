@extends('dashboard.layouts.main')

@section('title', 'Tambah Pengguna')

@section('content')

<!-- Header untuk halaman Input Data Pengguna -->
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Input Data Pengguna</h1>
</div>

<!-- Formulir Input Data Pengguna -->
<div class="row">
    <div class="col-lg-8 col-md-10 col-sm-12 mx-auto">
        <!-- Form pengiriman data pengguna ke route dashboard.pengguna.store -->
        <form action="{{ route('dashboard.pengguna.store') }}" method="post" class="p-4 border rounded shadow-sm bg-light">
            @csrf <!-- Token CSRF untuk perlindungan terhadap serangan CSRF -->

            <!-- Input untuk Nama Pengguna -->
            <div class="mb-3">
                <label for="name" class="form-label"><i class="fas fa-user"></i> Nama</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{ old('name') }}" placeholder="Masukkan Nama Pengguna" required>
                <!-- Menampilkan pesan error jika validasi gagal pada field 'name' -->
                @error('name')
                    <div class="alert alert-danger mt-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Input untuk Email Pengguna -->
            <div class="mb-3">
                <label for="email" class="form-label"><i class="fas fa-envelope"></i> Email</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" value="{{ old('email') }}" placeholder="Masukkan Email Pengguna" required>
                <!-- Menampilkan pesan error jika validasi gagal pada field 'email' -->
                @error('email')
                    <div class="alert alert-danger mt-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Input untuk Role Pengguna -->
            <div class="mb-3">
                <label for="role" class="form-label"><i class="fas fa-users-cog"></i> Role</label>
                <select name="role" class="form-select @error('role') is-invalid @enderror" required>
                    <option value="">Pilih Role</option>
                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                </select>
                <!-- Menampilkan pesan error jika validasi gagal pada field 'role' -->
                @error('role')
                    <div class="alert alert-danger mt-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Input untuk No Telepon Pengguna -->
            <div class="mb-3">
                <label for="no_telepon" class="form-label"><i class="fas fa-phone"></i> No Telepon</label>
                <input type="text" class="form-control @error('no_telepon') is-invalid @enderror" name="no_telepon" id="no_telepon" value="{{ old('no_telepon') }}" placeholder="Masukkan No Telepon Pengguna" pattern="^[0-9]{10,15}$" required>
                <!-- Menampilkan pesan error jika validasi gagal pada field 'no_telepon' -->
                @error('no_telepon')
                    <div class="alert alert-danger mt-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Input untuk Alamat Pengguna -->
            <div class="mb-3">
                <label for="alamat" class="form-label"><i class="fas fa-map-marker-alt"></i> Alamat</label>
                <textarea class="form-control @error('alamat') is-invalid @enderror" name="alamat" id="alamat" placeholder="Masukkan Alamat Pengguna" required>{{ old('alamat') }}</textarea>
                <!-- Menampilkan pesan error jika validasi gagal pada field 'alamat' -->
                @error('alamat')
                    <div class="alert alert-danger mt-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Input untuk Password Pengguna -->
            <div class="mb-3">
                <label for="password" class="form-label"><i class="fas fa-key"></i> Password</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" placeholder="Masukkan Password" required>
                <!-- Menampilkan pesan error jika validasi gagal pada field 'password' -->
                @error('password')
                    <div class="alert alert-danger mt-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Input untuk Konfirmasi Password Pengguna -->
            <div class="mb-3">
                <label for="password_confirmation" class="form-label"><i class="fas fa-key"></i> Konfirmasi Password</label>
                <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" id="password_confirmation" placeholder="Konfirmasi Password" required>
                <!-- Menampilkan pesan error jika validasi gagal pada field 'password_confirmation' -->
                @error('password_confirmation')
                    <div class="alert alert-danger mt-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Tombol untuk mengirimkan form -->
            <div class="mb-3">
                <button type="submit" class="btn btn-success">Tambah Pengguna</button>
            </div>
        </form>
    </div>
</div>

@endsection
