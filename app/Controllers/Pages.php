<?php

namespace App\Controllers;

use App\Models\DaftarModel;
use App\Models\SimpanModel;


class Pages extends BaseController
{
    protected $daftarModel;
    protected $simpanModel;

    public function __construct()
    {
        $this->daftarModel = new DaftarModel();
    }

    public function index()
    {
        return view('pages/login');
    }

    public function home($page = 'sign_up')
    {

        if (!is_file(APPPATH . 'Views/pages/' . $page . '.php')) {
            // Whoops, we don't have a page for that!
            throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
        }


        $jurusan =  $this->daftarModel->findAll();

        $data = [
            'title' => 'Form Pendaftaran Akun Pelayanan Surat',
            'jurusan' => $jurusan,
            'npm_user' => $this->request->getVar('npm')
        ];


        echo view('templates/header', $data);
        echo view('pages/' . $page, $data);
        echo view('templates/footer', $data);
    }

    public function simpan()
    {


        $today = date("Y-m-d H:i:s");
        $simpanModel = new SimpanModel();
        $simpanModel->save([
            'npm_user' => $this->request->getVar('npm'),
            'nama_user' => $this->request->getVar('nama'),
            'email_user' => $this->request->getVar('email'),
            'jurusan_user' => $this->request->getVar('jurusan'),
            'alamat_user' => $this->request->getVar('alamat'),
            'tempat_user' => $this->request->getVar('tempatlahir'),
            'lahir_user' => $this->request->getVar('tanggallahir'),
            'pass_user' => md5($this->request->getVar('pass')),
            'role' => "1",
            'created_at' => $today

        ]);

        return redirect()->to('/');
    }
}
