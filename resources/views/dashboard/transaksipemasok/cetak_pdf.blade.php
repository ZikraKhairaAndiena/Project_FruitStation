<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Transaksi Pemasok</title>
    <style>
        /* Mengatur font dasar untuk halaman */
        body { font-family: Arial, sans-serif; }

        /* Mengatur tampilan tabel agar rapi */
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        table, th, td { border: 1px solid black; }
        th, td { padding: 8px; text-align: left; }

        /* Mengatur warna latar belakang untuk header tabel */
        th { background-color: #f2f2f2; }

        /* Mengatur style untuk teks header laporan */
        .header p { text-align: center; font-size: 14px; color: #555; margin: 0; }

        /* Mengatur warna dan posisi untuk judul laporan */
        h1 { text-align: center; color: #28a745; }
    </style>
</head>
<body>
    <!-- Bagian header laporan yang berisi judul dan periode laporan -->
    <div class="header">
        <h1>Laporan Transaksi Pemasok Fruit Station</h1>
        <p>Periode:
            <!-- Menampilkan bulan jika ada, jika tidak tampilkan 'Semua Bulan' -->
            {{ $bulan ? \Carbon\Carbon::createFromFormat('m', $bulan)->format('F') : 'Semua Bulan' }}
            <!-- Menampilkan tahun jika ada, jika tidak tampilkan 'Semua Tahun' -->
            {{ $tahun ?? 'Semua Tahun' }}
        </p>
    </div>

    <!-- Tabel untuk menampilkan data transaksi pemasok -->
    <table>
        <thead>
            <tr>
                <!-- Header tabel -->
                <th>No</th>
                <th>Pemasok</th>
                <th>Produk</th>
                <th>Jumlah</th>
                <th>Total Harga</th>
                <th>Tanggal Transaksi</th>
            </tr>
        </thead>
        <tbody>
            <!-- Melakukan iterasi terhadap transaksi yang ada -->
            @foreach ($transaksis as $transaksi)
            <tr>
                <!-- Menampilkan nomor urut transaksi -->
                <td>{{ $loop->iteration }}</td>
                <!-- Menampilkan nama pemasok yang terkait dengan transaksi -->
                <td>{{ $transaksi->pemasok->nama_pemasok }}</td>
                <!-- Menampilkan nama produk yang terlibat dalam transaksi -->
                <td>{{ $transaksi->produk->nama_produk }}</td>
                <!-- Menampilkan jumlah produk yang dibeli dalam transaksi -->
                <td>{{ $transaksi->jumlah }}</td>
                <!-- Menampilkan total harga yang diformat dalam mata uang Rupiah -->
                <td>{{ 'Rp ' . number_format($transaksi->total_harga, 0, ',', '.') }}</td>
                <!-- Menampilkan tanggal transaksi dengan format dd-mm-yyyy -->
                <td>{{ $transaksi->tanggal_transaksi->format('d-m-Y') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
