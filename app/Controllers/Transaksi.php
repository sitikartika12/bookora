<?php

namespace App\Controllers;

use App\Models\TransaksiModel;
use CodeIgniter\Controller;

class Transaksi extends Controller
{
    // ======================
    // INDEX TRANSAKSI
    // ======================
   public function index()
{
    $model = new \App\Models\TransaksiModel();

    $data['transaksi'] = $model->orderBy('id_transaksi', 'DESC')->findAll();

    return view('transaksi/index', $data);
}
    // ======================
    // LIST DENDA
    // ======================
    public function denda()
    {
        $model = new TransaksiModel();

        $data['denda'] = $model
            ->where('jenis', 'denda')
            ->orderBy('id_transaksi', 'DESC')
            ->findAll();

        return view('transaksi/denda', $data);
    }

    // ======================
    // HALAMAN PILIH METODE
    // ======================
    public function bayar($id_peminjaman, $jenis)
    {
        $model = new TransaksiModel();

        $transaksi = $model
            ->where('id_peminjaman', $id_peminjaman)
            ->where('jenis', $jenis)
            ->first();

        if (!$transaksi) {
            return redirect()->back()->with('error', 'Transaksi tidak ditemukan');
        }

        if ($transaksi['status'] == 'lunas') {
            return redirect()->back()->with('success', 'Sudah lunas');
        }

        return view('transaksi/pilih_metode', [
            'transaksi' => $transaksi
        ]);
    }
public function verifikasi($id)
{
    $model = new \App\Models\TransaksiModel();

    $trx = $model->find($id);

    if (!$trx) {
        return redirect()->back()->with('error', 'Transaksi tidak ditemukan');
    }

    $model->update($id, [
        'status' => 'lunas'
    ]);

    return redirect()->to('/transaksi')
        ->with('success', 'Pembayaran berhasil diverifikasi');
}
  public function proses()
{
    $model = new \App\Models\TransaksiModel();
    $peminjamanModel = new \App\Models\PeminjamanModel();

    $id     = $this->request->getPost('id_transaksi');
    $metode = $this->request->getPost('metode');
    $file   = $this->request->getFile('bukti');

    $trx = $model->find($id);

    if (!$trx) {
        return redirect()->back()->with('error', 'Transaksi tidak ditemukan');
    }

    // validasi metode
    if ($trx['jenis'] == 'denda') {
        if (!in_array($metode, ['transfer', 'cash'])) {
            return redirect()->back()->with('error', 'Metode tidak valid');
        }
    } else {
        if (!in_array($metode, ['cod', 'qris', 'transfer'])) {
            return redirect()->back()->with('error', 'Metode tidak valid');
        }
    }

    $status = ($metode == 'cod') ? 'lunas' : 'menunggu_verifikasi';

    $dataUpdate = [
        'metode_pembayaran' => $metode,
        'status' => $status
    ];

    // upload bukti
    if ($file && $file->isValid() && !$file->hasMoved()) {
        $namaBaru = $file->getRandomName();
        $file->move('uploads/bukti/', $namaBaru);

        $dataUpdate['bukti_pembayaran'] = $namaBaru;
    }

    // update transaksi
    $model->update($id, $dataUpdate);

    // update peminjaman juga
    $peminjamanModel->update($trx['id_peminjaman'], [
        'status' => 'diproses_pembayaran'
    ]);

    return redirect()->to('/peminjaman')
        ->with('success', 'Pembayaran berhasil diproses');
}
}