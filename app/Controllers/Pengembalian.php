<?php

namespace App\Controllers;

use App\Models\PengembalianModel;
use App\Models\PeminjamanModel;

class Pengembalian extends BaseController
{
    // =========================
    // KEMBALIKAN BUKU (AUTO)
    // =========================
    public function kembali($id)
{
    $peminjamanModel = new \App\Models\PeminjamanModel();
    $pengembalianModel = new \App\Models\PengembalianModel();

    $pinjam = $peminjamanModel->find($id);

    if (!$pinjam) {
        return redirect()->back()->with('error', 'Data tidak ditemukan');
    }

    $today = date('Y-m-d');
    $tanggal_kembali = $pinjam['tanggal_kembali'];

    $denda = 0;

    if ($today > $tanggal_kembali) {
        $selisih = (strtotime($today) - strtotime($tanggal_kembali)) / 86400;
        $denda = $selisih * 1000;
    }

    // 🔥 INSERT PENGEMBALIAN
    $result = $pengembalianModel->insert([
        'id_peminjaman' => $id,
        'tanggal_kembali' => $today,
        'denda' => $denda
    ]);

    // DEBUG kalau gagal
    if (!$result) {
        dd($pengembalianModel->errors());
    }

    // update status
    $peminjamanModel->update($id, [
        'status' => 'dikembalikan'
    ]);

    return redirect()->to('/pengembalian');
}

    // =========================
    // LIST PENGEMBALIAN
    // =========================
    public function index()
{
    $model = new \App\Models\PengembalianModel();

    $data['pengembalian'] = $model
        ->select('pengembalian.*, peminjaman.id_anggota')
        ->join('peminjaman', 'peminjaman.id_peminjaman = pengembalian.id_peminjaman')
        ->findAll();

    return view('pengembalian/index', $data);
}

    // =========================
    // FORM CREATE (MANUAL RETURN)
    // =========================
    public function create()
    {
        if (session()->get('role') != 'anggota') {
            return redirect()->to('/pengembalian');
        }

        $db = \Config\Database::connect();

        $data['peminjaman'] = $db->table('peminjaman')
            ->where('status', 'dipinjam')
            ->where('id_anggota', session()->get('id'))
            ->get()
            ->getResultArray();

        return view('pengembalian/create', $data);
    }

    // =========================
    // SIMPAN MANUAL RETURN
    // =========================
    public function store()
    {
        if (session()->get('role') != 'anggota') {
            return redirect()->to('/pengembalian');
        }

        $peminjamanModel = new PeminjamanModel();
        $pengembalianModel = new PengembalianModel();

        $id_peminjaman = $this->request->getPost('id_peminjaman');

        $pinjam = $peminjamanModel->find($id_peminjaman);

        if (!$pinjam) {
            return redirect()->back();
        }

        // validasi user
        if ($pinjam['id_anggota'] != session()->get('id')) {
            return redirect()->to('/pengembalian');
        }

        $today = date('Y-m-d');
        $deadline = $pinjam['tanggal_kembali'];

        // hitung denda
        $denda = 0;
        if ($today > $deadline) {
            $selisih = (strtotime($today) - strtotime($deadline)) / 86400;
            $denda = $selisih * 1000;
        }

        // simpan pengembalian (CEK DUPLIKAT)
        $sudah = $pengembalianModel
            ->where('id_peminjaman', $id_peminjaman)
            ->first();

        if (!$sudah) {
            $pengembalianModel->insert([
                'id_peminjaman' => $id_peminjaman,
                'tanggal_dikembalikan' => $today,
                'denda' => $denda
            ]);
        }

        // FIX BUG: sebelumnya pakai $id (SALAH)
        $peminjamanModel->update($id_peminjaman, [
            'status' => 'dikembalikan'
        ]);

        return redirect()->to('/pengembalian');
    }
}
