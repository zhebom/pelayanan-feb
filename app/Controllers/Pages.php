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

        $validasi =  \Config\Services::validation();
        $data = [
            'title' => 'Halaman Login',
            'validasi' => $validasi
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
            // 'pass_user' => passwor($this->request->getVar('pass')),
            'pass_user' => password_hash($this->request->getVar('pass'), PASSWORD_DEFAULT),
            'role' => "3",
            'created_at' => $today

        ]);

        return redirect()->to('/pages/')->withInput()->with('i', $data);
    }

    public function login()
    {
        if (!$this->validate(
            [
                'npm' => 'required|min_length[10]',
                'pass' => 'required'

            ],
            [
                'npm' => [
                    'required' => 'NPM harus diisi',
                    'min_length' => 'NPM yang anda masukkan salah'

                ],

                'pass' => [
                    'required' => 'Password harus diisi'
                ],
            ]
        )) {
            return redirect()->to('/')->withInput();
        }

        //berhasil valildasi
        $npm = $this->request->getVar('npm');
        $pass =  $this->request->getVar('pass');
        $simpanModel = new SimpanModel();
        $ceklogin =  $simpanModel->where('npm_user', $npm)->first();


        if ($ceklogin) {

            //  echo "anda berhasil login";
            // echo "-";
            // echo $pass;
            // echo "-";
            echo $ceklogin->pass_user;

            if (password_verify($pass, $ceklogin['pass_user'])) {
                // membuat session
                session()->set('npm_user', $cek['npm_user']);

                return redirect()->to(base_url('pages/listuser'));
                //echo "password anda berhasil";
            } else {

                echo "password anda salah";
            }
        } else {

            echo "anda gagal";
        }
    }

    public function listuser($page = 'listuser')
    {
        if (!is_file(APPPATH . 'Views/mahasiswa/' . $page . '.php')) {
            // Whoops, we don't have a page for that!
            throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
        }
        $npm_user = session()->get('npm_user');

        $validasi =  \Config\Services::validation();
        $simpanModel = new SimpanModel();
        $jurusan =  $simpanModel->where('role', 3)->findAll();

        //var_dump($jurusan);
        $data = [
            'title' => 'Data Mahasiswa',
            'mahasiswa' => $jurusan,
            'validasi' => $validasi,
            'npm_user' => $npm_user
        ];


        echo view('templates/header', $data);
        echo view('mahasiswa/' . $page, $data);
        echo view('templates/footer', $data);
    }
}
