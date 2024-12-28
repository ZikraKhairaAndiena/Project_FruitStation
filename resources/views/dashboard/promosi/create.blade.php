@extends('dashboard.layouts.main')

@section('content')

<!-- Bagian judul halaman -->
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Input Data Promosi</h1>
</div>

<!-- Bagian form input -->
<div class="row">
    <div class="col-lg-8 col-md-10 col-sm-12 mx-auto">
        <!-- Form untuk input data promosi, menggunakan metode POST dan enctype untuk upload file -->
        <form action="/promosi" method="post" enctype="multipart/form-data" class="p-4 border rounded shadow-sm bg-light">
            @csrf <!-- Token untuk mencegah CSRF -->

            <!-- Input untuk memilih produk -->
            <div class="mb-3">
                <label for="produk_id" class="form-label"><i class="fas fa-tag"></i> Produk</label>
                <select name="produk_id" class="form-select @error('produk_id') is-invalid @enderror">
                    <option value="">Pilih Produk (opsional)</option>
                    <!-- Looping untuk menampilkan daftar produk -->
                    @foreach ($produks as $produk)
                        <option value="{{ $produk->id }}" {{ old('produk_id') == $produk->id ? 'selected' : '' }}>{{ $produk->nama_produk }}</option>
                    @endforeach
                </select>
                <!-- Menampilkan error jika ada -->
                @error('produk_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Input untuk deskripsi promosi -->
            <div class="mb-3">
                <label for="description" class="form-label"><i class="fas fa-info-circle"></i> Deskripsi</label>
                <input type="text" class="form-control @error('description') is-invalid @enderror" name="description" id="description" value="{{ old('description') }}" placeholder="Masukkan Deskripsi Promosi">
                <!-- Menampilkan error jika ada -->
                @error('description')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Input untuk jumlah pembelian minimum -->
            <div class="mb-3">
                <label for="quantity_required" class="form-label"><i class="fas fa-shopping-cart"></i> Jumlah Pembelian Minimum untuk diskon berdasarkan jumlah</label>
                <input type="number" class="form-control @error('quantity_required') is-invalid @enderror" name="quantity_required" id="quantity_required" value="{{ old('quantity_required') }}" placeholder="Masukkan Jumlah Pembelian Minimum">
                <!-- Menampilkan error jika ada -->
                @error('quantity_required')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Input untuk persentase diskon -->
            <div class="mb-3">
                <label for="discount_percentage" class="form-label"><i class="fas fa-percentage"></i> Persentase Diskon</label>
                <input type="number" class="form-control @error('discount_percentage') is-invalid @enderror" name="discount_percentage" id="discount_percentage" value="{{ old('discount_percentage') }}" placeholder="Masukkan Persentase Diskon" min="0" max="100">
                <!-- Menampilkan error jika ada -->
                @error('discount_percentage')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Input untuk tanggal mulai promosi -->
            <div class="mb-3">
                <label for="start_date" class="form-label"><i class="fas fa-calendar-day"></i> Tanggal Mulai</label>
                <input type="date" class="form-control @error('start_date') is-invalid @enderror" name="start_date" id="start_date" value="{{ old('start_date') }}">
                <!-- Menampilkan error jika ada -->
                @error('start_date')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Input untuk tanggal berakhir promosi -->
            <div class="mb-3">
                <label for="end_date" class="form-label"><i class="fas fa-calendar-week"></i> Tanggal Berakhir</label>
                <input type="date" class="form-control @error('end_date') is-invalid @enderror" name="end_date" id="end_date" value="{{ old('end_date') }}">
                <!-- Menampilkan error jika ada -->
                @error('end_date')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Tombol submit untuk mengirim form -->
            <div class="mb-3">
                <button type="submit" class="btn btn-success">Tambah Promosi</button>
            </div>
        </form>
    </div>
</div>

@endsection
