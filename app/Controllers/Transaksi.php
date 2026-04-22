<?php

namespace App\Controllers;

use App\Models\TransaksiModel;
use CodeIgniter\Controller;

class Transaksi extends Controller
{
    // ======================
    // HALAMAN PEMBAYARAN
    // ======================
    public function bayar($id_peminjaman)
    {
        $transaksiModel = new TransaksiModel();

        $transaksi = $transaksiModel
            ->where('id_peminjaman', $id_peminjaman)
            ->first();

        if (!$transaksi) {
            return redirect()->back()->with('error', 'Transaksi tidak ditemukan');
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
        $transaksiModel = new TransaksiModel();

        $id_transaksi = $this->request->getPost('id_transaksi');
        $metode       = $this->request->getPost('metode');

        if (!$id_transaksi || !$metode) {
            return redirect()->back()->with('error', 'Data tidak lengkap');
        }

        // LOGIKA PEMBAYARAN
        if ($metode == 'cod') {
            $status = 'lunas';
        } else {
            $status = 'belum_bayar'; // nunggu konfirmasi
        }

        $transaksiModel->update($id_transaksi, [
            'metode_pembayaran' => $metode,
            'status' => $status
        ]);

        return redirect()->to('/peminjaman')
            ->with('success', 'Metode pembayaran berhasil dipilih');
    }
}