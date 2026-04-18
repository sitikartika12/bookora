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
        $this->anggotaModel->save([
            'user_id' => $this->request->getPost('user_id'),
            'nisn' => $this->request->getPost('nisn'),
            'alamat' => $this->request->getPost('alamat'),
            'no_hp' => $this->request->getPost('no_hp'),
        ]);

        return redirect()->to('/anggota');
    }

    public function delete($id)
    {
        $this->anggotaModel->delete($id);
        return redirect()->to('/anggota');
    }
}