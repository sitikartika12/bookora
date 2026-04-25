<?php

namespace App\Models;

use CodeIgniter\Model;

class PenarikanModel extends Model
{
    protected $table = 'penarikan';
    protected $primaryKey = 'id_penarikan';

    protected $allowedFields = [
        'id_peminjaman',
        'alamat',
        'biaya',
        'status',
        'tanggal_ambil',
        'petugas_id'
    ];
}