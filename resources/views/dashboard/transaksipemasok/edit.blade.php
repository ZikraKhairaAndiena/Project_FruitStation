@extends('dashboard.layouts.main')

@section('title', 'Edit Transaksi Pemasok')

@section('content')

<!-- Judul Halaman -->
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Edit Data Transaksi Pemasok</h1>
</div>

<!-- Formulir untuk Mengedit Transaksi -->
<div class="row">
    <div class="col-lg-8 col-md-10 col-sm-12 mx-auto">
        <!-- Form untuk memperbarui transaksi -->
        <form action="{{ route('dashboard.transaksipemasok.update', $transaksi->id) }}" method="post" class="p-4 border rounded shadow-sm bg-light">
            @method('PUT') <!-- Menentukan metode form sebagai PUT untuk pembaruan -->
            @csrf <!-- Token CSRF untuk keamanan -->

            <!-- Dropdown Pemasok -->
            <div class="mb-3">
                <label for="pemasok_id" class="form-label"><i class="fas fa-user"></i> Pemasok</label>
                <select name="pemasok_id" class="form-select @error('pemasok_id') is-invalid @enderror" required>
                    <!-- Loop melalui daftar pemasok untuk mengisi dropdown -->
                    @foreach($pemasok as $pemasokItem)
                        <option value="{{ $pemasokItem->id }}" {{ old('pemasok_id', $transaksi->pemasok_id) == $pemasokItem->id ? 'selected' : '' }}>{{ $pemasokItem->nama_pemasok }}</option>
                    @endforeach
                </select>
                @error('pemasok_id') <!-- Menampilkan pesan error jika validasi gagal -->
                    <div class="alert alert-danger mt-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Dropdown Produk -->
            <div class="mb-3">
                <label for="produk_id" class="form-label"><i class="fas fa-box"></i> Produk</label>
                <select name="produk_id" class="form-select @error('produk_id') is-invalid @enderror" required>
                    <!-- Loop melalui daftar produk untuk mengisi dropdown -->
                    @foreach($produk as $produkItem)
                        <option value="{{ $produkItem->id }}" {{ old('produk_id', $transaksi->produk_id) == $produkItem->id ? 'selected' : '' }}>{{ $produkItem->nama_produk }}</option>
                    @endforeach
                </select>
                @error('produk_id') <!-- Menampilkan pesan error jika validasi gagal -->
                    <div class="alert alert-danger mt-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Input Jumlah -->
            <div class="mb-3">
                <label for="jumlah" class="form-label"><i class="fas fa-cogs"></i> Jumlah</label>
                <input type="number" class="form-control @error('jumlah') is-invalid @enderror" name="jumlah" id="jumlah" value="{{ old('jumlah', $transaksi->jumlah) }}" required>
                @error('jumlah') <!-- Menampilkan pesan error jika validasi gagal -->
                    <div class="alert alert-danger mt-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Input Total Harga -->
            <div class="mb-3">
                <label for="total_harga" class="form-label"><i class="fas fa-cogs"></i> Total Harga</label>
                <input type="number" class="form-control @error('total_harga') is-invalid @enderror" name="total_harga" id="total_harga" value="{{ old('total_harga', number_format($transaksi->total_harga, 0, ',', '.')) }}" required>
                @error('total_harga') <!-- Menampilkan pesan error jika validasi gagal -->
                    <div class="alert alert-danger mt-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Input Tanggal Transaksi -->
            <div class="mb-3">
                <label for="tanggal_transaksi" class="form-label"><i class="fas fa-calendar-alt"></i> Tanggal Transaksi</label>
                <input type="date" class="form-control @error('tanggal_transaksi') is-invalid @enderror" name="tanggal_transaksi" id="tanggal_transaksi" value="{{ old('tanggal_transaksi', $transaksi->tanggal_transaksi->format('Y-m-d')) }}" required>
                @error('tanggal_transaksi') <!-- Menampilkan pesan error jika validasi gagal -->
                    <div class="alert alert-danger mt-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Tombol Submit -->
            <div class="mb-3">
                <button type="submit" class="btn btn-success">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

@endsection
