<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Halaman Login Mahasiswa'
        ];
        echo view('templates/header', $data);
        echo view('pages/login', $data);
    }
}
