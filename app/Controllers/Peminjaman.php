<?php

namespace App\Controllers;

use App\Models\PeminjamanModel;
use App\Models\UsersModel;
use App\Models\DetailPeminjamanModel;
use App\Models\BukuModel;

class Peminjaman extends BaseController
{
    protected $peminjaman;
    protected $users;

    public function __construct()
    {
        $this->peminjaman = new PeminjamanModel();
        $this->users = new UsersModel();
    }

    // ================= LIST =================
 public function index()
{
    $role = session()->get('role');
    $id   = session()->get('id');

    $query = $this->peminjaman
        ->select('
            peminjaman.*,
            anggota.nama as nama_anggota,
            petugas.nama as nama_petugas
        ')
        ->join('users as anggota', 'anggota.id = peminjaman.id_anggota', 'left')
        ->join('users as petugas', 'petugas.id = peminjaman.id_petugas', 'left')
        ->orderBy('peminjaman.id_peminjaman', 'DESC');

    if ($role == 'anggota') {
        $query->where('peminjaman.id_anggota', $id);
    }

    $data['peminjaman'] = $query->findAll();

    $transaksiModel = new \App\Models\TransaksiModel();

foreach ($data['peminjaman'] as &$p) {

    $trx = $transaksiModel
        ->where('id_peminjaman', $p['id_peminjaman'])
        ->first();

    $p['status_pembayaran']  = $trx['status'] ?? null;
    $p['metode_pembayaran'] = $trx['metode_pembayaran'] ?? null;
    $p['bukti_pembayaran']  = $trx['bukti_pembayaran'] ?? null;
    $p['id_transaksi']      = $trx['id_transaksi'] ?? null;
}

    // =========================
    // 🔔 NOTIFIKASI DENDA PETUGAS
    // =========================
    $data['notifDenda'] = [];

    if ($role == 'petugas') {
        $data['notifDenda'] = $transaksiModel
            ->where('jenis', 'denda')
            ->where('status', 'menunggu_verifikasi')
            ->findAll();
    }

    // =========================
    // HITUNG DENDA
    // =========================
    foreach ($data['peminjaman'] as &$p) {

        $today = date('Y-m-d');

        $p['status_display'] = $p['status'];
        $p['denda'] = 0;
        $p['status_denda'] = '-';

        if (!empty($p['tanggal_kembali']) && $p['status'] != 'dikembalikan') {

            if ($today > $p['tanggal_kembali']) {

                $selisih = (strtotime($today) - strtotime($p['tanggal_kembali'])) / 86400;
                $denda = $selisih * 1000;

                $p['status_display'] = 'TELAT';
                $p['denda'] = $denda;

                // =========================
                // CEK / INSERT DENDA
                // =========================
                $cek = $transaksiModel
                    ->where('id_peminjaman', $p['id_peminjaman'])
                    ->where('jenis', 'denda')
                    ->first();

                if (!$cek) {
                    $transaksiModel->insert([
                        'id_peminjaman' => $p['id_peminjaman'],
                        'jenis' => 'denda',
                        'jumlah' => $denda,
                        'status' => 'menunggu_verifikasi',
                        'metode_pembayaran' => null
                    ]);

                    $p['status_denda'] = 'menunggu_verifikasi';
                } else {
                    $p['status_denda'] = $cek['status'];
                }

            } else {
                $p['status_denda'] = 'tidak_ada';
            }

        } else {
            $p['status_denda'] = 'tidak_ada';
        }
    }

    // ✅ INI YANG KAMU LUPA
    return view('peminjaman/index', $data);
}
    // ================= FORM =================
    public function create()
    {
        $usersModel = new UsersModel();
        $bukuModel = new BukuModel();

        $data = [
            'petugas' => $usersModel->where('role', 'petugas')->findAll(),
            'anggota' => $usersModel->where('role', 'anggota')->findAll(),
            'buku'    => $bukuModel->findAll(),
        ];

        return view('peminjaman/create', $data);
    }

    public function store()
{
    $peminjamanModel = new \App\Models\PeminjamanModel();
    $detailModel     = new \App\Models\DetailPeminjamanModel();
    $bukuModel       = new \App\Models\BukuModel();
    $anggotaModel    = new \App\Models\AnggotaModel();
    $pengirimanModel = new \App\Models\PengirimanModel();
    $transaksiModel  = new \App\Models\TransaksiModel();

    // ======================
    // USER LOGIN
    // ======================
    $userId = session()->get('id');

    // ======================
    // AMBIL DATA ANGGOTA
    // ======================
    $anggota = $anggotaModel->where('user_id', $userId)->first();

    if (
        !$anggota ||
        empty($anggota['nisn']) ||
        empty($anggota['alamat']) ||
        empty($anggota['no_hp'])
    ) {
        return redirect()->to('/anggota/profil')
            ->with('error', 'Lengkapi profil terlebih dahulu!');
    }

    // ======================
    // METODE PINJAM
    // ======================
    $metode = $this->request->getPost('metode');

    if (!$metode) {
        return redirect()->back()->with('error', 'Pilih metode peminjaman!');
    }

    // ======================
    // AMBIL DATA BUKU (PINDAH KE ATAS BIAR AMAN)
    // ======================
    $id_buku_list = $this->request->getPost('id_buku');
    $jumlah_list  = $this->request->getPost('jumlah');

    if (!$id_buku_list) {
        return redirect()->back()->with('error', 'Pilih buku dulu!');
    }

    // ======================
    // SIMPAN PEMINJAMAN
    // ======================
    $biaya = ($metode == 'antar') ? 10000 : 0;

    $id_peminjaman = $peminjamanModel->insert([
        'id_anggota' => $userId,
        'id_petugas' => null,
        'tanggal_pinjam' => date('Y-m-d'),
        'tanggal_kembali' => date('Y-m-d', strtotime('+7 days')),
        'status' => ($metode == 'antar') ? 'menunggu' : 'dipinjam',
        'metode' => $metode,
        'alamat' => ($metode == 'antar') ? $anggota['alamat'] : null
    ]);

    if (!$id_peminjaman) {
        dd($peminjamanModel->errors());
    }

    // ======================
    // JIKA ANTAR → TRANSAKSI + PENGIRIMAN
    // ======================
    if ($metode == 'antar') {

        $pengirimanModel->insert([
            'id_peminjaman' => $id_peminjaman,
            'alamat' => $anggota['alamat'],
            'biaya' => $biaya,
            'status' => 'menunggu',
            'petugas_id' => null
        ]);

        $transaksiModel->insert([
            'id_peminjaman' => $id_peminjaman,
            'jenis' => 'pengiriman',
            'jumlah' => $biaya,
            'status' => 'belum_bayar'
        ]);
    }

    // ======================
    // SIMPAN DETAIL + UPDATE STOK
    // ======================
    foreach ($id_buku_list as $key => $id_buku) {

        $jumlah = $jumlah_list[$key] ?? 1;

        $buku = $bukuModel->find($id_buku);

        if (!$buku) continue;

        if ($buku['tersedia'] < $jumlah) {
            return redirect()->back()
                ->with('error', 'Stok buku tidak cukup: ' . $buku['judul']);
        }

        $detailModel->insert([
            'id_peminjaman' => $id_peminjaman,
            'id_buku' => $id_buku,
            'jumlah' => $jumlah
        ]);

        $bukuModel->update($id_buku, [
            'tersedia' => $buku['tersedia'] - $jumlah
        ]);
    }

    return redirect()->to('/peminjaman')
        ->with('success', 'Peminjaman + transaksi berhasil dibuat');
}

    public function ajukanKembali($id_peminjaman)
{
    $peminjamanModel = new \App\Models\PeminjamanModel();
    $transaksiModel  = new \App\Models\TransaksiModel();

    $peminjaman = $peminjamanModel->find($id_peminjaman);

    if (!$peminjaman) {
        return redirect()->back()->with('error', 'Data tidak ditemukan');
    }

    // CEK DENDA
    $denda = $peminjaman['denda'] ?? 0;

    if ($denda > 0) {

        // cari transaksi denda
        $transaksi = $transaksiModel
            ->where('id_peminjaman', $id_peminjaman)
            ->where('jenis', 'denda')
            ->first();

        if ($transaksi && $transaksi['status'] != 'lunas') {

            // 🚨 paksa ke halaman bayar denda
            return redirect()->to(
                base_url('transaksi/bayar/'.$id_peminjaman.'/denda')
            )->with('error', 'Harap selesaikan pembayaran denda terlebih dahulu');
        }
    }

    // kalau tidak ada denda / sudah lunas
    $peminjamanModel->update($id_peminjaman, [
        'status' => 'menunggu_pengembalian'
    ]);

    return redirect()->back()->with('success', 'Pengembalian diajukan');
}

public function konfirmasiPerpanjangan($id)
{
    $pinjam = $this->peminjaman->find($id);

    // contoh: tambah 3 hari
    $tanggalBaru = date('Y-m-d', strtotime($pinjam['tanggal_kembali'] . ' +3 days'));

    $this->peminjaman->update($id, [
        'status' => 'diperpanjang',
        'tanggal_kembali' => $tanggalBaru
    ]);

    return redirect()->to('/peminjaman')->with('success', 'Perpanjangan berhasil diverifikasi');
}

  public function konfirmasiKembali($id)
{
    $peminjamanModel = new \App\Models\PeminjamanModel();
    $pengembalianModel = new \App\Models\PengembalianModel();

    $p = $peminjamanModel->find($id);

    if (!$p) {
        return redirect()->back();
    }

    // 1. update status peminjaman
    $peminjamanModel->update($id, [
        'status' => 'dikembalikan'
    ]);

    // 2. INSERT ke tabel pengembalian
    $pengembalianModel->insert([
        'id_peminjaman' => $id,
        'tanggal_kembali' => date('Y-m-d'),
        'status' => 'selesai'
    ]);

    return redirect()->to('/pengembalian')
        ->with('success', 'Buku berhasil dikembalikan');
}


  public function bayar($id_peminjaman, $jenis)
{
   $transaksiModel = new \App\Models\TransaksiModel();

foreach ($data['peminjaman'] as &$p) {
    $p['transaksi'] = $transaksiModel
        ->where('id_peminjaman', $p['id_peminjaman'])
        ->findAll();
}
    if (!$transaksi) {
        return redirect()->back()->with('error', 'Transaksi tidak ditemukan');
    }

    return view('transaksi/bayar', [
        'transaksi' => $transaksi
    ]);
}

public function proses()
{
    $transaksiModel = new \App\Models\TransaksiModel();

    $id_transaksi = $this->request->getPost('id_transaksi');
    $metode       = $this->request->getPost('metode');

    $transaksi = $transaksiModel->find($id_transaksi);

    if (!$transaksi) {
        return redirect()->back()->with('error', 'Data tidak ditemukan');
    }

    // ❗ KHUSUS DENDA HANYA TRANSFER / CASH
    if ($transaksi['jenis'] == 'denda') {

        if (!in_array($metode, ['transfer', 'cash'])) {
            return redirect()->back()->with('error', 'Metode denda hanya transfer atau cash');
        }

        $status = 'lunas';
    }

    // ❗ PENGIRIMAN
    else {
        $status = ($metode == 'cod') ? 'lunas' : 'menunggu_verifikasi';
    }

    $transaksiModel->update($id_transaksi, [
        'metode_pembayaran' => $metode,
        'status' => $status
    ]);

    return redirect()->to('/peminjaman')
        ->with('success', 'Pembayaran berhasil');
}
    // ================= DETAIL =================
    public function detail($id)
{
    $db = \Config\Database::connect();

    // ========================
    // PEMINJAMAN
    // ========================
    $peminjaman = $db->table('peminjaman')
        ->select('peminjaman.*, users.nama as nama_anggota')
        ->join('users', 'users.id = peminjaman.id_anggota', 'left')
        ->where('peminjaman.id_peminjaman', $id)
        ->get()
        ->getRowArray();

    // DETAIL BUKU
    // ========================
    $detail = $db->table('detail_peminjaman')
        ->select('detail_peminjaman.*, buku.judul')
        ->join('buku', 'buku.id_buku = detail_peminjaman.id_buku', 'left')
        ->where('detail_peminjaman.id_peminjaman', $id)
        ->get()
        ->getResultArray();

    // ========================
    // TRANSAKSI
    // ========================
    $transaksi = $db->table('transaksi')
        ->where('id_peminjaman', $id)
        ->get()
        ->getResultArray();

    // ========================
    // PENARIKAN
    // ========================
    $penarikan = $db->table('penarikan')
        ->where('id_peminjaman', $id)
        ->get()
        ->getRowArray();

    // ========================
    // KIRIM KE VIEW (FIXED)
    // ========================
    return view('peminjaman/detail', [
        'peminjaman' => $peminjaman,
        'detail'     => $detail,
        'transaksi'  => $transaksi,
        'penarikan'  => $penarikan
    ]);
}
public function verifikasi($id)
{
    $model = new \App\Models\TransaksiModel();
    $peminjamanModel = new \App\Models\PeminjamanModel();

    // ambil data transaksi dulu
    $trx = $model->find($id);

    if (!$trx) {
        return redirect()->back()->with('error', 'Transaksi tidak ditemukan');
    }

    // update transaksi jadi lunas
    $model->update($id, [
        'status' => 'lunas'
    ]);

    // 🔥 update peminjaman juga
    $peminjamanModel->update($trx['id_peminjaman'], [
        'status' => 'dikembalikan'
    ]);

    return redirect()->back()->with('success', 'Berhasil diverifikasi & status diperbarui');
}
    // ================= KEMBALIKAN =================
    public function kembali($id)
{
    $peminjamanModel = new \App\Models\PeminjamanModel();
    $pengembalianModel = new \App\Models\PengembalianModel();

    $pinjam = $peminjamanModel->find($id);

    if (!$pinjam) {
        return redirect()->back();
    }

    $today = date('Y-m-d');

    $denda = 0;

    if ($today > $pinjam['tanggal_kembali']) {
        $selisih = (strtotime($today) - strtotime($pinjam['tanggal_kembali'])) / 86400;
        $denda = $selisih * 1000;
    }

    // SIMPAN PENGEMBALIAN
    $pengembalianModel->insert([
        'id_peminjaman' => $id,
        'tanggal_dikembalikan' => $today,
        'denda' => $denda
    ]);

    // UPDATE PEMINJAMAN
    $peminjamanModel->update($id, [
        'status' => 'dikembalikan',
        'tanggal_kembali' => $today // opsional (kalau kamu mau overwrite)
    ]);

    return redirect()->to('/pengembalian');
}

    public function perpanjang($id)
{
    $model = new \App\Models\PeminjamanModel();
    $p = $model->find($id);

    if (!$p) {
        return redirect()->back()->with('error', 'Data tidak ditemukan');
    }

    if ($p['status'] == 'dikembalikan') {
        return redirect()->back()->with('error', 'Buku sudah dikembalikan');
    }

    if ((int)$p['perpanjangan'] >= 2) {
        return redirect()->back()->with('error', 'Maksimal 2 kali perpanjangan');
    }

    // kirim ke petugas untuk verifikasi
    $model->update($id, [
        'status' => 'menunggu_perpanjangan'
    ]);

    return redirect()->back()->with('success', 'Menunggu persetujuan petugas');
}

  public function setujuiPerpanjangan($id)
{
    $model = new \App\Models\PeminjamanModel();
    $p = $model->find($id);

    if (!$p) {
        return redirect()->back()->with('error', 'Data tidak ditemukan');
    }

    $model->update($id, [
        'tanggal_kembali' => date('Y-m-d', strtotime($p['tanggal_kembali'] . ' +3 days')),
        'perpanjangan' => $p['perpanjangan'] + 1,
        'status' => 'dipinjam'
    ]);

    return redirect()->back()->with('success', 'Perpanjangan disetujui');
}

public function tolakPerpanjangan($id)
{
    $model = new \App\Models\PeminjamanModel();

    $model->update($id, [
    'status' => 'ditolak_perpanjangan'
]);

    return redirect()->back()->with('success', 'Perpanjangan ditolak');
}

    public function ambil($id)
    {
        $model = new \App\Models\PeminjamanModel();

        $model->update($id, [
            'id_petugas' => session()->get('id'),
            'status' => 'diantar'
        ]);

        return redirect()->to('/peminjaman');
    }

    public function selesai($id)
    {
        $model = new \App\Models\PeminjamanModel();

        $model->update($id, [
            'status' => 'selesai'
        ]);

        return redirect()->to('/peminjaman');
    }
    // ================= DELETE =================
    public function delete($id)
    {
        // hanya admin dan anggota boleh hapus
        if (!in_array(session()->get('role'), ['admin'])) {
            return redirect()->to('/peminjaman');
        }

        $this->peminjaman->delete($id);
        return redirect()->to('/peminjaman');
    }
}
