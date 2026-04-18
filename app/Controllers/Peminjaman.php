<?php

namespace App\Controllers;

use App\Models\PeminjamanModel;
use App\Models\UsersModel;
use App\Models\DetailPeminjamanModel;

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
        $data['peminjaman'] = $this->peminjaman
            ->select('peminjaman.*, anggota.nama as nama_anggota, petugas.nama as nama_petugas')
            ->join('users as anggota', 'anggota.id = peminjaman.id_anggota')
            ->join('users as petugas', 'petugas.id = peminjaman.id_petugas')
            ->findAll();

        return view('peminjaman/index', $data);
    }

    // ================= FORM =================
    public function create()
    {
        $data = [
            'anggota' => $this->users->where('role', 'anggota')->findAll(),
            'petugas' => $this->users->where('role', 'petugas')->findAll(),
        ];

        return view('peminjaman/create', $data);
    }

public function store()
{
    $peminjamanModel = new \App\Models\PeminjamanModel();
    $detailModel = new \App\Models\DetailPeminjamanModel();

    // tanggal otomatis
    $tanggal_pinjam = date('Y-m-d');
    $tanggal_kembali = date('Y-m-d', strtotime('+7 days'));

    // simpan peminjaman utama
    $id_peminjaman = $peminjamanModel->insert([
        'id_anggota' => $this->request->getPost('id_anggota'),
        'id_petugas' => session()->get('id'),
        'tanggal_pinjam' => $tanggal_pinjam,
        'tanggal_kembali' => $tanggal_kembali,
        'status' => 'dipinjam'
    ]);

    // ambil data buku
    $id_buku_list = $this->request->getPost('id_buku');
    $jumlah_list = $this->request->getPost('jumlah');

    // safety check
    if ($id_buku_list && is_array($id_buku_list)) {

        foreach ($id_buku_list as $key => $id_buku) {

            if (!empty($id_buku)) {
                $detailModel->insert([
                    'id_peminjaman' => $id_peminjaman,
                    'id_buku' => $id_buku,
                    'jumlah' => $jumlah_list[$key] ?? 1
                ]);
            }
        }
    }

    return redirect()->to('/peminjaman')->with('success', 'Peminjaman berhasil disimpan');
}

    // ================= DETAIL =================
    public function detail($id)
    {
        $data['peminjaman'] = $this->peminjaman
            ->select('peminjaman.*, anggota.nama as nama_anggota, petugas.nama as nama_petugas')
            ->join('users as anggota', 'anggota.id = peminjaman.id_anggota')
            ->join('users as petugas', 'petugas.id = peminjaman.id_petugas')
            ->where('id_peminjaman', $id)
            ->first();

        return view('peminjaman/detail', $data);
    }

    // ================= KEMBALIKAN =================
    public function kembali($id)
{
    $model = new \App\Models\PeminjamanModel();

    $model->update($id, [
        'tanggal_kembali' => date('Y-m-d'),
        'status' => 'dikembalikan'
    ]);

    return redirect()->to('/peminjaman')
        ->with('success', 'Buku berhasil dikembalikan');
}

    // ================= DELETE =================
    public function delete($id)
    {
        $this->peminjaman->delete($id);
        return redirect()->to('/peminjaman');
    }
}