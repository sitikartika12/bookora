<?php

namespace App\Controllers;

use App\Models\PenarikanModel;
use App\Models\AnggotaModel;

class Penarikan extends BaseController
{
    public function buatPenarikan($id_peminjaman)
    {
        $penarikanModel = new PenarikanModel();
        $anggotaModel = new AnggotaModel();

        $userId = session()->get('id');

        // ambil alamat anggota
        $anggota = $anggotaModel
            ->where('user_id', $userId)
            ->first();

        if (!$anggota) {
            return redirect()->back()->with('error', 'Profil belum lengkap');
        }

        $penarikanModel->insert([
            'id_peminjaman' => $id_peminjaman,
            'alamat' => $anggota['alamat'],
            'biaya' => 0,
            'status' => 'menunggu',
            'tanggal_ambil' => null,
            'petugas_id' => null
        ]);

        return redirect()->back()->with('success', 'Permintaan penarikan dibuat');
    }

    public function index()
{
    $db = \Config\Database::connect();

    $penarikan = $db->table('penarikan')
        ->select('penarikan.*, users.nama')
        ->join('peminjaman', 'peminjaman.id_peminjaman = penarikan.id_peminjaman')
        ->join('users', 'users.id = peminjaman.id_anggota')
        ->get()
        ->getResultArray();

    return view('penarikan/index', [
        'penarikan' => $penarikan
    ]);
}

public function ambil($id)
{
    $penarikanModel = new \App\Models\PenarikanModel();

    $penarikanModel->update($id, [
        'status' => 'diambil',
        'tanggal_ambil' => date('Y-m-d'),
        'petugas_id' => session()->get('id')
    ]);

    return redirect()->to('/penarikan')
        ->with('success', 'Buku berhasil diambil');
}
}
