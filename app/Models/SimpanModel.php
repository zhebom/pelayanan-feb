<?php

namespace App\Models;

use CodeIgniter\Model;

class SimpanModel extends Model
{
    protected $table = "feb_user";
    protected $createdField  = 'created_at';
    protected $useTimestamps = true;
    protected $primaryKey = 'id_user';
    protected $allowedFields = ['id_user', 'npm_user', 'email_user', 'nama_user', 'jurusan_user', 'alamat_user', 'tempat_user', 'lahir_user', 'pass_user', 'role'];
}
