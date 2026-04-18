<?php

namespace App\Controllers;

use App\Models\PetugasModel;

class Petugas extends BaseController
{
    protected $petugasModel;

    public function __construct()
    {
        $this->petugasModel = new PetugasModel();
    }

    // LIST
    public function index()
    {
        $data['petugas'] = $this->petugasModel
            ->select('petugas.*, users.nama, users.email')
            ->join('users', 'users.id = petugas.user_id')
            ->findAll();

        return view('petugas/index', $data);
    }

    // CREATE FORM
    public function create()
    {
        $userModel = new \App\Models\UserModel();

        $data['users'] = $userModel->findAll();

        return view('petugas/create', $data);
    }

    // STORE
    public function store()
    {
        $this->petugasModel->save([
            'user_id' => $this->request->getPost('user_id'),
            'jabatan' => $this->request->getPost('jabatan'),
        ]);

        return redirect()->to('/petugas');
    }

    // DELETE
    public function delete($id)
    {
        $this->petugasModel->delete($id);

        return redirect()->to('/petugas');
    }
}