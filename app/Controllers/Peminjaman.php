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
            ->select('peminjaman.*, anggota.nama as nama_anggota, petugas.nama as nama_petugas')
            ->join('users as anggota', 'anggota.id = peminjaman.id_anggota', 'left')
            ->join('users as petugas', 'petugas.id = peminjaman.id_petugas', 'left')
            ->orderBy('peminjaman.id_peminjaman', 'DESC');

        if ($role == 'anggota') {
            $query->where('peminjaman.id_anggota', $id);
        }

        $data['peminjaman'] = $query->findAll();

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

    $biaya = ($metode == 'antar') ? 10000 : 0;

    // ======================
    // SIMPAN PEMINJAMAN
    // ======================
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
    // JIKA ANTAR
    // ======================
    if ($metode == 'antar') {

        // 1. SIMPAN PENGIRIMAN
        $pengirimanModel->insert([
            'id_peminjaman' => $id_peminjaman,
            'alamat' => $anggota['alamat'],
            'biaya' => $biaya,
            'status' => 'menunggu',
            'petugas_id' => null
        ]);

        // 2. SIMPAN TRANSAKSI
        $transaksiModel->insert([
            'id_peminjaman' => $id_peminjaman,
            'jenis' => 'pengiriman',
            'jumlah' => $biaya,
            'status' => 'belum_bayar'
        ]);
    }

    // ======================
    // AMBIL DATA BUKU
    // ======================
    $id_buku_list = $this->request->getPost('id_buku');
    $jumlah_list  = $this->request->getPost('jumlah');

    if (!$id_buku_list) {
        return redirect()->back()->with('error', 'Pilih buku dulu!');
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

public function ajukanKembali($id)
{
    $model = new \App\Models\PeminjamanModel();

    $model->update($id, [
        'status' => 'menunggu_pengembalian'
    ]);

    return redirect()->back()->with('success', 'Menunggu konfirmasi petugas');
}

public function konfirmasiKembali($id)
{
    $model = new \App\Models\PeminjamanModel();
    $detailModel = new \App\Models\DetailPeminjamanModel();
    $bukuModel = new \App\Models\BukuModel();

    // ambil semua buku dari peminjaman
    $detail = $detailModel
        ->where('id_peminjaman', $id)
        ->findAll();

    // kembalikan stok buku
    foreach ($detail as $d) {
        $buku = $bukuModel->find($d['id_buku']);

        $bukuModel->update($d['id_buku'], [
            'tersedia' => $buku['tersedia'] + $d['jumlah']
        ]);
    }

    // update status
    $model->update($id, [
        'status' => 'dikembalikan'
    ]);

    return redirect()->back()->with('success', 'Buku sudah dikembalikan');
}


public function bayar($id_peminjaman)
{
    $transaksiModel = new \App\Models\TransaksiModel();

    $transaksi = $transaksiModel
        ->where('id_peminjaman', $id_peminjaman)
        ->first();

    return view('transaksi/bayar', ['transaksi' => $transaksi]);
}

    // ================= DETAIL =================
    public function detail($id)
{
    $db = \Config\Database::connect();

    // ========================
    // PEMINJAMAN
    // ========================
    $peminjaman = $db->table('peminjaman')
        ->select('peminjaman.*, users.nama as nama_anggota, anggota.alamat, anggota.no_hp')
        ->join('users', 'users.id = peminjaman.id_anggota')
        ->join('anggota', 'anggota.user_id = peminjaman.id_anggota')
        ->where('peminjaman.id_peminjaman', $id)
        ->get()
        ->getRowArray();

    // ========================
    // DETAIL BUKU
    // ========================
    $detail = $db->table('detail_peminjaman')
        ->select('detail_peminjaman.*, buku.judul')
        ->join('buku', 'buku.id_buku = detail_peminjaman.id_buku')
        ->where('detail_peminjaman.id_peminjaman', $id)
        ->get()
        ->getResultArray();

    // ========================
    // TRANSAKSI
    // ========================
    $transaksi = $db->table('transaksi')
        ->where('id_peminjaman', $id)
        ->get()
        ->getRowArray();

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

    // ================= KEMBALIKAN =================
    public function kembali($id)
    {
        $peminjamanModel = new \App\Models\PeminjamanModel();
        $pengembalianModel = new \App\Models\PengembalianModel();
        $detailModel = new \App\Models\DetailPeminjamanModel();
        $bukuModel = new \App\Models\BukuModel();

        // ambil data peminjaman
        $pinjam = $peminjamanModel->find($id);

        if (!$pinjam) {
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }

        // =========================
        // 1. SIMPAN KE PENGEMBALIAN OTOMATIS
        // =========================
        $today = date('Y-m-d');

        $tanggal_kembali = (string) $pinjam['tanggal_kembali'];

        $denda = 0;
        if ($today > $tanggal_kembali) {
            $selisih = (strtotime($today) - strtotime($tanggal_kembali)) / 86400;
            $denda = $selisih * 1000;
        }

        $pengembalianModel->insert([
            'id_peminjaman' => $id,
            'tanggal_dikembalikan' => $today,
            'denda' => $denda
        ]);

        // =========================
        // 2. BALIKKAN STOK BUKU
        // =========================
        $detail = $detailModel->where('id_peminjaman', $id)->findAll();

        foreach ($detail as $d) {
            $buku = $bukuModel->find($d['id_buku']);

            if ($buku) {
                $bukuModel->update($d['id_buku'], [
                    'tersedia' => $buku['tersedia'] + $d['jumlah']
                ]);
            }
        }

        // =========================
        // 3. UPDATE PEMINJAMAN
        // =========================
        $peminjamanModel->update($id, [
            'status' => 'dikembalikan',
            'tanggal_kembali' => $today
        ]);

        return redirect()->to('/peminjaman')
            ->with('success', 'Buku berhasil dikembalikan');
    }

    public function perpanjang($id)
    {
        $peminjamanModel = new \App\Models\PeminjamanModel();

        $peminjaman = $peminjamanModel->find($id);

        if (!$peminjaman) {
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }

        // tidak boleh kalau sudah dikembalikan
        if ($peminjaman['status'] == 'dikembalikan') {
            return redirect()->back()->with('error', 'Buku sudah dikembalikan');
        }

        // tidak boleh lebih dari 1x
        if ($peminjaman['perpanjangan'] >= 1) {
            return redirect()->back()->with('error', 'Sudah pernah diperpanjang');
        }

        // tambah 7 hari
        $tanggalBaru = date('Y-m-d', strtotime($peminjaman['tanggal_kembali'] . ' +7 days'));

        $peminjamanModel->update($id, [
            'tanggal_kembali' => $tanggalBaru,
            'perpanjangan' => $peminjaman['perpanjangan'] + 1
        ]);

        return redirect()->back()->with('success', 'Berhasil diperpanjang 7 hari');
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
