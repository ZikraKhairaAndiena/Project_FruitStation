@extends('dashboard.layouts.main')

@section('title', 'Hasil Pencarian Produk')

@section('content')
<!-- Judul halaman hasil pencarian -->
<h1 class="mb-4">Hasil Pencarian untuk "{{ request()->input('query') }}"</h1>

<!-- Menampilkan pesan sesi jika ada, misalnya pesan peringatan -->
@if(session('pesan'))
<div class="alert alert-warning alert-dismissible fade show" role="alert">
   {{ session('pesan') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<!-- Memeriksa apakah tidak ada produk yang ditemukan -->
@if($produk->isEmpty())
    <p>Tidak ada produk yang ditemukan.</p>
@else
    <!-- Tabel untuk menampilkan hasil pencarian produk -->
    <table class="table table-striped table-bordered table-hover">
        <thead>
            <tr>
                <th>No</th>
                <th>Produk ID</th>
                <th>Kategori ID</th>
                <th>Nama Produk</th>
                <th>Stok Produk</th>
                <th>Satuan</th>
                <th>Harga Produk</th>
                <th>Deskripsi Produk</th>
                <th>Gambar Produk</th>
                <th class="text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <!-- Loop untuk menampilkan setiap produk dalam hasil pencarian -->
            @foreach ($produk as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->produk_id }}</td>
                <td>{{ $item->kategori_id }}</td>
                <td>{{ $item->nama_produk }}</td>
                <td>{{ $item->stok_produk }}</td>
                <td>{{ $item->satuan }}</td>
                <td>Rp {{ number_format($item->harga_produk, 0, ',', '.') }}</td>
                <td>{{ $item->deskripsi_produk }}</td>
                <td>
                    <!-- Menampilkan gambar produk atau teks fallback jika tidak ada gambar -->
                    @if($item->gambar_produk)
                        <img src="{{ asset('img/' . $item->gambar_produk) }}" alt="{{ $item->nama_produk }}" style="width:100px;">
                    @else
                        <p class="text-muted">No Image Available</p>
                    @endif
                </td>
                <td class="text-nowrap text-center" style="width: 120px;">
                    <!-- Tombol aksi untuk melihat, mengedit, dan menghapus produk -->
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <a href="/produk/{{ $item->id }}" title="Lihat Detail" class="btn btn-success btn-sm" style="margin-right: 5px; padding: 0.3rem 0.5rem;">
                            <i class="bi bi-eye" style="font-size: 0.8rem;"></i>
                        </a>
                        <a href="/produk/{{ $item->id }}/edit" title="Edit Data" class="btn btn-warning btn-sm" style="margin-right: 5px; padding: 0.3rem 0.5rem;">
                            <i class="bi bi-pencil" style="font-size: 0.8rem;"></i>
                        </a>
                        <!-- Form untuk menghapus produk -->
                        <form action="/produk/{{ $item->id }}" method="post" class="d-inline">
                            @method('DELETE')
                            @csrf
                            <button title="Hapus Data" class="btn btn-danger btn-sm" onclick="return confirm('Yakin akan menghapus data ini?')" style="padding: 0.3rem 0.5rem;">
                                <i class="bi bi-trash" style="font-size: 0.8rem;"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Pagination untuk menavigasi hasil pencarian -->
    <div class="d-flex justify-content-center mt-4">
        <nav aria-label="Page navigation">
            <ul class="pagination">
                <!-- Tombol halaman sebelumnya, dinonaktifkan jika berada di halaman pertama -->
                <li class="page-item {{ $produk->onFirstPage() ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ $produk->previousPageUrl() }}" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                <!-- Loop melalui halaman dan membuat link halaman -->
                @for ($i = 1; $i <= $produk->lastPage(); $i++)
                    <li class="page-item {{ ($produk->currentPage() == $i) ? 'active' : '' }}">
                        <a class="page-link" href="{{ $produk->url($i) }}">{{ $i }}</a>
                    </li>
                @endfor
                <!-- Tombol halaman berikutnya, dinonaktifkan jika berada di halaman terakhir -->
                <li class="page-item {{ $produk->hasMorePages() ? '' : 'disabled' }}">
                    <a class="page-link" href="{{ $produk->nextPageUrl() }}" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
@endif

@endsection
