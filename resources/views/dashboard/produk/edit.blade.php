@extends('dashboard.layouts.main')

@section('content')

<!-- Bagian untuk heading halaman -->
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Edit Data Produk</h1>
</div>

<!-- Form untuk mengedit detail produk -->
<div class="row">
    <div class="col-lg-8 col-md-10 col-sm-12 mx-auto">
        <!-- Memulai form, menggunakan metode PUT untuk memperbarui data -->
        <form action="/produk/{{ $produk->id }}" method="post" enctype="multipart/form-data" class="p-4 border rounded shadow-sm bg-light">
            <!-- Spoofing metode PUT untuk permintaan update (memperbarui data) -->
            @method('PUT')
            <!-- CSRF token untuk keamanan -->
            @csrf

            <!-- Input untuk Produk ID -->
            <div class="mb-3">
                <label for="produk_id" class="form-label"><i class="fas fa-tag"></i> Produk ID</label>
                <!-- Jika validasi gagal, tandai kolom ini sebagai invalid dan tampilkan pesan error -->
                <input type="text" class="form-control @error('produk_id') is-invalid @enderror" name="produk_id" id="produk_id" value="{{ old('produk_id', $produk->produk_id) }}" placeholder="Masukkan Produk ID">
                @error('produk_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Dropdown untuk memilih Kategori ID -->
            <div class="mb-3">
                <label class="form-label"><i class="fas fa-list-alt"></i> Kategori ID</label>
                <select name="kategori_id" class="form-select @error('kategori_id') is-invalid @enderror">
                    <option value="">Pilih kategori</option>
                    <!-- Looping kategori dan menandai kategori yang dipilih -->
                    @foreach ($kategoris as $datakategori)
                        @if (old('kategori_id', $produk->kategori_id) == $datakategori->id)
                            <option value="{{ $datakategori->id }}" selected>{{ $datakategori->nama_kategori }}</option>
                        @else
                            <option value="{{ $datakategori->id }}">{{ $datakategori->nama_kategori }}</option>
                        @endif
                    @endforeach
                </select>
                @error('kategori_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Input untuk Nama Produk -->
            <div class="mb-3">
                <label for="nama_produk" class="form-label"><i class="fas fa-apple-alt"></i> Nama Produk</label>
                <!-- Jika validasi gagal, tandai kolom ini sebagai invalid dan tampilkan pesan error -->
                <input type="text" class="form-control @error('nama_produk') is-invalid @enderror" name="nama_produk" id="nama_produk" value="{{ old('nama_produk', $produk->nama_produk) }}" placeholder="Masukkan Nama Produk">
                @error('nama_produk')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Input untuk Stok Produk -->
            <div class="mb-3">
                <label for="stok_produk" class="form-label"><i class="fas fa-box"></i> Stok Produk</label>
                <!-- Jika validasi gagal, tandai kolom ini sebagai invalid dan tampilkan pesan error -->
                <input type="number" class="form-control @error('stok_produk') is-invalid @enderror" name="stok_produk" id="stok_produk" value="{{ old('stok_produk', $produk->stok_produk) }}" placeholder="Masukkan Stok Produk">
                @error('stok_produk')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Input untuk Satuan Produk -->
            <div class="mb-3">
                <label for="satuan" class="form-label"><i class="fas fa-weight-hanging"></i> Satuan</label>
                <!-- Jika validasi gagal, tandai kolom ini sebagai invalid dan tampilkan pesan error -->
                <input type="text" class="form-control @error('satuan') is-invalid @enderror" name="satuan" id="satuan" value="{{ old('satuan', $produk->satuan) }}" placeholder="Masukkan Satuan">
                @error('satuan')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Input untuk Harga Produk -->
            <div class="mb-3">
                <label for="harga_produk" class="form-label"><i class="fas fa-money-bill-wave"></i> Harga Produk</label>
                <!-- Jika validasi gagal, tandai kolom ini sebagai invalid dan tampilkan pesan error -->
                <input type="number" class="form-control @error('harga_produk') is-invalid @enderror" name="harga_produk" id="harga_produk" value="{{ old('harga_produk', $produk->harga_produk) }}" placeholder="Masukkan Harga Produk">
                @error('harga_produk')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Input untuk Deskripsi Produk -->
            <div class="mb-3">
                <label for="deskripsi_produk" class="form-label"><i class="fas fa-info-circle"></i> Deskripsi Produk</label>
                <!-- Jika validasi gagal, tandai kolom ini sebagai invalid dan tampilkan pesan error -->
                <input type="text" class="form-control @error('deskripsi_produk') is-invalid @enderror" name="deskripsi_produk" id="deskripsi_produk" value="{{ old('deskripsi_produk', $produk->deskripsi_produk) }}" placeholder="Masukkan Deskripsi Produk">
                @error('deskripsi_produk')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Input untuk Gambar Produk -->
            <div class="mb-3">
                <label for="gambar_produk" class="form-label"><i class="fas fa-image"></i> Gambar Produk</label>

                <!-- Menampilkan gambar lama jika ada -->
                @if($produk->gambar_produk)
                    <div>
                        <img src="{{ asset('img/' . $produk->gambar_produk) }}" alt="Gambar Produk" width="100">
                    </div>
                @endif

                <!-- Input untuk mengganti gambar -->
                <input type="file" class="form-control @error('gambar_produk') is-invalid @enderror" name="gambar_produk" id="gambar_produk">
                @error('gambar_produk')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Tombol untuk submit form -->
            <div class="mb-3">
                <button type="submit" class="btn btn-success">Perbarui Produk</button>
            </div>
        </form>
    </div>
</div>

@endsection
