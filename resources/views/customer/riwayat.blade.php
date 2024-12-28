@extends('customer.layouts.main')

@section('content')
<div class="container py-5" style="padding-top: 100px;">
    <!-- Kartu Riwayat Belanja -->
    <div class="card shadow-sm mt-4">
        <div class="card-header text-center bg-light">
            <!-- Judul Halaman Riwayat Belanja -->
            <h3 class="mb-0">Riwayat Belanja {{ $user->name }}</h3>
        </div>
        <div class="card-body">
            @if($pembelian->isEmpty())
                <!-- Jika Riwayat Belanja Kosong -->
                <div class="text-center py-5">
                    <h4>Anda belum pernah melakukan pemesanan, silahkan belanja.</h4>
                    <!-- Tombol untuk Mengarahkan ke Halaman Belanja -->
                    <a href="{{ url('customer/home') }}" class="btn btn-primary mt-3">Belanja Sekarang</a>
                </div>
            @else
                <!-- Tabel untuk Menampilkan Riwayat Belanja -->
                <div class="table-responsive mb-4">
                    <table class="table table-bordered table-striped table-hover">
                        <thead class="thead-light">
                            <!-- Kolom Tabel -->
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                                <th>Total</th>
                                <th>Detail Produk</th>
                                <th>Opsi</th>
                                <th>Ulasan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Looping untuk Menampilkan Setiap Pembelian -->
                            @foreach($pembelian as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <!-- Menampilkan Tanggal Pembelian -->
                                    <td>{{ \Carbon\Carbon::parse($item->tanggal_pembelian)->format('d-m-Y') }}</td>
                                    <td>
                                        <!-- Menampilkan Status Pembelian -->
                                        {{ $item->status_pembelian }}
                                        <br>
                                        @if (!empty($item->resi_pengiriman))
                                            <!-- Menampilkan Resi Pengiriman jika Ada -->
                                            <small class="text-muted">Resi: {{ $item->resi_pengiriman }}</small>
                                        @endif
                                    </td>
                                    <td>Rp {{ number_format($item->total_pembelian, 0, ',', '.') }}</td>
                                    <td>
                                        <!-- Menampilkan Detail Produk Pembelian -->
                                        <ul class="list-unstyled mb-0">
                                            @foreach($item->pembelianProduks as $pembelianProduks)
                                                <li>{{ $pembelianProduks->nama_produk }} - Jumlah: {{ $pembelianProduks->jumlah_produk }}</li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td>
                                        <!-- Tombol Aksi berdasarkan Status Pembelian -->
                                        <div class="d-flex justify-content-between button-group">
                                            <!-- Tombol untuk Melihat Nota Pembelian -->
                                            <a href="{{ route('nota', ['id' => $item->id]) }}" class="btn btn-info me-1">Nota</a>
                                            <!-- Tombol Input Pembayaran jika Status Pending -->
                                            @if ($item->status_pembelian == "pending")
                                                <a href="{{ route('input.pembayaran', ['id' => $item->id]) }}" class="btn btn-success me-1">Input Pembayaran</a>
                                            @elseif (in_array($item->status_pembelian, ["sudah kirim pembayaran", "barang dikirim", "selesai"]))
                                                <!-- Tombol Lihat Pembayaran jika Status Pembelian Sudah Kirim Pembayaran atau Barang Dikirim -->
                                                <a href="{{ route('lihat.pembayaran', ['id' => $item->id]) }}" class="btn btn-warning me-1">Lihat Pembayaran</a>
                                            @endif
                                            <!-- Tombol Beri Ulasan jika Pembelian Selesai -->
                                            @if ($item->status_pembelian == "selesai")
                                                @if ($item->ulasan)
                                                    <span class="btn btn-secondary">Ulasan Diberikan</span>
                                                @else
                                                    <a href="{{ route('input.ulasan', ['id' => $item->id]) }}" class="btn btn-primary">Beri Ulasan</a>
                                                @endif
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        <!-- Menampilkan Ulasan Pembelian jika Ada -->
                                        @if ($item->ulasan)
                                            <div>
                                                <strong>Rating:</strong>
                                                <div class="rating-stars">
                                                    <!-- Menampilkan Bintang Rating -->
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        <i class="{{ $i <= $item->ulasan->rating ? 'fas' : 'far' }} fa-star" style="color: gold;"></i>
                                                    @endfor
                                                </div>
                                                <!-- Keterangan berdasarkan rating -->
                                                <div id="rating-description" class="rating-description">
                                                    @php
                                                        $rating = $item->ulasan->rating;
                                                        $description = '';
                                                        if ($rating == 1) {
                                                            $description = 'Sangat Buruk';
                                                        } elseif ($rating == 2) {
                                                            $description = 'Buruk';
                                                        } elseif ($rating == 3) {
                                                            $description = 'Cukup';
                                                        } elseif ($rating == 4) {
                                                            $description = 'Bagus';
                                                        } elseif ($rating == 5) {
                                                            $description = 'Sangat Bagus';
                                                        }
                                                    @endphp
                                                    <span>{{ $description }}</span>
                                                </div>
                                                <br>
                                                <strong>Komentar:</strong> {{ $item->ulasan->komentar }}
                                                <br>
                                            </div>
                                        @else
                                            <span>Belum ada ulasan</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@section('styles')
    <style>
        .rating-stars {
            display: flex;
            justify-content: center;
        }

        .rating-description {
            text-align: center;
            margin-top: 5px; /* Memberi jarak antara rating dan keterangan */
            font-weight: bold;
            color: #555;
        }
    </style>
@endsection
