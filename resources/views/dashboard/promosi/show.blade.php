@extends('dashboard.layouts.main')

@section('content')

<!-- Bagian header untuk judul halaman -->
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Detail Data Promosi</h1>
</div>

<!-- Baris utama untuk menampilkan detail promosi -->
<div class="row">
    <div class="col-lg-8 col-md-10 col-sm-12 mx-auto">
        <div class="card shadow-sm border rounded">
            <!-- Header card yang berisi judul bagian -->
            <div class="card-header bg-light">
                <h5 class="mb-0">Informasi Promosi</h5>
            </div>
            <div class="card-body bg-light">

                <!-- Menampilkan Produk ID (ID Produk) -->
                <div class="mb-3">
                    <label for="produk_id" class="form-label"><i class="fas fa-tag"></i> Produk ID</label>
                    <p class="form-control-plaintext border p-2 rounded bg-white">
                        <!-- Jika tidak ada produk ID dan jenis promosi adalah 'coupon', tampilkan 'Semua Produk' -->
                        @if(empty($promosi->produk_id) && strtolower($promosi->type) == 'coupon')
                            Berlaku untuk Semua Produk
                        @else
                            {{ $promosi->produk_id }}
                        @endif
                    </p>
                </div>

                <!-- Menampilkan Deskripsi (Description) -->
                <div class="mb-3">
                    <label for="description" class="form-label"><i class="fas fa-info-circle"></i> Deskripsi</label>
                    <p class="form-control-plaintext border p-2 rounded bg-white">{{ $promosi->description }}</p>
                </div>

                <!-- Menampilkan Jumlah Pembelian Minimum (Quantity) -->
                <div class="mb-3">
                    <label for="quantity_required" class="form-label"><i class="fas fa-cogs"></i> Jumlah Pembelian Minimum (Quantity)</label>
                    <p class="form-control-plaintext border p-2 rounded bg-white">
                        {{ $promosi->quantity_required ? $promosi->quantity_required : '-' }}
                    </p>
                </div>

                <!-- Menampilkan Persentase Diskon (Discount Percentage) -->
                <div class="mb-3">
                    <label for="discount_percentage" class="form-label"><i class="fas fa-percentage"></i> Persentase Diskon</label>
                    <p class="form-control-plaintext border p-2 rounded bg-white">{{ $promosi->discount_percentage }}%</p>
                </div>

                <!-- Menampilkan Tanggal Mulai (Start Date) -->
                <div class="mb-3">
                    <label for="start_date" class="form-label"><i class="fas fa-calendar-day"></i> Tanggal Mulai</label>
                    <p class="form-control-plaintext border p-2 rounded bg-white">{{ \Carbon\Carbon::parse($promosi->start_date)->format('d-m-Y') }}</p>
                </div>

                <!-- Menampilkan Tanggal Selesai (End Date) -->
                <div class="mb-3">
                    <label for="end_date" class="form-label"><i class="fas fa-calendar-day"></i> Tanggal Selesai</label>
                    <p class="form-control-plaintext border p-2 rounded bg-white">{{ \Carbon\Carbon::parse($promosi->end_date)->format('d-m-Y') }}</p>
                </div>

            </div>
            <!-- Footer card dengan tombol kembali -->
            <div class="card-footer text-end">
                <a href="/promosi/" class="btn btn-success btn-sm">Kembali</a>
            </div>
        </div>
    </div>
</div>

@endsection
