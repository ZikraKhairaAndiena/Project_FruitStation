<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Daftar Pemasok</title>
    <style>
        /* Menetapkan font untuk seluruh halaman */
        body { font-family: Arial, sans-serif; }

        /* Menata tampilan tabel agar rapi dan mudah dibaca */
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        table, th, td { border: 1px solid black; }
        th, td { padding: 8px; text-align: left; }

        /* Menambahkan latar belakang abu-abu muda untuk header kolom */
        th { background-color: #f2f2f2; }

        /* Menata judul laporan agar tampil di tengah dan dengan warna hijau */
        h1 { text-align: center; color: #28a745; }
    </style>
</head>
<body>

    <!-- Judul laporan ditampilkan di tengah halaman dengan warna hijau -->
    <h1 class="text-center">Laporan Pemasok Fruit Station</h1>

    <!-- Tabel yang menampilkan data daftar pemasok -->
    <table class="table">
        <thead>
            <tr>
                <!-- Header tabel yang menampilkan nama kolom -->
                <th>No</th>
                <th>Nama</th>
                <th>No Telepon</th>
                <th>No Rekening</th>
                <th>Alamat</th>
            </tr>
        </thead>
        <tbody>
            <!-- Mengulang data pemasok untuk menampilkan setiap pemasok dalam baris tabel -->
            @foreach ($pemasoks as $pemasok)
            <tr>
                <!-- Menampilkan nomor urut berdasarkan perulangan -->
                <td>{{ $loop->iteration }}</td>
                <!-- Menampilkan nama pemasok dari data pemasok -->
                <td>{{ $pemasok->nama_pemasok }}</td>
                <!-- Menampilkan nomor telepon pemasok, atau tanda '-' jika tidak ada -->
                <td>{{ $pemasok->no_telepon ?? '-' }}</td>
                <!-- Menampilkan nomor rekening pemasok, atau tanda '-' jika tidak ada -->
                <td>{{ $pemasok->no_rekening ?? '-' }}</td>
                <!-- Menampilkan alamat pemasok, atau tanda '-' jika tidak ada -->
                <td>{{ $pemasok->alamat ?? '-' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
