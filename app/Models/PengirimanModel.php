<?php

namespace App\Models;
use CodeIgniter\Model;

class PengirimanModel extends Model
{
    protected $table = 'pengiriman';
    protected $primaryKey = 'id_pengiriman';

    protected $allowedFields = [
        'id_peminjaman',
        'alamat',
        'biaya',
        'status',
        'tanggal_kirim',
        'petugas_id'
    ];
}