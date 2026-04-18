<?php

namespace App\Controllers;

use App\Models\PenulisModel;

class Penulis extends BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new PenulisModel();
    }

   public function index()
{
    $keyword = $this->request->getGet('keyword');

    if ($keyword) {
        $data['penulis'] = $this->model
            ->like('nama_penulis', $keyword)
            ->findAll();
    } else {
        $data['penulis'] = $this->model->findAll();
    }

    return view('penulis/index', $data);
}

    public function create()
    {
        return view('penulis/create');
    }

    public function store()
    {
        $this->model->insert([
            'nama_penulis' => $this->request->getPost('nama_penulis')
        ]);

        return redirect()->to('/penulis');
    }

    public function edit($id)
    {
        $data['penulis'] = $this->model->find($id);
        return view('penulis/edit', $data);
    }

    public function update($id)
    {
        $this->model->update($id, [
            'nama_penulis' => $this->request->getPost('nama_penulis')
        ]);

        return redirect()->to('/penulis');
    }

    public function delete($id)
    {
        $this->model->delete($id);
        return redirect()->to('/penulis');
    }
}