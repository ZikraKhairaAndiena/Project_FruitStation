@extends('customer.layouts.main')

@section('content')
<div class="container py-5">
    <!-- Kartu Detail Pembayaran -->
    <div class="card shadow-sm mt-4">
        <div class="card-header text-center bg-light">
            <!-- Judul untuk formulir pembayaran -->
            <h2 class="mb-0">Make Payment for Order #{{ $pembelian->id }}</h2>
        </div>
        <div class="card-body">
            <!-- Menampilkan total tagihan yang harus dibayar oleh pelanggan -->
            <div class="mb-4 text-center">
                <h4>Total Tagihan: <span class="text-success fw-bold">Rp. {{ number_format($pembelian->total_pembelian, 0, ',', '.') }}</span></h4>
            </div>

            <!-- Formulir pembayaran untuk mengumpulkan detail dari pengguna -->
            <form action="{{ route('pembayaran.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <!-- Field tersembunyi untuk menyimpan ID pembelian -->
                <input type="hidden" name="pembelian_id" value="{{ $pembelian->id }}">

                <!-- Field input untuk nama penyetor -->
                <div class="mb-3">
                    <label for="nama_penyetor" class="form-label">Nama Penyetor</label>
                    <input type="text" class="form-control" name="nama_penyetor" placeholder="Masukkan nama penyetor" required>
                </div>

                <!-- Field input untuk nama bank -->
                <div class="mb-3">
                    <label for="bank" class="form-label">Bank</label>
                    <input type="text" class="form-control" name="bank" placeholder="Masukkan nama bank" required>
                </div>

                <!-- Field input untuk jumlah yang dibayar -->
                <div class="mb-3">
                    <label for="jumlah" class="form-label">Jumlah</label>
                    <input type="number" class="form-control" name="jumlah" placeholder="Masukkan jumlah" required>
                </div>

                <!-- Field input untuk bukti pembayaran (foto) -->
                <div class="mb-3">
                    <label for="bukti" class="form-label">Foto Bukti</label>
                    <input type="file" class="form-control" name="bukti" required>
                    <!-- Penjelasan mengenai format file yang diterima -->
                    <small class="form-text text-muted">Format yang diterima: JPG, PNG (maks. 2MB).</small>
                </div>

                <!-- Tombol untuk mengirimkan informasi pembayaran -->
                <div class="text-center">
                    <button type="submit" class="btn btn-success">Kirim Pembayaran</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
