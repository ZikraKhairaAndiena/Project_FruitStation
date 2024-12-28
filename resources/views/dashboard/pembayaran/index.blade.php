@extends('dashboard.layouts.main')

@section('title', 'Daftar Pembayaran')

@section('content')
<!-- Title Section -->
<h1 class="mb-4 text-center text-success">Daftar Pembayaran</h1>

<!-- Filter and Search Form -->
<div class="d-flex justify-content-between mb-3 align-items-center">
    <!-- Filter dan Cetak PDF -->
    <div class="d-flex align-items-center">
        <form method="GET" action="{{ route('pembayaran.cetak-pdf') }}" target="_blank" class="d-flex align-items-center" style="gap: 5px;">
            <!-- Cetak PDF Button -->
            <button class="btn btn-custom-green d-flex align-items-center justify-content-center p-2" style="width: 40px; height: 40px;" type="submit">
                <i class="bi bi-file-earmark-pdf fs-4"></i>
            </button>

            <!-- Pilihan Bulan -->
            <select class="form-select ms-2" name="bulan" style="max-width: 120px;">
                <option value="">Pilih Bulan</option>
                @for ($i = 1; $i <= 12; $i++)
                    <option value="{{ $i }}" {{ request()->get('bulan') == $i ? 'selected' : '' }}>
                        {{ DateTime::createFromFormat('!m', $i)->format('F') }}
                    </option>
                @endfor
            </select>

            <!-- Pilihan Tahun -->
            <select class="form-select ms-2" name="tahun" style="max-width: 120px;">
                <option value="">Pilih Tahun</option>
                @php
                    $currentYear = date('Y');
                @endphp
                @for ($i = $currentYear; $i >= $currentYear - 10; $i--)
                    <option value="{{ $i }}" {{ request()->get('tahun') == $i ? 'selected' : '' }}>
                        {{ $i }}
                    </option>
                @endfor
            </select>
        </form>
    </div>

    <!-- Search Form -->
    <form method="GET" action="{{ route('dashboard.pembayaran.index') }}" class="d-flex">
        <div class="d-flex" style="max-width: 300px; width: 100%;">
            <input class="form-control me-2" type="search" name="search" value="{{ request()->get('search') }}" placeholder="Cari Pembayaran..." aria-label="Search">
            <button class="btn btn-primary ms-2" type="submit">Cari</button>
        </div>
    </form>
</div>

<!-- Table Data Pembayaran -->
<div class="card shadow-lg border-0 rounded-lg">
    <div class="card-header bg-gradient-success text-white">
        <h5 class="mb-0"><i class="fas fa-money-check-alt"></i> Daftar Pembayaran</h5>
    </div>
    <div class="card-body p-4">
        <table class="table table-bordered table-hover">
            <thead class="table-success">
                <tr>
                    <!-- Table Columns -->
                    <th>No</th>
                    <th>Customer</th>
                    <th>Nama Produk</th>
                    <th>Nama Penyetor</th>
                    <th>Bank</th>
                    <th>Jumlah Pembayaran</th>
                    <th>Tanggal Pembayaran</th>
                    <th>Alamat Pengiriman</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <!-- Display Pembayaran Data -->
                @foreach ($pembayarans as $index => $pembayaran)
                <tr>
                    <!-- Row Data -->
                    <td>{{ $pembayarans->firstItem() + $index }}</td>
                    <td>{{ $pembayaran->pembelian->user->name ?? '-' }}</td>
                    <td>
                        <!-- Produk List -->
                        <ul>
                            @foreach ($pembayaran->pembelian->pembelianproduks as $produk)
                                <li>{{ $produk->nama_produk }} - Jumlah: {{ $produk->jumlah_produk }}</li>
                            @endforeach
                        </ul>
                    </td>
                    <td>{{ $pembayaran->nama_penyetor }}</td>
                    <td>{{ $pembayaran->bank }}</td>
                    <td>Rp {{ number_format($pembayaran->jumlah, 0, ',', '.') }}</td>
                    <td>{{ \Carbon\Carbon::parse($pembayaran->tanggal)->format('d-m-Y') }}</td>
                    <td>{{ $pembayaran->pembelian->alamat_pengiriman ?? '-' }}</td>
                    <td>
                        <!-- Action Button (View Detail) -->
                        <a href="{{ route('dashboard.pembayaran.show', $pembayaran->id) }}" class="btn btn-info btn-sm">
                            <i class="fas fa-eye"></i> Detail
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-4">
            {{ $pembayarans->links('pagination::bootstrap-4') }}
        </div>

        <!-- Total Pemasukan Section -->
        <div class="mt-4">
            <h5 class="text-end text-success">
                Total Pemasukan: Rp {{ number_format($total_pemasukan, 0, ',', '.') }}
            </h5>
        </div>
    </div>
</div>
@endsection
