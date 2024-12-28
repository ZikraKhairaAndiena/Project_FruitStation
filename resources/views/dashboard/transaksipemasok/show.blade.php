@extends('dashboard.layouts.main')

@section('title', 'Detail Transaksi Pemasok')

@section('content')
<!-- Judul Halaman -->
<h1 class="mb-4 text-center text-success">Detail Transaksi Pemasok</h1>

<!-- Menampilkan pesan sukses jika ada -->
@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<!-- Menampilkan pesan error jika ada -->
@if(session('error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    {{ session('error') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<!-- Bagian Detail Transaksi -->
<div class="row">
    <!-- Container yang terpusat untuk detail transaksi -->
    <div class="col-lg-8 col-md-10 col-sm-12 mx-auto">
        <div class="card">
            <!-- Header kartu yang menampilkan judul -->
            <div class="card-header bg-success text-white">
                <h4 class="mb-0">Transaksi Pemasok</h4>
            </div>
            <div class="card-body">
                <!-- Menampilkan detail transaksi -->
                <p><strong>Pemasok:</strong> {{ $transaksi->pemasok->nama_pemasok }}</p>
                <p><strong>No Telepon:</strong> {{ $transaksi->pemasok->no_telepon }}</p>
                <p><strong>No Rekening:</strong> {{ $transaksi->pemasok->no_rekening }}</p>
                <p><strong>Alamat:</strong> {{ $transaksi->pemasok->alamat }}</p>
                <p><strong>Produk:</strong> {{ $transaksi->produk->nama_produk }}</p>
                <p><strong>Jumlah:</strong> {{ $transaksi->jumlah }}</p>
                <p><strong>Total Harga:</strong> {{ 'Rp ' . number_format($transaksi->total_harga, 0, ',', '.') }}</p>
                <p><strong>Tanggal Transaksi:</strong> {{ $transaksi->tanggal_transaksi->format('d-m-Y') }}</p>
            </div>
            <!-- Footer kartu dengan tombol kembali -->
            <div class="card-footer text-right">
                <a href="{{ route('dashboard.transaksipemasok.index') }}" class="btn btn-success">Kembali ke Daftar</a>
            </div>
        </div>
    </div>
</div>

@endsection
