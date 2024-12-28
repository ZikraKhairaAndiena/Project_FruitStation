@extends('dashboard.layouts.main')  <!-- Menyertakan layout utama untuk halaman dashboard -->

@section('content')  <!-- Memulai bagian konten halaman -->

<!-- Bagian untuk menampilkan judul halaman -->
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Input Data Produk</h1>  <!-- Judul Halaman untuk input data produk -->
</div>

<div class="row">
    <div class="col-lg-8 col-md-10 col-sm-12 mx-auto"> <!-- Menyusun form di tengah halaman -->

        <!-- Form untuk menambahkan produk, menggunakan method POST dan enctype untuk upload file -->
        <form action="/produk" method="post" enctype="multipart/form-data" class="p-4 border rounded shadow-sm bg-light">
            @csrf  <!-- Token CSRF untuk mengamankan form -->

            <!-- Input untuk Produk ID -->
            <div class="mb-3">
                <label for="produk_id" class="form-label"><i class="fas fa-tag"></i> Produk ID</label>
                <input type="text" class="form-control @error('produk_id') is-invalid @enderror" name="produk_id" id="produk_id" value="{{ old('produk_id') }}" placeholder="Masukkan Produk ID">
                @error('produk_id')  <!-- Menampilkan pesan error jika ada -->
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Dropdown untuk memilih Kategori -->
            <div class="mb-3">
                <label class="form-label"><i class="fas fa-list-alt"></i> Kategori ID</label>
                <select name="kategori_id" class="form-select @error('kategori_id') is-invalid @enderror">
                    <option value="">Pilih Kategori</option>
                    <!-- Looping untuk menampilkan daftar kategori dari database -->
                    @foreach ($kategoris as $datakategori)
                        <option value="{{ $datakategori->id }}">{{ $datakategori->nama_kategori }}</option>
                    @endforeach
                </select>
                @error('kategori_id')  <!-- Menampilkan pesan error jika ada -->
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Input untuk Nama Produk -->
            <div class="mb-3">
                <label for="nama_produk" class="form-label"><i class="fas fa-apple-alt"></i> Nama Produk</label>
                <input type="text" class="form-control @error('nama_produk') is-invalid @enderror" name="nama_produk" id="nama_produk" value="{{ old('nama_produk') }}" placeholder="Masukkan Nama Produk">
                @error('nama_produk')  <!-- Menampilkan pesan error jika ada -->
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Input untuk Stok Produk -->
            <div class="mb-3">
                <label for="stok_produk" class="form-label"><i class="fas fa-box"></i> Stok Produk</label>
                <input type="number" class="form-control @error('stok_produk') is-invalid @enderror" name="stok_produk" id="stok_produk" value="{{ old('stok_produk') }}" placeholder="Masukkan Stok Produk">
                @error('stok_produk')  <!-- Menampilkan pesan error jika ada -->
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Input untuk Satuan -->
            <div class="mb-3">
                <label for="satuan" class="form-label"><i class="fas fa-weight-hanging"></i> Satuan</label>
                <input type="text" class="form-control @error('satuan') is-invalid @enderror" name="satuan" id="satuan" value="{{ old('satuan') }}" placeholder="Masukkan Satuan">
                @error('satuan')  <!-- Menampilkan pesan error jika ada -->
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Input untuk Harga Produk -->
            <div class="mb-3">
                <label for="harga_produk" class="form-label"><i class="fas fa-money-bill-wave"></i> Harga Produk</label>
                <input type="number" class="form-control @error('harga_produk') is-invalid @enderror" name="harga_produk" id="harga_produk" value="{{ old('harga_produk') }}" placeholder="Masukkan Harga Produk">
                @error('harga_produk')  <!-- Menampilkan pesan error jika ada -->
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Input untuk Deskripsi Produk -->
            <div class="mb-3">
                <label for="deskripsi_produk" class="form-label"><i class="fas fa-info-circle"></i> Deskripsi Produk</label>
                <input type="text" class="form-control @error('deskripsi_produk') is-invalid @enderror" name="deskripsi_produk" id="deskripsi_produk" value="{{ old('deskripsi_produk') }}" placeholder="Masukkan Deskripsi Produk">
                @error('deskripsi_produk')  <!-- Menampilkan pesan error jika ada -->
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Input untuk Gambar Produk -->
            <div class="mb-3">
                <label for="gambar_produk" class="form-label"><i class="fas fa-image"></i> Gambar Produk</label>
                <input type="file" class="form-control @error('gambar_produk') is-invalid @enderror" name="gambar_produk" id="gambar_produk">
                @error('gambar_produk')  <!-- Menampilkan pesan error jika ada -->
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Tombol Submit untuk menambahkan produk -->
            <div class="mb-3">
                <button type="submit" class="btn btn-success">Tambah Produk</button>
            </div>
        </form>
    </div>
</div>

@endsection  <!-- Menutup bagian konten halaman -->
