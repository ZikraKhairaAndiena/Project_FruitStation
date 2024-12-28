@extends('dashboard.layouts.main')

@section('content')

<!-- Heading halaman -->
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Edit Data Pengguna</h1> <!-- Judul halaman -->
</div>

<div class="row">
    <div class="col-lg-8 col-md-10 col-sm-12 mx-auto">
        <!-- Formulir untuk memperbarui data pengguna -->
        <form action="{{ route('dashboard.pengguna.update', $user->id) }}" method="post" class="p-4 border rounded shadow-sm bg-light">
            @method('PUT') <!-- Menunjukkan bahwa ini adalah form untuk memperbarui data -->
            @csrf <!-- Token CSRF untuk keamanan -->

            <!-- Kolom input untuk nama pengguna -->
            <div class="mb-3">
                <label for="name" class="form-label"><i class="fas fa-user"></i> Nama</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{ old('name', $user->name) }}" placeholder="Masukkan Nama Pengguna">
                @error('name')
                    <div class="invalid-feedback">
                        {{ $message }} <!-- Menampilkan pesan error jika validasi gagal -->
                    </div>
                @enderror
            </div>

            <!-- Kolom input untuk email pengguna -->
            <div class="mb-3">
                <label for="email" class="form-label"><i class="fas fa-envelope"></i> Email</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" value="{{ old('email', $user->email) }}" placeholder="Masukkan Email Pengguna">
                @error('email')
                    <div class="invalid-feedback">
                        {{ $message }} <!-- Menampilkan pesan error jika validasi gagal -->
                    </div>
                @enderror
            </div>

            <!-- Kolom untuk memilih role pengguna -->
            <div class="mb-3">
                <label for="role" class="form-label"><i class="fas fa-user-tag"></i> Role</label>
                <select name="role" class="form-select @error('role') is-invalid @enderror">
                    <option value="">Pilih Role</option> <!-- Opsi default -->
                    <option value="super_admin" {{ old('role', $user->role) == 'super_admin' ? 'selected' : '' }}>Super Admin</option>
                    <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="customer" {{ old('role', $user->role) == 'customer' ? 'selected' : '' }}>Customer</option>
                </select>
                @error('role')
                    <div class="invalid-feedback">
                        {{ $message }} <!-- Menampilkan pesan error jika validasi gagal -->
                    </div>
                @enderror
            </div>

            <!-- Kolom input untuk nomor telepon -->
            <div class="mb-3">
                <label for="no_telepon" class="form-label"><i class="fas fa-phone"></i> No Telepon</label>
                <input type="text" class="form-control @error('no_telepon') is-invalid @enderror" name="no_telepon" id="no_telepon" value="{{ old('no_telepon', $user->no_telepon) }}" placeholder="Masukkan No Telepon">
                @error('no_telepon')
                    <div class="invalid-feedback">
                        {{ $message }} <!-- Menampilkan pesan error jika validasi gagal -->
                    </div>
                @enderror
            </div>

            <!-- Kolom input untuk alamat pengguna -->
            <div class="mb-3">
                <label for="alamat" class="form-label"><i class="fas fa-map-marker-alt"></i> Alamat</label>
                <input type="text" class="form-control @error('alamat') is-invalid @enderror" name="alamat" id="alamat" value="{{ old('alamat', $user->alamat) }}" placeholder="Masukkan Alamat Pengguna">
                @error('alamat')
                    <div class="invalid-feedback">
                        {{ $message }} <!-- Menampilkan pesan error jika validasi gagal -->
                    </div>
                @enderror
            </div>

            <!-- Tombol untuk mengirimkan form -->
            <div class="mb-3">
                <button type="submit" class="btn btn-success">Perbarui Pengguna</button> <!-- Tombol untuk mengirimkan form -->
            </div>
        </form>
    </div>
</div>

@endsection
