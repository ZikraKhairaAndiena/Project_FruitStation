<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Metadata untuk pengaturan karakter dan tampilan responsif -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Promosi</title>
    <style>
        /* Pengaturan gaya untuk elemen-elemen di dalam body */
        body { font-family: Arial, sans-serif; }

        /* Pengaturan gaya untuk tabel */
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }

        /* Pengaturan border untuk tabel, th dan td */
        table, th, td { border: 1px solid black; }

        /* Pengaturan padding dan penataan teks untuk th dan td */
        th, td { padding: 8px; text-align: left; }

        /* Pengaturan warna latar belakang untuk th */
        th { background-color: #f2f2f2; }

        /* Pengaturan gaya untuk judul halaman */
        h1 { text-align: center; color: #28a745; }
    </style>
</head>
<body>
    <!-- Judul utama Laporan Promosi -->
    <h1>Laporan Promosi Fruit Station</h1>

    <!-- Tabel untuk menampilkan data promosi -->
    <table>
        <thead>
            <tr>
                <!-- Header tabel dengan kolom-kolom informasi promosi -->
                <th>No</th>
                <th>Nama Produk</th>
                <th>Deskripsi</th>
                <th>Jumlah Minimum</th>
                <th>Persentase Diskon</th>
                <th>Tanggal Mulai</th>
                <th>Tanggal Berakhir</th>
            </tr>
        </thead>
        <tbody>
            <!-- Loop untuk menampilkan data promosi yang ada -->
            @foreach ($promosis as $index => $promosi)
            <tr>
                <!-- Menampilkan nomor urut -->
                <td>{{ $index + 1 }}</td>

                <!-- Menampilkan nama produk, jika tidak ada produk maka tampilkan 'Semua Produk' -->
                <td>{{ $promosi->produk_id ? $promosi->produk->nama_produk : 'Semua Produk' }}</td>

                <!-- Menampilkan deskripsi promosi -->
                <td>{{ $promosi->description }}</td>

                <!-- Menampilkan jumlah minimum produk yang diperlukan, jika tidak ada tampilkan '-' -->
                <td>{{ $promosi->quantity_required ?? '-' }}</td>

                <!-- Menampilkan persentase diskon -->
                <td>{{ $promosi->discount_percentage }}%</td>

                <!-- Menampilkan tanggal mulai promosi dalam format 'd-m-Y' -->
                <td>{{ \Carbon\Carbon::parse($promosi->start_date)->format('d-m-Y') }}</td>

                <!-- Menampilkan tanggal berakhir promosi dalam format 'd-m-Y' -->
                <td>{{ \Carbon\Carbon::parse($promosi->end_date)->format('d-m-Y') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
