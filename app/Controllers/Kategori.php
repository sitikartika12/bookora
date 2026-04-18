<?php

namespace App\Controllers;

use App\Models\KategoriModel;

class Kategori extends BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new KategoriModel();
    }

   public function index()
{
    $keyword = $this->request->getGet('keyword');

    if ($keyword) {
        $data['kategori'] = $this->model
            ->like('nama_kategori', $keyword)
            ->findAll();
    } else {
        $data['kategori'] = $this->model->findAll();
    }

    return view('kategori/index', $data);
}

    public function create()
    {
        return view('kategori/create');
    }

    public function store()
    {
        $this->model->insert([
            'nama_kategori' => $this->request->getPost('nama_kategori')
        ]);

        return redirect()->to('/kategori');
    }

    public function edit($id)
    {
        $data['kategori'] = $this->model->find($id);
        return view('kategori/edit', $data);
    }

    public function update($id)
{
    $kategoriModel = new \App\Models\KategoriModel();

$kategori_baru = $this->request->getPost('kategori_baru');

if (!empty($kategori_baru)) {
    $id_kategori = $kategoriModel->insert([
        'nama_kategori' => $kategori_baru
    ]);
} else {
    $id_kategori = $this->request->getPost('id_kategori');
}

    // update buku
    $this->bukuModel->update($id, [
        'judul' => $this->request->getPost('judul'),
        'isbn' => $this->request->getPost('isbn'),
        'id_kategori' => $id_kategori,
        'tahun_terbit' => $this->request->getPost('tahun_terbit'),
    ]);

    return redirect()->to('/buku');
}
    public function delete($id)
    {
        $this->model->delete($id);
        return redirect()->to('/kategori');
    }
}