@extends('dashboard.layouts.main')

@section('content')

<!-- Judul dan header halaman -->
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Edit Data Promosi</h1>
</div>

<!-- Kontainer form -->
<div class="row">
    <div class="col-lg-8 col-md-10 col-sm-12 mx-auto">
        <!-- Form ini mengirim data ke route yang ditentukan dengan metode PUT untuk memperbarui data yang ada -->
        <form action="/promosi/{{ $promosi->id }}" method="post" enctype="multipart/form-data" class="p-4 border rounded shadow-sm bg-light">
            @method('PUT') <!-- Menunjukkan bahwa form ini akan memperbarui data yang ada -->
            @csrf <!-- Token CSRF untuk keamanan -->

            <!-- Dropdown Produk ID untuk memilih produk yang terkait dengan promosi -->
            <div class="mb-3">
                <label for="produk_id" class="form-label"><i class="fas fa-tag"></i> Produk ID</label>
                <select name="produk_id" class="form-select @error('produk_id') is-invalid @enderror">
                    <option value="">Pilih Produk</option>
                    @foreach ($produks as $produk)
                        <!-- Mengisi dropdown dengan produk-produk yang ada, item yang dipilih disesuaikan dengan produk yang sedang dipromosikan -->
                        <option value="{{ $produk->id }}"
                            @if(old('produk_id', $promosi->produk_id) == $produk->id) selected @endif>
                            {{ $produk->nama_produk }}
                        </option>
                    @endforeach
                </select>
                @error('produk_id') <!-- Menampilkan pesan error jika validasi gagal -->
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Input Deskripsi untuk memasukkan deskripsi promosi -->
            <div class="mb-3">
                <label for="description" class="form-label"><i class="fas fa-info-circle"></i> Deskripsi Promosi</label>
                <input type="text" class="form-control @error('description') is-invalid @enderror" name="description" id="description" value="{{ old('description', $promosi->description) }}" placeholder="Masukkan Deskripsi Promosi">
                @error('description') <!-- Menampilkan pesan error jika validasi gagal -->
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Input Jumlah Pembelian Minimum untuk diskon berdasarkan jumlah -->
            <div class="mb-3">
                <label for="quantity_required" class="form-label"><i class="fas fa-shopping-cart"></i> Jumlah Pembelian Minimum (Quantity Discount)</label>
                <input type="number" class="form-control @error('quantity_required') is-invalid @enderror" name="quantity_required" id="quantity_required" value="{{ old('quantity_required', $promosi->quantity_required) }}" placeholder="Masukkan Jumlah Pembelian Minimum">
                @error('quantity_required') <!-- Menampilkan pesan error jika validasi gagal -->
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Input Persentase Diskon untuk memasukkan nilai diskon -->
            <div class="mb-3">
                <label for="discount_percentage" class="form-label"><i class="fas fa-percent"></i> Persentase Diskon</label>
                <input type="number" class="form-control @error('discount_percentage') is-invalid @enderror" name="discount_percentage" id="discount_percentage" value="{{ old('discount_percentage', $promosi->discount_percentage) }}" placeholder="Masukkan Persentase Diskon">
                @error('discount_percentage') <!-- Menampilkan pesan error jika validasi gagal -->
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Input Tanggal Mulai untuk memasukkan tanggal mulai promosi -->
            <div class="mb-3">
                <label for="start_date" class="form-label"><i class="fas fa-calendar"></i> Tanggal Mulai</label>
                <input type="date" class="form-control @error('start_date') is-invalid @enderror" name="start_date" id="start_date" value="{{ old('start_date', $promosi->start_date) }}">
                @error('start_date') <!-- Menampilkan pesan error jika validasi gagal -->
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Input Tanggal Berakhir untuk memasukkan tanggal berakhir promosi -->
            <div class="mb-3">
                <label for="end_date" class="form-label"><i class="fas fa-calendar"></i> Tanggal Berakhir</label>
                <input type="date" class="form-control @error('end_date') is-invalid @enderror" name="end_date" id="end_date" value="{{ old('end_date', $promosi->end_date) }}">
                @error('end_date') <!-- Menampilkan pesan error jika validasi gagal -->
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Tombol untuk mengirim form -->
            <div class="mb-3">
                <button type="submit" class="btn btn-success">Perbarui Promosi</button>
            </div>
        </form>
    </div>
</div>

@endsection
