<?php

namespace App\Controllers;

use App\Models\PeminjamanModel;
use App\Models\TransaksiModel;

class Dashboard extends BaseController
{
    public function index()
    {
        $peminjaman = new PeminjamanModel();
        $transaksi  = new TransaksiModel();

        // ======================
        // 📚 DATA PEMINJAMAN
        // ======================

        // jumlah yang sedang dipinjam
        $dipinjam = $peminjaman
            ->where('status', 'dipinjam')
            ->countAllResults();

        // jumlah yang sudah selesai
        $dikembalikan = $peminjaman
            ->where('status', 'selesai')
            ->countAllResults();

        // sisa
        $sisa = $dipinjam - $dikembalikan;

        // ======================
        // 💰 DATA KEUANGAN
        // ======================

        // total saldo dari transaksi lunas
        $saldo = $transaksi
            ->where('status', 'lunas')
            ->selectSum('jumlah')
            ->first();

        $totalSaldo = $saldo['jumlah'] ?? 0;

        // ======================
        // 🧾 TRANSAKSI TERBARU
        // ======================

        $transaksiTerbaru = $transaksi
            ->orderBy('id_transaksi', 'DESC')
            ->limit(5)
            ->findAll();

        // ======================
        // 📊 DATA BULANAN (SIMPLE)
        // ======================

        $bulanan = $peminjaman
            ->select("MONTH(tanggal_pinjam) as bulan, COUNT(*) as total")
            ->groupBy("MONTH(tanggal_pinjam)")
            ->findAll();

        // ======================
        // 🟢 KESEHATAN SISTEM (SIMPLE)
        // ======================

        $kesehatan = 85; // nanti bisa kamu kembangkan

        // ======================
        // KIRIM KE VIEW
        // ======================

        return view('dashboard', [
            'dipinjam' => $dipinjam,
            'dikembalikan' => $dikembalikan,
            'sisa' => $sisa,
            'totalSaldo' => $totalSaldo,
            'transaksiTerbaru' => $transaksiTerbaru,
            'bulanan' => $bulanan,
            'kesehatan' => $kesehatan
        ]);
    }
}