<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Transaksi Pemasok</title>
    <style>
        /* Menetapkan font untuk seluruh halaman */
        body { font-family: Arial, sans-serif; }

        /* Menata tampilan tabel agar rapi dan mudah dibaca */
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        table, th, td { border: 1px solid black; }
        th, td { padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }

        /* Menambahkan gaya pada teks header untuk menampilkan informasi periode laporan */
        .header p { text-align: center; font-size: 14px; color: #555; margin: 0; }

        /* Menata judul laporan agar tampil di tengah dan dengan warna hijau */
        h1 { text-align: center; color: #28a745; }
    </style>
</head>
<body>

    <!-- Bagian header laporan, menampilkan judul dan periode laporan -->
    <div class="header">
        <h1>Laporan Transaksi Pemasok Fruit Station</h1>
        <!-- Menampilkan periode laporan berdasarkan bulan dan tahun yang dipilih -->
        <p>Periode:
            {{ $bulan ? \Carbon\Carbon::createFromFormat('m', $bulan)->format('F') : 'Semua Bulan' }}
            {{ $tahun ?? 'Semua Tahun' }}
        </p>
    </div>

    <!-- Tabel yang menampilkan data transaksi pemasok -->
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Pemasok</th>
                <th>Produk</th>
                <th>Jumlah</th>
                <th>Total Harga</th>
                <th>Tanggal Transaksi</th>
            </tr>
        </thead>
        <tbody>
            <!-- Iterasi untuk menampilkan setiap data transaksi pemasok -->
            @foreach ($transaksis as $transaksi)
            <tr>
                <!-- Menampilkan nomor urut baris berdasarkan perulangan -->
                <td>{{ $loop->iteration }}</td>
                <!-- Menampilkan nama pemasok dari data transaksi -->
                <td>{{ $transaksi->pemasok->nama_pemasok }}</td>
                <!-- Menampilkan nama produk yang terlibat dalam transaksi -->
                <td>{{ $transaksi->produk->nama_produk }}</td>
                <!-- Menampilkan jumlah produk yang terlibat dalam transaksi -->
                <td>{{ $transaksi->jumlah }}</td>
                <!-- Menampilkan total harga transaksi dengan format mata uang -->
                <td>{{ 'Rp ' . number_format($transaksi->total_harga, 0, ',', '.') }}</td>
                <!-- Menampilkan tanggal transaksi yang diformat dalam format DD-MM-YYYY -->
                <td>{{ $transaksi->tanggal_transaksi->format('d-m-Y') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
