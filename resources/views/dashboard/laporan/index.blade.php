@extends('dashboard.layouts.main')

@section('title', 'Laporan')

@section('content')

<!-- Judul Halaman Laporan -->
<h1 class="mb-4 text-center text-success">Laporan Fruit Station</h1>

<!-- Menampilkan pesan alert jika ada pesan session -->
@if(session('pesan'))
<div class="alert alert-warning alert-dismissible fade show" role="alert">
    {{ session('pesan') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<!-- Baris Konten Laporan -->
<div class="row justify-content-center">

    <!-- Card untuk Laporan -->
    <div class="col-xl-6 col-lg-8 col-md-10 mb-4">
        <div class="card shadow-lg border-0" style="border-radius: 12px; overflow: hidden;">
            <!-- Header Card dengan Gradient -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-center"
                style="background: linear-gradient(135deg, #6ECF74, #FFDB58); color: white; border-radius: 12px 12px 0 0;">
                <h6 class="m-0 font-weight-bold">Laporan</h6>
            </div>

            <!-- Body Card dengan Formulir Pilihan Laporan -->
            <div class="card-body" style="background: #F8FAFC; padding: 30px;">

                <!-- Laporan Pesanan -->
                <div class="report-section mb-4">
                    <div class="card shadow-sm border-0 mb-3" style="border-radius: 10px;">
                        <div class="card-header text-center" style="background: #05a442; color: white; font-weight: 600;">
                            <i class="bi bi-file-earmark-spreadsheet"></i> Laporan Pesanan
                        </div>
                        <div class="card-body" style="background: #ffffff; border-radius: 0 0 10px 10px;">
                            <!-- Form untuk memilih bulan dan tahun laporan pesanan -->
                            <form method="GET" action="{{ route('laporan.pesanan') }}" class="d-flex justify-content-between align-items-center">
                                <div class="w-45 mb-3">
                                    <select class="form-select" name="bulan" id="bulan">
                                        <option value="">Pilih Bulan</option>
                                        @for ($i = 1; $i <= 12; $i++)
                                            <option value="{{ $i }}" {{ request()->get('bulan') == $i ? 'selected' : '' }}>
                                                {{ \Carbon\Carbon::createFromFormat('m', $i)->translatedFormat('F') }}
                                            </option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="w-45 mb-3">
                                    <select class="form-select" name="tahun" id="tahun">
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
                                </div>
                                <button type="submit" class="btn" style="background-color: #05a442; color: white;" title="Download Laporan Pesanan">
                                    <i class="bi bi-download"></i> Unduh
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Laporan Pembayaran -->
                <div class="report-section mb-4">
                    <div class="card shadow-sm border-0 mb-3" style="border-radius: 10px;">
                        <div class="card-header text-center" style="background: #56bc5d; color: white; font-weight: 600;">
                            <i class="bi bi-credit-card"></i> Laporan Pembayaran
                        </div>
                        <div class="card-body" style="background: #ffffff; border-radius: 0 0 10px 10px;">
                            <!-- Form untuk memilih bulan dan tahun laporan pembayaran -->
                            <form method="GET" action="{{ route('laporan.pembayaran') }}" class="d-flex justify-content-between align-items-center">
                                <div class="w-45 mb-3">
                                    <select class="form-select" name="bulan" id="bulan">
                                        <option value="">Pilih Bulan</option>
                                        @for ($i = 1; $i <= 12; $i++)
                                            <option value="{{ $i }}" {{ request()->get('bulan') == $i ? 'selected' : '' }}>
                                                {{ \Carbon\Carbon::createFromFormat('m', $i)->translatedFormat('F') }}
                                            </option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="w-45 mb-3">
                                    <select class="form-select" name="tahun" id="tahun">
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
                                </div>
                                <button type="submit" class="btn" style="background-color: #56bc5d; color: white;" title="Download Laporan Pembayaran">
                                    <i class="bi bi-download"></i> Unduh
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Laporan Transaksi Pemasok -->
                <div class="report-section mb-4">
                    <div class="card shadow-sm border-0 mb-3" style="border-radius: 10px;">
                        <div class="card-header text-center" style="background: #FFB900; color: white; font-weight: 600;">
                            <i class="bi bi-truck"></i> Laporan Transaksi Pemasok
                        </div>
                        <div class="card-body" style="background: #ffffff; border-radius: 0 0 10px 10px;">
                            <!-- Form untuk memilih bulan dan tahun laporan transaksi pemasok -->
                            <form method="GET" action="{{ route('laporan.transaksi-pemasok') }}" class="d-flex justify-content-between align-items-center">
                                <div class="w-45 mb-3">
                                    <select class="form-select" name="bulan" id="bulan">
                                        <option value="">Pilih Bulan</option>
                                        @for ($i = 1; $i <= 12; $i++)
                                            <option value="{{ $i }}" {{ request()->get('bulan') == $i ? 'selected' : '' }}>
                                                {{ \Carbon\Carbon::createFromFormat('m', $i)->translatedFormat('F') }}
                                            </option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="w-45 mb-3">
                                    <select class="form-select" name="tahun" id="tahun">
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
                                </div>
                                <button type="submit" class="btn" style="background-color: #FFB900; color: white;" title="Download Laporan Transaksi Pemasok">
                                    <i class="bi bi-download"></i> Unduh
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>

@endsection
