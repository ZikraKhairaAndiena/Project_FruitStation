@extends('customer.layouts.main')

@section('content')
<div class="container py-5">
    <!-- Judul Nota Pembelian dan Informasi Umum Pembelian -->
    <div class="text-center mb-4">
        <h2 class="font-weight-bold text-info">Nota Pembelian</h2>
        <h5>ID Pembelian: <span class="text-primary">{{ $pembelian->id }}</span></h5>
        <h5>Tanggal Pembelian: <span class="text-primary">{{ \Carbon\Carbon::parse($pembelian->tanggal_pembelian)->format('d-m-Y') }}</span></h5>
        <h5>Status Pembelian: <span class="text-primary">{{ ucfirst($pembelian->status_pembelian) }}</span></h5>
    </div>

    <hr class="my-4">

    <!-- Informasi Customer -->
    <div class="customer-info mb-4">
        <h4 class="font-weight-bold text-success">Informasi Customer:</h4>
        <div class="border p-3 rounded bg-light shadow-sm">
            <p><strong>Nama:</strong> <span class="text-secondary">{{ $pembelian->user->name }}</span></p>
            <p><strong>No Telepon:</strong> <span class="text-secondary">{{ $pembelian->user->no_telepon }}</span></p>
            <p><strong>Email:</strong> <span class="text-secondary">{{ $pembelian->user->email }}</span></p>
        </div>
    </div>

    <!-- Rincian Produk yang dibeli -->
    <h4 class="font-weight-bold text-success">Rincian Produk:</h4>
    <div class="table-responsive mb-4">
        <table class="table table-striped table-bordered">
            <thead class="table-light">
                <tr>
                    <th>Nama Produk</th>
                    <th>Jumlah</th>
                    <th>Harga</th>
                    <th>Diskon</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $totalHargaProduk = 0;
                    $totalDiskon = 0;
                @endphp
                @foreach($pembelian->pembelianProduks as $produk)
                    @php
                        // Menghitung subtotal, diskon, dan subtotal setelah diskon
                        $subtotal = $produk->harga_produk * $produk->jumlah_produk;
                        $diskon = ($pembelian->discount * $subtotal) / $pembelian->pembelianProduks->sum(fn($p) => $p->harga_produk * $p->jumlah_produk);
                        $subtotalSetelahDiskon = $subtotal - $diskon;

                        $totalHargaProduk += $subtotal;
                        $totalDiskon += $diskon;
                    @endphp
                    <tr>
                        <!-- Menampilkan informasi produk -->
                        <td>{{ $produk->nama_produk }}</td>
                        <td>{{ $produk->jumlah_produk }}</td>
                        <td>Rp{{ number_format($produk->harga_produk, 0, ',', '.') }}</td>
                        <td>Rp{{ number_format($diskon, 0, ',', '.') }}</td>
                        <td>Rp{{ number_format($subtotalSetelahDiskon, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @php
        // Menghitung total setelah diskon dan total pembelian (termasuk ongkos kirim)
        $totalSetelahDiskon = $totalHargaProduk - $totalDiskon;
        $totalPembelian = $totalSetelahDiskon + $pembelian->tarif;
    @endphp

    <!-- Rincian Pembayaran -->
    <div class="mb-4">
        <h5 class="font-weight-bold text-success">Rincian Pembayaran:</h5>
        <div class="border p-3 rounded bg-light shadow-sm">
            <!-- Menampilkan subtotal produk setelah diskon -->
            <h5>Subtotal Produk: <span class="text-primary">Rp{{ number_format($subtotalSetelahDiskon, 0, ',', '.') }}</span></h5>
            <!-- Menampilkan ongkos kirim -->
            <h5>Ongkos Kirim: <span class="text-primary">Rp{{ number_format($pembelian->tarif, 0, ',', '.') }}</span></h5>
            <!-- Menampilkan total pembelian -->
            <h5>Total Pembelian: <span class="text-danger">Rp{{ number_format($totalPembelian, 0, ',', '.') }}</span></h5>
            <div class="d-flex justify-content-between mt-3">
                <!-- Menampilkan alamat pengiriman -->
                <h5 class="font-weight-bold">Alamat Pengiriman:</h5>
                <div class="border p-2 rounded bg-light" style="font-size: 1.1em; flex: 1; margin-left: 10px;">
                    <strong>{{ $pembelian->alamat_pengiriman }}</strong>
                </div>
            </div>
        </div>
    </div>

    <hr class="my-4">

    <!-- Informasi Pembayaran yang harus dilakukan -->
    <div class="payment-info bg-light p-4 rounded shadow-sm border p-3">
        <h4 class="font-weight-bold">Silahkan melakukan pembayaran</h4>
        <!-- Menampilkan jumlah yang harus dibayar -->
        <h5 class="font-weight-bold">Jumlah: <span class="text-danger">Rp{{ number_format($totalPembelian, 0, ',', '.') }}</span></h5>
        <!-- Menampilkan nomor rekening tujuan pembayaran -->
        <h5 class="font-weight-bold">Ke-> <span class="text-success">BANK BRI 547-90102890-9539</span></h5>
        <!-- Menampilkan nama penerima -->
        <h5 class="font-weight-bold">AN. <span class="text-success">FruitStation Padang</span></h5>
    </div>
</div>
@endsection
