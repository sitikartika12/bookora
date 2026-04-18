<?php

namespace App\Models;

use CodeIgniter\Model;

class PenulisModel extends Model
{
    protected $table = 'penulis';
    protected $primaryKey = 'id_penulis';

    protected $allowedFields = ['nama_penulis'];

    protected $useTimestamps = false;

    // Ambil semua penulis
    public function getAll()
    {
        return $this->orderBy('nama_penulis', 'ASC')->findAll();
    }

    // Ambil berdasarkan ID
    public function getById($id)
    {
        return $this->where('id_penulis', $id)->first();
    }

    // Cek dipakai di buku
    public function isUsed($id)
    {
        return $this->db->table('buku')
            ->where('id_penulis', $id)
            ->countAllResults() > 0;
    }
}