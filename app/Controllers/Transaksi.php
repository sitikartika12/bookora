<?php

namespace App\Controllers;

use App\Models\PeminjamanModel;
use App\Models\TransaksiModel;
use CodeIgniter\Controller;

class Transaksi extends Controller
{
    // ======================
    // INDEX TRANSAKSI
    // ======================
    public function index()
    {
        $model = new TransaksiModel();

        $data['transaksi'] = $model
            ->orderBy('id_transaksi', 'DESC')
            ->findAll();

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
    // PILIH METODE PEMBAYARAN
    // ======================
    public function pilihMetode($id_peminjaman)
    {
        $model = new TransaksiModel();

        $transaksi = $model
            ->where('id_peminjaman', $id_peminjaman)
            ->where('jenis', 'pengiriman')
            ->first();

        if (!$transaksi) {
            return redirect()->back()->with('error', 'Transaksi tidak ditemukan');
        }

        return view('transaksi/pilih_metode', [
    'transaksi' => $transaksi,
    'id_peminjaman' => $id_peminjaman
]);
    }

    // ======================
    // BAYAR TRANSAKSI
 public function bayar()
{
    $peminjamanModel = new \App\Models\PeminjamanModel();
    $transaksiModel  = new \App\Models\TransaksiModel();

    $id_peminjaman = $this->request->getPost('id_peminjaman');
    $jenis         = $this->request->getPost('jenis');
    $metode        = $this->request->getPost('metode');

    // validasi
    if (!$id_peminjaman || !$metode) {
        return redirect()->back()->with('error', 'Data tidak lengkap!');
    }

    // update status peminjaman
    $peminjamanModel->update($id_peminjaman, [
        'status' => 'diproses'
    ]);

    // simpan transaksi
    $transaksiModel->insert([
        'id_peminjaman'     => $id_peminjaman,
        'jenis'             => $jenis,
        'metode_pembayaran' => $metode,
        'status'            => 'menunggu_verifikasi'
    ]);

    return redirect()->to('/peminjaman')
        ->with('success', 'Pembayaran berhasil dikirim');
}

public function verifikasi($id)
{
    $transaksiModel  = new \App\Models\TransaksiModel();
    $peminjamanModel = new \App\Models\PeminjamanModel();

    $trx = $transaksiModel->find($id);

    if (!$trx) {
        return redirect()->back()->with('error', 'Transaksi tidak ditemukan');
    }

    // ubah status transaksi
    $transaksiModel->update($id, [
        'status' => 'lunas'
    ]);

    // ubah status peminjaman → DIANTAR
    $peminjamanModel->update($trx['id_peminjaman'], [
        'status' => 'diantar'
    ]);

    return redirect()->to('/peminjaman')
        ->with('success', 'Pembayaran berhasil diverifikasi');
}
    // ======================
    // PROSES PEMBAYARAN + UPLOAD BUKTI
    // ======================
    public function proses()
{
    $model = new TransaksiModel();
    $peminjamanModel = new PeminjamanModel();

    $id     = $this->request->getPost('id_transaksi');
    $metode = $this->request->getPost('metode');
    $file   = $this->request->getFile('bukti');

    $trx = $model->find($id);

    if (!$trx) {
        return redirect()->back()->with('error', 'Transaksi tidak ditemukan');
    }

    // ======================
    // VALIDASI + LOGIC STATUS
    // ======================
    if ($trx['jenis'] == 'denda') {

        // hanya boleh transfer / cash
        if (!in_array($metode, ['transfer', 'cash'])) {
            return redirect()->back()->with('error', 'Metode tidak valid untuk denda');
        }

        // denda: cash langsung lunas
        $status = ($metode == 'cash') ? 'lunas' : 'menunggu_verifikasi';

    } else {

        // pengiriman
        if (!in_array($metode, ['cod', 'qris', 'transfer'])) {
            return redirect()->back()->with('error', 'Metode tidak valid');
        }

        // pengiriman: COD langsung lunas
        $status = ($metode == 'cod') ? 'lunas' : 'menunggu_verifikasi';
    }

    $dataUpdate = [
        'metode_pembayaran' => $metode,
        'status'            => $status
    ];

    // ======================
    // UPLOAD BUKTI
    // ======================
    if ($file && $file->isValid() && !$file->hasMoved()) {
        $namaBaru = $file->getRandomName();
        $file->move('uploads/bukti/', $namaBaru);

        $dataUpdate['bukti_pembayaran'] = $namaBaru;
    }

    // ======================
    // UPDATE TRANSAKSI
    // ======================
    $model->update($id, $dataUpdate);

    return redirect()->to('/peminjaman')
        ->with('success', 'Pembayaran berhasil diproses');
}

    // ======================
// FORM BAYAR DENDA
// ======================
public function bayarDenda($id)
{
    $model = new TransaksiModel();

    $trx = $model->find($id);

    if (!$trx || $trx['jenis'] != 'denda') {
        return redirect()->back()->with('error', 'Data denda tidak valid');
    }

    return view('transaksi/bayar_denda', [
        'transaksi' => $trx
    ]);
}

// ======================
// PROSES BAYAR DENDA
// ======================
public function prosesDenda()
{
    $model = new TransaksiModel();

    $id     = $this->request->getPost('id_transaksi');
    $metode = $this->request->getPost('metode');
    $file   = $this->request->getFile('bukti');

    $trx = $model->find($id);

    if (!$trx || $trx['jenis'] != 'denda') {
        return redirect()->back()->with('error', 'Data tidak valid');
    }

    if (!in_array($metode, ['cash', 'transfer'])) {
        return redirect()->back()->with('error', 'Metode tidak valid');
    }

    $status = ($metode == 'cash') ? 'lunas' : 'menunggu_verifikasi';

    $data = [
        'metode_pembayaran' => $metode,
        'status' => $status
    ];

    // upload bukti kalau transfer
    if ($metode == 'transfer' && $file && $file->isValid()) {
        $nama = $file->getRandomName();
        $file->move('uploads/bukti/', $nama);
        $data['bukti_pembayaran'] = $nama;
    }

    $model->update($id, $data);

    return redirect()->to('/peminjaman')
        ->with('success', 'Pembayaran denda berhasil');
}

public function verifikasiDenda($id)
{
    $model = new TransaksiModel();

    $trx = $model->find($id);

    if (!$trx || $trx['jenis'] != 'denda') {
        return redirect()->back();
    }

    $model->update($id, [
        'status' => 'lunas'
    ]);

    return redirect()->back()->with('success', 'Denda lunas');
}
}