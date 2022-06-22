<?php

namespace App\Models;

use CodeIgniter\Model;

class AktifModel extends Model
{
    protected $table = 'feb_aktifkuliah';
    protected $createdField  = 'created_at';
    protected $useTimestamps = true;
    protected $primaryKey = 'id_aktifkuliah';
    protected $allowedFields = ['id_aktifkuliah', 'npm_aktifkuliah', 'nama_aktifkuliah', 'keterangan_aktifkuliah','no_aktifkuliah', 'created_at'];
}
