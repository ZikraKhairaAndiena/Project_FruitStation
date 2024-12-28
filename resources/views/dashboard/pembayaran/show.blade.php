@extends('dashboard.layouts.main')

@section('title', 'Detail Pembayaran')

@section('content')
<h1 class="mb-4 text-center text-success">Detail Pembayaran</h1>

<div class="card shadow-lg border-0 rounded-lg">
    <!-- Header Kartu: Bagian Informasi Pembayaran -->
    <div class="card-header bg-gradient-success text-white rounded-top">
        <h5 class="mb-0"><i class="fas fa-info-circle"></i> Informasi Pembayaran</h5>
    </div>
    <div class="card-body p-4">
        <!-- Informasi Customer -->
        <div class="row mb-3">
            <div class="col-md-4"><strong>Customer:</strong></div>
            <div class="col-md-8 text-muted">{{ $pembayaran->pembelian->user->name ?? '-' }}</div>
        </div>

        <!-- Daftar Produk yang Dibeli -->
        <div class="row mb-3">
            <div class="col-md-4"><strong>Produk yang Dibeli:</strong></div>
            <div class="col-md-8">
                <ul>
                    @foreach ($pembayaran->pembelian->pembelianproduks as $produk)
                        <li>{{ $produk->nama_produk }} - Jumlah: {{ $produk->jumlah_produk }}</li>
                    @endforeach
                </ul>
            </div>
        </div>

        <!-- Informasi Penyetor -->
        <div class="row mb-3">
            <div class="col-md-4"><strong>Nama Penyetor:</strong></div>
            <div class="col-md-8 text-muted">{{ $pembayaran->nama_penyetor }}</div>
        </div>
        <div class="row mb-3">
            <div class="col-md-4"><strong>Bank:</strong></div>
            <div class="col-md-8 text-muted">{{ $pembayaran->bank }}</div>
        </div>

        <!-- Informasi Total Pembelian -->
        <div class="row mb-3">
            <div class="col-md-4"><strong>Total Pembelian:</strong></div>
            <div class="col-md-8 text-muted">Rp {{ number_format($pembayaran->pembelian->total_pembelian ?? 0, 0, ',', '.') }}</div>
        </div>

        <!-- Informasi Jumlah Pembayaran -->
        <div class="row mb-3">
            <div class="col-md-4"><strong>Jumlah Pembayaran:</strong></div>
            <div class="col-md-8 text-muted">Rp {{ number_format($pembayaran->jumlah, 0, ',', '.') }}</div>
        </div>

        <!-- Tanggal Pembelian dan Pembayaran -->
        <div class="row mb-3">
            <div class="col-md-4"><strong>Tanggal Pembelian:</strong></div>
            <div class="col-md-8 text-muted">{{ \Carbon\Carbon::parse($pembayaran->pembelian->tanggal_pembelian ?? '')->format('d-m-Y') }}</div>
        </div>
        <div class="row mb-3">
            <div class="col-md-4"><strong>Tanggal Pembayaran:</strong></div>
            <div class="col-md-8 text-muted">{{ \Carbon\Carbon::parse($pembayaran->tanggal)->format('d-m-Y') }}</div>
        </div>

        <!-- Informasi Ongkir (Biaya Pengiriman) -->
        <div class="row mb-3">
            <div class="col-md-4"><strong>Ongkir:</strong></div>
            <div class="col-md-8 text-muted">Rp {{ number_format($pembayaran->pembelian->ongkir->tarif ?? 0, 0, ',', '.') }}</div>
        </div>

        <!-- Informasi Alamat Pengiriman -->
        <div class="row mb-3">
            <div class="col-md-4"><strong>Alamat Pengiriman:</strong></div>
            <div class="col-md-8 text-muted">{{ $pembayaran->pembelian->alamat_pengiriman ?? '-' }}</div>
        </div>

        <!-- Bukti Pembayaran (Gambar) -->
        <div class="row mb-3">
            <div class="col-md-4"><strong>Bukti Pembayaran:</strong></div>
            <div class="col-md-8">
                @if($pembayaran->bukti)
                    <img src="{{ asset('storage/' . $pembayaran->bukti) }}" alt="Bukti Pembayaran" class="img-fluid rounded shadow w-50">
                @else
                    <span class="text-muted">Tidak ada bukti pembayaran.</span>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Tombol Kembali -->
<div class="text-center mt-4">
    <a href="{{ route('dashboard.pembayaran.index') }}" class="btn btn-success btn-lg shadow">
        <i class="fas fa-arrow-left me-1"></i> Kembali
    </a>
</div>
@endsection
