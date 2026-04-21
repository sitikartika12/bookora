<?php

namespace App\Controllers;

use App\Models\AnggotaModel;

class Anggota extends BaseController
{
    protected $anggotaModel;

    public function __construct()
    {
        $this->anggotaModel = new AnggotaModel();
    }

    public function index()
    {
        $data['anggota'] = $this->anggotaModel
            ->select('anggota.*, users.nama')
            ->join('users', 'users.id = anggota.user_id')
            ->findAll();

        return view('anggota/index', $data);
    }

    public function create()
    {
        $userModel = new \App\Models\UserModel();

        $data['users'] = $userModel->findAll();

        return view('anggota/create', $data);
    }

    public function store()
{
    $anggotaModel = new \App\Models\AnggotaModel();

    $anggotaModel->insert([
        'user_id' => $this->request->getPost('user_id'),
        'nisn'    => $this->request->getPost('nisn'),
        'alamat'  => $this->request->getPost('alamat'),
        'no_hp'   => $this->request->getPost('no_hp'),
        'tanggal_daftar' => date('Y-m-d H:i:s')
    ]);

    return redirect()->to('/anggota');
}

public function editProfil()
{
    $anggotaModel = new \App\Models\AnggotaModel();

    $id_user = session()->get('id');

    $data['anggota'] = $anggotaModel
        ->where('user_id', $id_user)
        ->first();

    return view('anggota/profil', $data);
}

public function updateProfil()
{
    $anggotaModel = new \App\Models\AnggotaModel();

    $id_user = session()->get('id');

    $anggotaModel->where('user_id', $id_user)->set([
        'nisn' => $this->request->getPost('nisn'),
        'alamat' => $this->request->getPost('alamat'),
        'no_hp' => $this->request->getPost('no_hp'),
    ])->update();

    return redirect()->to('/dashboard');
}

    public function delete($id)
    {
        $this->anggotaModel->delete($id);
        return redirect()->to('/anggota');
    }
}