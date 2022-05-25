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

        $data = [
            'title' => 'Halaman Login'
        ];
        echo view('templates/header', $data);
        echo view('pages/login', $data);
    }

    public function home($page = 'sign_up')
    {

        if (!is_file(APPPATH . 'Views/pages/' . $page . '.php')) {
            // Whoops, we don't have a page for that!
            throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
        }

        $validasi =  \Config\Services::validation();

        $jurusan =  $this->daftarModel->findAll();

        $data = [
            'title' => 'Form Pendaftaran Akun Pelayanan Surat',
            'jurusan' => $jurusan,
            'validasi' => $validasi
        ];


        echo view('templates/header', $data);
        echo view('pages/' . $page, $data);
        echo view('templates/footer', $data);
    }

    public function simpan()
    {

        if (!$this->validate(
            [
                'npm' => 'required|min_length[10]|is_unique[feb_user.npm_user]',
                'nama' => 'required',
                'email' => 'required|valid_email',
                'alamat' => 'required',
                'tempatlahir' => 'required',
                'tanggallahir' => 'required',
                'pass' => 'required',
                'passconf' => 'matches[pass]',
            ],
            [
                'npm' => [
                    'required' => 'NPM harus diisi',
                    'min_length' => 'NPM yang anda masukkan salah',
                    'is_unique' => 'NPM yang anda masukkan sudah terdaftar silahkan untuk melakukan reset password di pelayanan dengan membawa KTM',
                ],
                'nama' => [
                    'required' => 'Nama harus diisi',
                ],
                'email' => [
                    'required' => 'Email harus diisi',
                    'valid_email' => 'Masukkan email yang benar'
                ],
                'alamat' => [
                    'required' => 'Alamat harus diisi',
                ],
                'tempatlahir' => [
                    'required' => 'Tempat lahir harus diisi',
                ],
                'tanggallahir' => [
                    'required' => 'Tanggal lahir harus diisi',
                ],
                'pass' => [
                    'required' => 'Password harus diisi',
                ],
                'passconf' => [
                    'matches' => 'Password yang dimasukkan tidak sama',
                ]
            ]
        )) {
            return redirect()->to('/pages/home')->withInput();
        }
        $data = [
            'i' => 'Sukses'
        ];

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

        return redirect()->to('/pages/')->withInput()->with('i', $data);
    }
}
