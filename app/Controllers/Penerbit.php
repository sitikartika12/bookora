<?php

namespace App\Controllers;

use App\Models\PenerbitModel;

class Penerbit extends BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new PenerbitModel();
    }

    public function index()
{
    $keyword = $this->request->getGet('keyword');

    if ($keyword) {
        $data['penerbit'] = $this->model
            ->like('nama_penerbit', $keyword)
            ->findAll();
    } else {
        $data['penerbit'] = $this->model->findAll();
    }

    return view('penerbit/index', $data);
}

    public function create()
    {
        return view('penerbit/create');
    }

    public function store()
    {
        $this->model->insert([
            'nama_penerbit' => $this->request->getPost('nama_penerbit')
        ]);

        return redirect()->to('/penerbit');
    }

    public function edit($id)
    {
        $data['penerbit'] = $this->model->find($id);
        return view('penerbit/edit', $data);
    }

    public function update($id)
    {
        $this->model->update($id, [
            'nama_penerbit' => $this->request->getPost('nama_penerbit')
        ]);

        return redirect()->to('/penerbit');
    }

    public function delete($id)
    {
        $this->model->delete($id);
        return redirect()->to('/penerbit');
    }
}