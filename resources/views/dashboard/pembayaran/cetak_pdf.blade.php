<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pembayaran</title>
    <style>
        /* Menentukan gaya font untuk seluruh tubuh halaman */
        body { font-family: Arial, sans-serif; }
        /* Mengatur lebar tabel dan jarak antar elemen dalam tabel */
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        /* Menambahkan border pada tabel dan setiap sel */
        table, th, td { border: 1px solid black; }
        /* Menambahkan padding pada setiap sel dalam tabel */
        th, td { padding: 8px; text-align: left; }
        /* Memberikan warna latar belakang pada header tabel */
        th { background-color: #f2f2f2; }
        /* Menentukan gaya teks pada judul laporan */
        h1 { text-align: center; color: #28a745; margin-bottom: 5px; }
        /* Mengatur teks header agar lebih kecil dan berwarna abu-abu */
        .header p { text-align: center; font-size: 14px; color: #555; margin: 0; }
        /* Menyusun teks kanan untuk total pemasukan */
        .text-right { text-align: right; margin-top: 20px; }
    </style>
</head>
<body>
    <!-- Bagian header laporan dengan judul dan periode laporan -->
    <div class="header">
        <h1>Laporan Pembayaran Fruit Station</h1>
        <!-- Menampilkan periode bulan dan tahun yang dipilih atau 'Semua Bulan' jika tidak ada filter -->
        <p>Periode: {{ request('bulan') ? DateTime::createFromFormat('!m', request('bulan'))->format('F') : 'Semua Bulan' }} {{ request('tahun') ?? 'Semua Tahun' }}</p>
    </div>

    <!-- Tabel yang menampilkan data laporan pembayaran -->
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
            <!-- Menampilkan setiap pembayaran yang ada -->
            @foreach ($pembayarans as $index => $pembayaran)
            <tr>
                <!-- Menampilkan nomor urut -->
                <td>{{ $index + 1 }}</td>
                <!-- Menampilkan nama customer atau '-' jika tidak ada data -->
                <td>{{ $pembayaran->pembelian->user->name ?? '-' }}</td>
                <td>
                    <!-- Menampilkan daftar produk yang dibeli dengan jumlah masing-masing -->
                    <ul>
                        @foreach ($pembayaran->pembelian->pembelianproduks as $produk)
                            <li>{{ $produk->nama_produk }} - Jumlah: {{ $produk->jumlah_produk }}</li>
                        @endforeach
                    </ul>
                </td>
                <!-- Menampilkan nama penyetor -->
                <td>{{ $pembayaran->nama_penyetor }}</td>
                <!-- Menampilkan bank tempat penyetoran -->
                <td>{{ $pembayaran->bank }}</td>
                <!-- Menampilkan jumlah pembayaran dengan format Rupiah -->
                <td>Rp {{ number_format($pembayaran->jumlah, 0, ',', '.') }}</td>
                <!-- Menampilkan tanggal pembayaran dalam format dd-mm-yyyy -->
                <td>{{ \Carbon\Carbon::parse($pembayaran->tanggal)->format('d-m-Y') }}</td>
                <!-- Menampilkan alamat pengiriman atau '-' jika tidak ada data -->
                <td>{{ $pembayaran->pembelian->alamat_pengiriman ?? '-' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Menampilkan total pemasukan di bagian bawah tabel, dengan format Rupiah -->
    <div class="text-right">
        <h3>Total Pemasukan: Rp {{ number_format($total_pemasukan, 0, ',', '.') }}</h3>
    </div>
</body>
</html>
