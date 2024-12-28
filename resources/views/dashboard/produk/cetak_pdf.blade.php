<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Menentukan karakter encoding untuk halaman -->
    <meta charset="UTF-8">
    <!-- Menentukan viewport untuk memastikan halaman responsif di perangkat mobile -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Judul halaman -->
    <title>Laporan Produk</title>
    <style>
        /* Menentukan font yang digunakan untuk seluruh halaman */
        body { font-family: Arial, sans-serif; }

        /* Menata tabel agar memenuhi lebar halaman dan memiliki jarak di atas */
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }

        /* Menambahkan border pada tabel, header, dan cell */
        table, th, td { border: 1px solid black; }

        /* Menambahkan padding pada setiap header dan cell tabel, serta meratakan teks ke kiri */
        th, td { padding: 8px; text-align: left; }

        /* Memberikan latar belakang yang lebih terang pada header tabel */
        th { background-color: #f2f2f2; }

        /* Mengatur agar judul berada di tengah dengan warna hijau */
        h1 { text-align: center; color: #28a745; }
    </style>
</head>
<body>
    <!-- Judul utama laporan yang ditampilkan di atas halaman -->
    <h1>Laporan Produk Fruit Station</h1>

    <!-- Tabel yang digunakan untuk menampilkan data produk -->
    <table>
        <thead>
            <!-- Menampilkan header tabel dengan kolom-kolom yang relevan -->
            <tr>
                <th>No</th> <!-- Kolom nomor urut -->
                <th>Produk ID</th> <!-- Kolom untuk ID produk -->
                <th>Kategori</th> <!-- Kolom untuk kategori produk -->
                <th>Nama Produk</th> <!-- Kolom untuk nama produk -->
                <th>Stok Produk</th> <!-- Kolom untuk stok produk -->
                <th>Satuan</th> <!-- Kolom untuk satuan produk -->
                <th>Harga Produk</th> <!-- Kolom untuk harga produk -->
                <th>Deskripsi Produk</th> <!-- Kolom untuk deskripsi produk -->
            </tr>
        </thead>
        <tbody>
            <!-- Looping untuk menampilkan data produk yang diteruskan ke view -->
            @foreach ($produks as $produk)
            <tr>
                <!-- Menampilkan nomor urut berdasarkan loop -->
                <td>{{ $loop->iteration }}</td>
                <!-- Menampilkan ID produk -->
                <td>{{ $produk->produk_id }}</td>
                <!-- Menampilkan kategori produk -->
                <td>{{ $produk->kategori->nama_kategori }}</td>
                <!-- Menampilkan nama produk -->
                <td>{{ $produk->nama_produk }}</td>
                <!-- Menampilkan stok produk -->
                <td>{{ $produk->stok_produk }}</td>
                <!-- Menampilkan satuan produk -->
                <td>{{ $produk->satuan }}</td>
                <!-- Menampilkan harga produk dengan format mata uang -->
                <td>Rp {{ number_format($produk->harga_produk, 0, ',', '.') }}</td>
                <!-- Menampilkan deskripsi produk -->
                <td>{{ $produk->deskripsi_produk }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
