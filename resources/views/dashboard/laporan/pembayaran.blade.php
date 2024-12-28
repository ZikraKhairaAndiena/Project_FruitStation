<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pembayaran</title>
    <style>
        /* Menetapkan font untuk seluruh halaman */
        body { font-family: Arial, sans-serif; }

        /* Menata tampilan tabel agar rapi dan mudah dibaca */
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        table, th, td { border: 1px solid black; }
        th, td { padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }

        /* Menata judul laporan agar tampil di tengah dan dengan warna hijau */
        h1 { text-align: center; color: #28a745; margin-bottom: 5px; }

        /* Menambahkan gaya pada teks header untuk menampilkan informasi periode laporan */
        .header p { text-align: center; font-size: 14px; color: #555; margin: 0; }

        /* Menata teks yang ditampilkan di bagian kanan bawah untuk total pemasukan */
        .text-right { text-align: right; margin-top: 20px; }
    </style>
</head>
<body>
    <!-- Bagian header laporan, menampilkan judul dan periode laporan -->
    <div class="header">
        <h1>Laporan Pembayaran Fruit Station</h1>
        <!-- Menampilkan periode laporan berdasarkan bulan dan tahun yang dipilih -->
        <p>Periode: {{ request('bulan') ? DateTime::createFromFormat('!m', request('bulan'))->format('F') : 'Semua Bulan' }} {{ request('tahun') ?? 'Semua Tahun' }}</p>
    </div>

    <!-- Tabel yang menampilkan data pembayaran -->
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Customer</th>
                <th>Nama Produk</th>
                <th>Nama Penyetor</th>
                <th>Bank</th>
                <th>Jumlah Pembayaran</th>
                <th>Tanggal Pembayaran</th>
                <th>Alamat Pengiriman</th>
            </tr>
        </thead>
        <tbody>
            <!-- Iterasi untuk menampilkan setiap data pembayaran -->
            @foreach ($pembayarans as $index => $pembayaran)
            <tr>
                <td>{{ $index + 1 }}</td>
                <!-- Menampilkan nama customer, jika tersedia -->
                <td>{{ $pembayaran->pembelian->user->name ?? '-' }}</td>
                <!-- Menampilkan produk yang dibeli oleh customer dalam bentuk list -->
                <td>
                    <ul>
                        @foreach ($pembayaran->pembelian->pembelianproduks as $produk)
                            <li>{{ $produk->nama_produk }} - Jumlah: {{ $produk->jumlah_produk }}</li>
                        @endforeach
                    </ul>
                </td>
                <!-- Menampilkan nama penyetor -->
                <td>{{ $pembayaran->nama_penyetor }}</td>
                <!-- Menampilkan nama bank -->
                <td>{{ $pembayaran->bank }}</td>
                <!-- Menampilkan jumlah pembayaran dalam format mata uang -->
                <td>Rp {{ number_format($pembayaran->jumlah, 0, ',', '.') }}</td>
                <!-- Menampilkan tanggal pembayaran dalam format tanggal (DD-MM-YYYY) -->
                <td>{{ \Carbon\Carbon::parse($pembayaran->tanggal)->format('d-m-Y') }}</td>
                <!-- Menampilkan alamat pengiriman, jika tersedia -->
                <td>{{ $pembayaran->pembelian->alamat_pengiriman ?? '-' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Menampilkan total pemasukan di bagian bawah tabel -->
    <div class="text-right">
        <h3>Total Pemasukan: Rp {{ number_format($total_pemasukan, 0, ',', '.') }}</h3>
    </div>
</body>
</html>
