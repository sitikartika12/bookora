<?php

namespace App\Controllers;

use App\Models\PeminjamanModel;
use App\Models\PengembalianModel;
use App\Models\BukuModel;
use App\Models\UsersModel;


class Home extends BaseController
{
    public function index()
{
    $peminjamanModel = new PeminjamanModel();
    $pengembalianModel = new PengembalianModel();
    $bukuModel = new BukuModel();
    $usersModel = new UsersModel();

    // =========================
    // STATISTIK UTAMA
    // =========================
    $dipinjam = $peminjamanModel->countAll();
    $dikembalikan = $pengembalianModel->countAll();
    $sisa = $dipinjam - $dikembalikan;

    $total_buku = $bukuModel->countAll();
    $total_user = $usersModel->countAll();

    $aktif = $peminjamanModel
        ->where('status', 'dipinjam')
        ->countAllResults();

    // =========================
    // BUKU TERBARU
    // =========================
    $buku = $bukuModel
        ->orderBy('id_buku', 'DESC')
        ->limit(5)
        ->findAll();

    // =========================
    // AKTIVITAS TERBARU
    // =========================
    $aktivitas = $peminjamanModel
        ->select('tanggal_pinjam as tanggal, status')
        ->orderBy('tanggal_pinjam', 'DESC')
        ->limit(5)
        ->findAll();

    // format biar enak dibaca di view
    foreach ($aktivitas as &$a) {
        $a['keterangan'] = "Status peminjaman: " . $a['status'];
    }

    // =========================
    // NOTIFIKASI
    // =========================
    $telat = $peminjamanModel
        ->where('status', 'dipinjam')
        ->findAll();

    // kalau kamu punya tabel transaksi/denda nanti bisa ditambah
    $denda = []; // sementara kosong biar aman

    return view('layouts/dashboard', [
        'dipinjam' => $dipinjam,
        'dikembalikan' => $dikembalikan,
        'sisa' => $sisa,

        'total_buku' => $total_buku,
        'total_user' => $total_user,
        'aktif' => $aktif,

        'buku' => $buku,
        'aktivitas' => $aktivitas,
        'telat' => $telat,
        'denda' => $denda,
    ]);
}
}