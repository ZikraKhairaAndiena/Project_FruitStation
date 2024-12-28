<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Mendefinisikan karakter set dan viewport untuk responsivitas -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Judul halaman -->
    <title>Laporan User</title>

    <style>
        /* Mengatur font default halaman */
        body { font-family: Arial, sans-serif; }

        /* Menata tabel agar lebar penuh dan tanpa jarak antar elemen */
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }

        /* Mengatur border tabel, header, dan cell */
        table, th, td { border: 1px solid black; }

        /* Menambah padding dan mengatur teks pada header dan cell */
        th, td { padding: 8px; text-align: left; }

        /* Memberikan warna latar belakang pada header tabel */
        th { background-color: #f2f2f2; }

        /* Menata judul halaman agar tampil di tengah dengan warna hijau */
        h1 { text-align: center; color: #28a745; }
    </style>
</head>
<body>

    <!-- Judul Laporan User -->
    <h1>Laporan User Fruit Station</h1>

    <!-- Membuat tabel untuk menampilkan data user -->
    <table>
        <thead>
            <!-- Menampilkan header tabel dengan nama kolom -->
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Role</th>
                <th>No Telepon</th>
                <th>Alamat</th>
            </tr>
        </thead>
        <tbody>
            <!-- Looping untuk setiap data user dan menampilkannya dalam baris tabel -->
            @foreach ($users as $index => $user)
            <tr>
                <!-- Menampilkan nomor urut user (dimulai dari 1) -->
                <td>{{ $index + 1 }}</td>
                <!-- Menampilkan nama user -->
                <td>{{ $user->name }}</td>
                <!-- Menampilkan email user -->
                <td>{{ $user->email }}</td>
                <!-- Menampilkan role user dengan format kapital pertama -->
                <td>{{ ucfirst($user->role) }}</td>
                <!-- Menampilkan nomor telepon user jika ada, jika tidak menampilkan tanda "-" -->
                <td>{{ $user->no_telepon ?? '-' }}</td>
                <!-- Menampilkan alamat user jika ada, jika tidak menampilkan tanda "-" -->
                <td>{{ $user->alamat ?? '-' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
