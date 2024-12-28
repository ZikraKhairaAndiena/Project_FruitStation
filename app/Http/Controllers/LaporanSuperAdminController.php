<?php

namespace App\Http\Controllers;

use App\Models\Pembelian;
use App\Models\Pembayaran;
use App\Models\TransaksiPemasok;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Carbon\Carbon;

class LaporanSuperAdminController extends Controller
{
    /**
     * Method untuk menghasilkan laporan Pesanan dengan filter bulan dan tahun.
     */
    public function cetakPesanan(Request $request)
    {
        // Mendapatkan nilai bulan dan tahun dari request
        $bulan = $request->get('bulan');
        $tahun = $request->get('tahun');

        // Query model Pembelian dan menerapkan filter jika ada
        $pesanans = Pembelian::query();

        // Jika ada filter bulan, maka ditambahkan ke query
        if ($bulan) {
            $pesanans = $pesanans->whereMonth('tanggal_pembelian', $bulan);
        }

        // Jika ada filter tahun, maka ditambahkan ke query
        if ($tahun) {
            $pesanans = $pesanans->whereYear('tanggal_pembelian', $tahun);
        }

        // Mengambil data yang sudah difilter
        $pesanans = $pesanans->get();

        // Menghasilkan PDF menggunakan data yang sudah difilter dan melewatkan bulan dan tahun
        $pdf = Pdf::loadView('dashboard.laporan.pesanan', compact('pesanans', 'bulan', 'tahun'));

        // Menampilkan PDF yang sudah dihasilkan ke browser dengan nama 'laporan-pesanan.pdf'
        return $pdf->stream('laporan-pesanan.pdf');
    }

    /**
     * Method untuk menghasilkan laporan Pembayaran dengan filter bulan dan tahun.
     */
    public function cetakPembayaran(Request $request)
    {
        // Mendapatkan nilai bulan dan tahun dari request
        $bulan = $request->input('bulan');
        $tahun = $request->input('tahun');

        // Filter data berdasarkan bulan dan tahun yang diterima
        $query = Pembayaran::query();

        // Jika ada filter bulan, maka ditambahkan ke query
        if ($bulan) {
            $query->whereMonth('tanggal', $bulan);
        }

        // Jika ada filter tahun, maka ditambahkan ke query
        if ($tahun) {
            $query->whereYear('tanggal', $tahun);
        }

        // Mengambil data pembayaran yang sudah difilter
        $pembayarans = $query->get();

        // Menghitung total pemasukan dari pembayaran
        $total_pemasukan = $pembayarans->sum('jumlah'); // Menjumlahkan kolom 'jumlah' untuk total pemasukan

        // Menghasilkan PDF menggunakan data pembayaran yang sudah difilter dan total pemasukan
        $pdf = Pdf::loadView('dashboard.laporan.pembayaran', compact('pembayarans', 'total_pemasukan', 'bulan', 'tahun'));

        // Menampilkan PDF yang sudah dihasilkan ke browser dengan nama 'laporan-pembayaran.pdf'
        return $pdf->stream('laporan-pembayaran.pdf');
    }

    /**
     * Method untuk menghasilkan laporan Transaksi Pemasok dengan filter bulan dan tahun.
     */
    public function cetakTransaksiPemasok(Request $request)
    {
        // Mendapatkan nilai bulan dan tahun dari request
        $bulan = $request->get('bulan');
        $tahun = $request->get('tahun');

        // Query model TransaksiPemasok dan mengambil relasi dengan 'pemasok' dan 'produk'
        $transaksis = TransaksiPemasok::with('pemasok', 'produk');

        // Jika ada filter bulan, maka ditambahkan ke query
        if ($bulan) {
            $transaksis = $transaksis->whereMonth('tanggal_transaksi', $bulan);
        }

        // Jika ada filter tahun, maka ditambahkan ke query
        if ($tahun) {
            $transaksis = $transaksis->whereYear('tanggal_transaksi', $tahun);
        }

        // Mengambil data transaksi pemasok yang sudah difilter
        $transaksis = $transaksis->get();

        // Menghasilkan PDF menggunakan data transaksi yang sudah difilter
        $pdf = Pdf::loadView('dashboard.laporan.transaksi_pemasok', compact('transaksis', 'bulan', 'tahun'));

        // Menampilkan PDF yang sudah dihasilkan ke browser dengan nama 'laporan-transaksi-pemasok.pdf'
        return $pdf->stream('laporan-transaksi-pemasok.pdf');
    }
}
