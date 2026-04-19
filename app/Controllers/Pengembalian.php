<?php

namespace App\Controllers;

use App\Models\PengembalianModel;
use App\Models\PeminjamanModel;

class Pengembalian extends BaseController
{
    public function kembali($id_peminjaman)
    {
        $peminjamanModel = new PeminjamanModel();
        $pengembalianModel = new PengembalianModel();

        // ambil data peminjaman
        $pinjam = $peminjamanModel->find($id_peminjaman);

        $tanggal_kembali = $pinjam['tanggal_kembali'];
        $today = date('Y-m-d');

        // hitung denda
        $denda = 0;

        if ($today > $tanggal_kembali) {
            $selisih = (strtotime($today) - strtotime($tanggal_kembali)) / (60*60*24);
            $denda = $selisih * 1000;
        }

        // simpan pengembalian
        $pengembalianModel->insert([
            'id_peminjaman' => $id_peminjaman,
            'tanggal_dikembalikan' => $today,
            'denda' => $denda
        ]);

        // update status peminjaman
        $peminjamanModel->update($id_peminjaman, [
            'status' => 'dikembalikan'
        ]);

        return redirect()->to('/peminjaman');
    }

    public function index()
{
    $db = \Config\Database::connect();

    $data['pengembalian'] = $db->table('pengembalian')
        ->select('pengembalian.*, peminjaman.id_peminjaman')
        ->join('peminjaman', 'peminjaman.id_peminjaman = pengembalian.id_peminjaman')
        ->get()->getResultArray();

    return view('pengembalian/index', $data);
}

public function create()
{
    if (session()->get('role') != 'anggota') {
        return redirect()->to('/pengembalian');
    }

    $db = \Config\Database::connect();

    $data['peminjaman'] = $db->table('peminjaman')
        ->where('status', 'dipinjam')
        ->where('id_anggota', session()->get('id')) // hanya milik sendiri
        ->get()->getResultArray();

    return view('pengembalian/create', $data);
}

public function store()
{
    if (session()->get('role') != 'anggota') {
        return redirect()->to('/pengembalian');
    }

    $peminjamanModel = new \App\Models\PeminjamanModel();
    $pengembalianModel = new \App\Models\PengembalianModel();

    $id_peminjaman = $this->request->getPost('id_peminjaman');

    // ambil data
    $pinjam = $peminjamanModel->find($id_peminjaman);

    // VALIDASI: hanya boleh milik sendiri
    if ($pinjam['id_anggota'] != session()->get('id')) {
        return redirect()->to('/pengembalian');
    }

    $tanggal_kembali = $pinjam['tanggal_kembali'];
    $today = date('Y-m-d');

    $denda = 0;

    if ($today > $tanggal_kembali) {
        $selisih = (strtotime($today) - strtotime($tanggal_kembali)) / (60*60*24);
        $denda = $selisih * 1000;
    }

    // simpan
    $pengembalianModel->insert([
        'id_peminjaman' => $id_peminjaman,
        'tanggal_dikembalikan' => $today,
        'denda' => $denda
    ]);

    // update status
    $peminjamanModel->update($id_peminjaman, [
        'status' => 'dikembalikan'
    ]);

    return redirect()->to('/pengembalian');
}
}
