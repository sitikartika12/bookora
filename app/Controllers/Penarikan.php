<?php

namespace App\Controllers;

use App\Models\TransaksiModel;
use CodeIgniter\Controller;

class Transaksi extends Controller
{

    // ======================
    // LIST DENDA (PETUGAS)
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
    // HALAMAN PEMBAYARAN
    // ======================
    public function bayar($id_peminjaman, $jenis)
    {
        $model = new TransaksiModel();

        $transaksi = $model
            ->where('id_peminjaman', $id_peminjaman)
            ->where('jenis', $jenis)
            ->first();

        if (!$transaksi) {
            return redirect()->to('/peminjaman')
                ->with('error', 'Transaksi tidak ditemukan');
        }

        return view('transaksi/bayar', [
            'transaksi' => $transaksi
        ]);
    }

    // ======================
    // PROSES PEMBAYARAN
    // ======================
    public function proses()
    {
        $model = new TransaksiModel();

        $id     = $this->request->getPost('id_transaksi');
        $metode = $this->request->getPost('metode');
        $file   = $this->request->getFile('bukti');

        // ======================
        // CEK TRANSAKSI
        // ======================
        $trx = $model->find($id);

        if (!$trx) {
            return redirect()->back()->with('error', 'Transaksi tidak ditemukan');
        }

        if (!$metode) {
            return redirect()->back()->with('error', 'Metode wajib dipilih');
        }

        // ======================
        // VALIDASI METODE
        // ======================
        if ($trx['jenis'] == 'denda') {

            if (!in_array($metode, ['transfer', 'cash'])) {
                return redirect()->back()->with('error', 'Metode denda hanya transfer/cash');
            }

        } else {

            if (!in_array($metode, ['cod', 'qris', 'transfer'])) {
                return redirect()->back()->with('error', 'Metode pengiriman tidak valid');
            }
        }

        // ======================
        // DATA UPDATE
        // ======================
        $dataUpdate = [
            'metode_pembayaran' => $metode,
            'status' => 'menunggu_verifikasi'
        ];

        // ======================
        // UPLOAD BUKTI (OPSIONAL)
        // ======================
        if ($file && $file->isValid() && !$file->hasMoved()) {

            $allowed = ['image/jpg', 'image/jpeg', 'image/png', 'application/pdf'];

            if (!in_array($file->getMimeType(), $allowed)) {
                return redirect()->back()->with('error', 'Format file tidak didukung');
            }

            $namaBaru = $file->getRandomName();
            $file->move('uploads/bukti/', $namaBaru);

            $dataUpdate['bukti_pembayaran'] = $namaBaru;
        }

        // ======================
        // UPDATE DB
        // ======================
        $model->update($id, $dataUpdate);

        // ======================
        // PESAN SUCCESS (BEDA DENDA & PENGIRIMAN)
        // ======================
        $label = ($trx['jenis'] == 'denda')
            ? 'Pembayaran denda berhasil dikirim'
            : 'Pembayaran pengiriman berhasil dikirim';

        return redirect()->to('/peminjaman')->with('success', $label);
    }

    // ======================
    // VERIFIKASI (PETUGAS)
    // ======================
    public function verifikasi($id)
    {
        $model = new TransaksiModel();

        $trx = $model->find($id);

        if (!$trx) {
            return redirect()->back()->with('error', 'Transaksi tidak ditemukan');
        }

        $model->update($id, [
            'status' => 'lunas'
        ]);

        $label = ($trx['jenis'] == 'denda')
            ? 'Denda sudah lunas'
            : 'Pembayaran berhasil diverifikasi';

        return redirect()->back()->with('success', $label);
    }

    // ======================
    // TOLAK
    // ======================
    public function tolak($id)
    {
        $model = new TransaksiModel();

        $trx = $model->find($id);

        if (!$trx) {
            return redirect()->back()->with('error', 'Transaksi tidak ditemukan');
        }

        $model->update($id, [
            'status' => 'ditolak'
        ]);

        return redirect()->back()->with('error', 'Pembayaran ditolak');
    }
}
