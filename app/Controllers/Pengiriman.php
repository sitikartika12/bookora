<?php

namespace App\Controllers;

use App\Models\PengirimanModel;
use App\Models\TransaksiModel;

class Pengiriman extends BaseController
{
    public function index()
    {
        $model = new PengirimanModel();

        $data['pengiriman'] = $model
            ->select('pengiriman.*, peminjaman.id_anggota')
            ->join('peminjaman', 'peminjaman.id_peminjaman = pengiriman.id_peminjaman')
            ->findAll();

        return view('pengiriman/index', $data);
    }

    // petugas ambil tugas
    public function ambil($id)
    {
        $model = new PengirimanModel();
        $modelpeminjaman = new \App\Models\PeminjamanModel();

        $model->update($id, [
            'petugas_id' => session()->get('id'),
            'status' => 'diproses'
        ]);

        $modelpeminjaman->update($model->find($id)['id_peminjaman'], [
            'id_petugas' => session()->get('id'),
            'status' => 'diproses'
        ]);

        return redirect()->back();
    }

    // kirim
    public function kirim($id_transaksi)
{
    $transaksiModel = new TransaksiModel();

    $transaksi = $transaksiModel->find($id_transaksi);

    if (!$transaksi) {
        return redirect()->back();
    }

    $transaksiModel->update($id_transaksi, [
        'status' => 'lunas'
    ]);

    return redirect()->back()->with('success', 'Pengiriman berhasil diverifikasi');
}
    // sampai
    public function sampai($id)
    {
        $pengirimanModel = new \App\Models\PengirimanModel();
        $peminjamanModel = new \App\Models\PeminjamanModel();

        // ambil data pengiriman
        $pengiriman = $pengirimanModel->find($id);

        if (!$pengiriman) {
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }

        // update pengiriman
        $pengirimanModel->update($id, [
            'status' => 'selesai'
        ]);

        // sinkron ke peminjaman
        $peminjamanModel->update($pengiriman['id_peminjaman'], [
            'status' => 'dipinjam'
        ]);

        return redirect()->to('/pengiriman');
    }

    public function saya()
    {
        $model = new \App\Models\PengirimanModel();

        $data['pengiriman'] = $model
            ->join('peminjaman', 'peminjaman.id_peminjaman = pengiriman.id_peminjaman')
            ->where('peminjaman.id_anggota', session()->get('id'))
            ->findAll();

        return view('pengiriman/anggota', $data);
    }
}
