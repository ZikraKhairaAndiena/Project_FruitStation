@extends('dashboard.layouts.main')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>

    <!-- Notification Section -->
    {{-- Menampilkan notifikasi jika ada --}}
    @if($notifikasi->isNotEmpty())
        <div class="alert alert-info mb-4">
            <strong>Notifikasi Baru:</strong>
            <ul>
                @foreach($notifikasi as $notif)
                    <li>{{ $notif->data['message'] }}</li> {{-- Misalnya pesan notifikasi --}}
                @endforeach
            </ul>
        </div>
    @endif

   <!-- Content Row -->
    <div class="row">

        <!-- Earnings (Monthly) Card Example - Produk -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Produk
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <!-- Menampilkan jumlah produk -->
                                {{ \App\Models\Produk::count() }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <!-- Ikon untuk Produk -->
                            <i class="fas fa-box fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example - Customer -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Customer
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <!-- Menampilkan jumlah customer -->
                                {{ \App\Models\User::where('role', 'customer')->count() }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <!-- Ikon untuk Customer -->
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example - Pesanan -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Pesanan
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                        <!-- Menampilkan persentase pesanan yang sudah kirim pembayaran -->
                                        {{ \App\Models\Pembelian::where('status_pembelian', 'sudah kirim pembayaran')->count() }}
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="progress progress-sm mr-2">
                                        <div class="progress-bar bg-info" role="progressbar" style="width: {{ \App\Models\Pembelian::where('status_pembelian', 'sudah kirim pembayaran')->count() }}%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <!-- Ikon untuk Pesanan -->
                            <i class="fas fa-clipboard-check fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Requests Card Example - Pemasok -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Pemasok
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <!-- Menampilkan jumlah pemasok -->
                                {{ \App\Models\Pemasok::count() }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <!-- Ikon untuk Pemasok -->
                            <i class="fas fa-truck fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- Content Row -->

<!-- Content Row -->
<div class="row">
    <!-- Top 5 Customer -->
    <div class="col-xl-8 col-lg-7">
        <div class="card shadow mb-4 mt-n3 border-0" style="border-radius: 12px; overflow: hidden;">
            <!-- Header dengan gradient hijau ke kuning -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between"
                style="background: linear-gradient(135deg, #6ECF74, #FFDB58); color: white; border-radius: 0;">
                <h6 class="m-0 font-weight-bold">Customer Terbaik</h6>
            </div>
            <!-- Body card -->
            <div class="card-body" style="background: #F8FAFC; padding: 20px;">
                <div class="mb-3 text-center">
                    <h6 class="font-weight-bold text-gray-800" style="font-size: 18px;">Top 5 Customer</h6>
                </div>
                <div class="list-group">
                    @foreach ($topCustomers as $customer)
                        <div class="list-group-item d-flex justify-content-between align-items-center mb-3"
                            style="background: white; border-radius: 12px; box-shadow: 0 6px 10px rgba(0, 0, 0, 0.1);
                                    padding: 15px; flex: 1; min-height: 80px; transition: all 0.3s ease;">
                            <div>
                                <strong style="font-size: 16px; color: #333;">{{ $customer->name }}</strong><br>
                                <small class="text-muted" style="font-size: 14px;">{{ $customer->email }}</small>
                            </div>
                            <span class="badge badge-primary badge-pill">
                                {{ $customer->total_pembelian }} Pesanan
                            </span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Produk Terlaris Chart -->
    <div class="col-xl-4 col-lg-5">
        <div class="card shadow mb-4 mt-n3 border-0" style="border-radius: 12px; overflow: hidden;">
            <!-- Header dengan gradient hijau ke kuning -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between"
                style="background: linear-gradient(135deg, #6ECF74, #FFDB58); color: white; border-radius: 0;">
                <h6 class="m-0 font-weight-bold">Produk Terlaris</h6>
            </div>
            <!-- Body card -->
            <div class="card-body" style="background: #F8FAFC; padding: 20px;">
                <div class="mb-3 text-center">
                    <h6 class="font-weight-bold text-gray-800" style="font-size: 18px;">Top 5 Produk Terlaris</h6>
                </div>
                <!-- Daftar produk -->
                <div class="d-flex flex-column align-items-stretch">
                    @foreach ($produkTerlaris as $index => $produk)
                        <div class="d-flex align-items-center mb-3 p-3"
                            style="background: white; border-radius: 12px; box-shadow: 0 6px 10px rgba(0, 0, 0, 0.1);
                                    flex: 1; min-height: 100px; transition: all 0.3s ease;">
                            <!-- Gambar produk -->
                            @if ($produk->gambar_produk)
                                <img src="{{ asset('img/' . $produk->gambar_produk) }}"
                                    alt="{{ $produk->nama_produk }}"
                                    style="width: 60px; height: 60px; object-fit: cover; border-radius: 50%;
                                        margin-right: 15px; border: 3px solid #6ECF74;">
                            @else
                                <img src="{{ asset('img/default.jpg') }}"
                                    alt="No Image"
                                    style="width: 60px; height: 60px; object-fit: cover; border-radius: 50%;
                                        margin-right: 15px; border: 3px solid #6ECF74;">
                            @endif
                            <!-- Informasi produk -->
                            <div class="text-left w-100 d-flex flex-column justify-content-center">
                                <strong style="font-size: 16px; color: #333;">
                                    {{ $index + 1 }}. {{ $produk->nama_produk }}
                                </strong>
                                <span class="text-muted" style="font-size: 14px;">
                                    {{ $produk->pembelianproduks_count }} Terjual
                                </span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

<!-- /.container-fluid -->
@endsection
