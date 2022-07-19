<?php

namespace App\Models;

use CodeIgniter\Model;

class AkademikModel extends Model
{
    protected $table = "feb_akademik";
    protected $useTimestamps = false;
    protected $primaryKey = 'id_akademik';
    protected $allowedFields = ['tahun_akademik'];
}
