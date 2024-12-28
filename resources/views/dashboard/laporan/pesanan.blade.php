<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pesanan</title>
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
        <h1>Laporan Pesanan Fruit Station</h1>
        <!-- Menampilkan periode laporan berdasarkan bulan dan tahun yang dipilih -->
        <p>Periode: {{ request('bulan') ? DateTime::createFromFormat('!m', request('bulan'))->format('F') : 'Semua Bulan' }} {{ request('tahun') ?? 'Semua Tahun' }}</p>
    </div>

    <!-- Tabel yang menampilkan data pesanan -->
    <table>
        <thead>
            <tr>
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
            <!-- Iterasi untuk menampilkan setiap data pesanan -->
            @foreach ($pesanans as $pesanan)
            <tr>
                <!-- Menampilkan nomor urut baris berdasarkan perulangan -->
                <td>{{ $loop->iteration }}</td>
                <!-- Menampilkan nama customer dari data pesanan -->
                <td>{{ $pesanan->user->name }}</td>
                <!-- Menampilkan ongkos kirim (ongkir) dengan format mata uang -->
                <td>Rp {{ number_format($pesanan->ongkir->tarif, 0, ',', '.') }}</td>
                <!-- Menampilkan tanggal pembelian yang diformat dalam format DD-MM-YYYY -->
                <td>{{ \Carbon\Carbon::parse($pesanan->tanggal_pembelian)->format('d-m-Y') }}</td>
                <!-- Menampilkan total pembelian dengan format mata uang -->
                <td>Rp {{ number_format($pesanan->total_pembelian, 0, ',', '.') }}</td>
                <!-- Menampilkan alamat pengiriman yang tercatat dalam data pesanan -->
                <td>{{ $pesanan->alamat_pengiriman }}</td>
                <!-- Menampilkan status pembelian dengan huruf kapital pertama -->
                <td>{{ ucfirst($pesanan->status_pembelian) }}</td>
                <!-- Menampilkan nomor resi pengiriman jika tersedia, jika tidak menampilkan 'N/A' -->
                <td>{{ $pesanan->resi_pengiriman ?? 'N/A' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
