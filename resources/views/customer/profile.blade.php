@extends('customer.layouts.main')

@section('title', 'Profile')

@section('content')
<div class="container my-5 d-flex justify-content-center">
    <!-- Kartu Profil Pengguna -->
    <div class="card shadow-lg border-0" style="width: 100%; max-width: 600px;">
        <div class="card-header bg-gradient-primary text-white text-center py-4">
            <!-- Judul Profil Pengguna -->
            <h3 class="mb-0">User Profile</h3>
        </div>
        <div class="card-body px-5 py-4">
            <div class="row">
                <!-- Gambar Profil (Opsional) -->
                <div class="col-md-4 text-center mb-4">
                    {{--
                    <img src="{{ $user->profile_picture ?? asset('img/default-avatar.png') }}"
                         alt="Profile Picture"
                         class="img-fluid rounded-circle mb-3 shadow"
                         style="width: 180px; height: 180px; object-fit: cover;">
                    --}}
                    <!-- Menampilkan nama pengguna -->
                    <h5 class="text-muted">Welcome, {{ $user->name }}!</h5>
                </div>

                <!-- Detail Profil Pengguna -->
                <div class="col-md-8">
                    <ul class="list-group list-group-flush">
                        <!-- Menampilkan Nama Pengguna -->
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <strong>Name:</strong>
                            <span>{{ $user->name }}</span>
                        </li>
                        <!-- Menampilkan Email Pengguna -->
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <strong>Email:</strong>
                            <span>{{ $user->email }}</span>
                        </li>
                        <!-- Menampilkan No Telepon Pengguna (jika ada) -->
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <strong>No Telepon:</strong>
                            <span>{{ $user->no_telepon ?? '-' }}</span>
                        </li>
                        <!-- Menampilkan Alamat Pengguna (jika ada) -->
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <strong>Alamat:</strong>
                            <span>{{ $user->alamat ?? '-' }}</span>
                        </li>
                        <!-- Menampilkan Role Pengguna (default 'User' jika kosong) -->
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <strong>Role:</strong>
                            <span>{{ $user->role ?? 'User' }}</span>
                        </li>
                        <!-- Menampilkan Tanggal Bergabung -->
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <strong>Joined At:</strong>
                            <span>{{ $user->created_at->format('d M Y') }}</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Tombol Aksi -->
            <div class="text-center mt-5">
                <!-- Tombol untuk mengedit profil -->
                <a href="{{ route('customer.profile') }}" class="btn btn-primary btn-lg px-4">
                    <i class="fas fa-edit"></i> Edit Profile
                </a>
                <!-- Tombol untuk kembali ke halaman utama -->
                <a href="{{ url('customer/home') }}" class="btn btn-secondary btn-lg px-4">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
