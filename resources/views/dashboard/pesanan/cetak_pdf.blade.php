<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pesanan</title>
    <style>
        body { font-family: Arial, sans-serif; } /* Menetapkan font keluarga untuk seluruh body */
        table { width: 100%; border-collapse: collapse; margin-top: 20px; } /* Mengatur tabel agar memenuhi lebar halaman dan memberi jarak atas */
        table, th, td { border: 1px solid black; } /* Menambahkan border pada tabel dan sel */
        th, td { padding: 8px; text-align: left; } /* Memberikan padding pada sel dan mengatur teks agar rata kiri */
        th { background-color: #f2f2f2; } /* Memberikan warna latar belakang pada header tabel */
        .header p { text-align: center; font-size: 14px; color: #555; margin: 0; } /* Menata teks di dalam header */
        h1 { text-align: center; color: #28a745; } /* Menata judul dengan warna hijau dan rata tengah */
    </style>
</head>
<body>

    <!-- Header Laporan -->
    <div class="header">
        <h1>Laporan Pesanan Fruit Station</h1> <!-- Judul laporan -->
        <p>Periode: {{ request('bulan') ? DateTime::createFromFormat('!m', request('bulan'))->format('F') : 'Semua Bulan' }} {{ request('tahun') ?? 'Semua Tahun' }}</p>
        <!-- Menampilkan periode laporan berdasarkan bulan dan tahun yang dipilih, jika tidak ada, menampilkan 'Semua Bulan' dan 'Semua Tahun' -->
    </div>

    <!-- Tabel untuk Menampilkan Data Pesanan -->
    <table>
        <thead>
            <tr>
                <!-- Header Tabel -->
                <th>No</th>
                <th>Customer</th>
                <th>Ongkir</th>
                <th>Tanggal Pembelian</th>
                <th>Total Pembelian</th>
                <th>Alamat Pengiriman</th>
                <th>Status Pembelian</th>
                <th>Resi Pengiriman</th>
            </tr>
        </thead>
        <tbody>
            <!-- Menampilkan Data Pesanan -->
            @foreach ($pesanans as $pesanan)
            <tr>
                <td>{{ $loop->iteration }}</td> <!-- Menampilkan nomor urut -->
                <td>{{ $pesanan->user->name }}</td> <!-- Menampilkan nama customer -->
                <td>Rp {{ number_format($pesanan->ongkir->tarif, 0, ',', '.') }}</td> <!-- Menampilkan ongkir dengan format Rupiah -->
                <td>{{ \Carbon\Carbon::parse($pesanan->tanggal_pembelian)->format('d-m-Y') }}</td> <!-- Menampilkan tanggal pembelian dengan format dd-mm-yyyy -->
                <td>Rp {{ number_format($pesanan->total_pembelian, 0, ',', '.') }}</td> <!-- Menampilkan total pembelian dengan format Rupiah -->
                <td>{{ $pesanan->alamat_pengiriman }}</td> <!-- Menampilkan alamat pengiriman -->
                <td>{{ ucfirst($pesanan->status_pembelian) }}</td> <!-- Menampilkan status pembelian dengan huruf pertama kapital -->
                <td>{{ $pesanan->resi_pengiriman ?? 'N/A' }}</td> <!-- Menampilkan resi pengiriman atau 'N/A' jika tidak ada -->
            </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
