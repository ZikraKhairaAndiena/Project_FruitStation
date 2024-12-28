@extends('customer.layouts.main')

@section('content')
<div class="container py-5">
    <!-- Card untuk menampilkan detail pembayaran -->
    <div class="card shadow-sm mt-4">
        <!-- Header card dengan judul detail pembayaran -->
        <div class="card-header text-center bg-light">
            <h3 class="mb-0">Detail Pembayaran untuk Order #{{ $pembayaran->pembelian_id }}</h3>
        </div>
        <div class="card-body">
            <!-- Tabel yang menampilkan informasi detail pembayaran -->
            <table class="table table-bordered">
                <!-- Menampilkan Nama Penyetor -->
                <tr>
                    <th>Nama Penyetor</th>
                    <td>{{ $pembayaran->nama_penyetor }}</td>
                </tr>

                <!-- Menampilkan Bank yang digunakan untuk pembayaran -->
                <tr>
                    <th>Bank</th>
                    <td>{{ $pembayaran->bank }}</td>
                </tr>

                <!-- Menampilkan Jumlah pembayaran dalam format mata uang -->
                <tr>
                    <th>Jumlah</th>
                    <td>Rp {{ number_format($pembayaran->jumlah, 0, ',', '.') }}</td>
                </tr>

                <!-- Menampilkan Tanggal pembayaran -->
                <tr>
                    <th>Tanggal Pembayaran</th>
                    <td>{{ $pembayaran->tanggal }}</td>
                </tr>

                <!-- Menampilkan bukti pembayaran, jika ada -->
                <tr>
                    <th>Bukti Pembayaran</th>
                    <td>
                        @if($pembayaran->bukti)
                            <!-- Jika bukti pembayaran ada, tampilkan gambar -->
                            <img src="{{ asset('storage/' . $pembayaran->bukti) }}" alt="Bukti Pembayaran" width="200" class="img-thumbnail">
                        @else
                            <!-- Jika bukti pembayaran tidak ada, tampilkan pesan -->
                            Tidak ada bukti pembayaran.
                        @endif
                    </td>
                </tr>
            </table>

            <!-- Tombol untuk kembali ke riwayat belanja -->
            <div class="text-center mt-4">
                <a href="{{ route('riwayat.belanja') }}" class="btn btn-primary">Kembali ke Riwayat Belanja</a>
            </div>
        </div>
    </div>
</div>
@endsection
