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
        // echo view('templates/header', $data);
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


        // echo view('templates/header', $data);
        echo view('pages/' . $page, $data);
        // echo view('templates/footer', $data);
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

    public function update($id_user)
    {
        $simpanModel = new SimpanModel();
        $data = [

            'nama_user' => $this->request->getVar('nama'),
            'email_user' => $this->request->getVar('email'),
            'jurusan_user' => $this->request->getVar('jurusan'),
            'alamat_user' => $this->request->getVar('alamat'),
            'tempat_user' => $this->request->getVar('tempatlahir'),
            'lahir_user' => $this->request->getVar('tanggallahir')
        ];

        $simpanModel->update($id_user, $data);

        return redirect()->to('/pages/profil')->withInput()->with('i', $data);
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
        $session = session();

        if ($ceklogin) {

            //  echo "anda berhasil login";
            // echo "-";
            // echo $pass;
            // echo "-";


            if (password_verify($pass, $ceklogin['pass_user'])) {
                // membuat session
                // $npm = $session->set('npm_user', $cek['npm_user']);

                $data = [
                    'id_user' => $ceklogin['id_user'],
                    'npm_user' => $ceklogin['npm_user'],
                    'nama_user' => $ceklogin['nama_user'],
                    'role' => $ceklogin['role'],
                    'logged_id' => TRUE

                ];
                //$session = \Config\Services::session($config);

                $session->set($data);

                return redirect()->to(base_url('mahasiswa'));
                //echo "password anda berhasil";
            } else {
                //echo "password anda salah";
                // $session = session();
                $session->setFlashdata('msg', 'NPM atau Password yang anda masukkan salah');
                return redirect()->to(base_url());
            }
        } else {

            $session->setFlashdata('msg', 'NPM atau Password yang anda masukkan salah');
            return redirect()->to(base_url());
        }
    }
    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to(base_url());
    }

    public function listuser($page = 'listuser')
    {
        if (!is_file(APPPATH . 'Views/mahasiswa/' . $page . '.php')) {
            // Whoops, we don't have a page for that!
            throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
        }
        $id_user = session()->get('id_user');
        $npm_user = session()->get('npm_user');
        $nama_user = session()->get('nama_user');
        $role = session()->get('role');
        $logged_in = session()->get('logged_in');
        $validasi =  \Config\Services::validation();
        $simpanModel = new SimpanModel();
        $jurusan =  $simpanModel->where('role', 3)->findAll();
        // $daftar = $this->daftarModel->where(
        //     'id_jurusan',
        //     $key
        // )->first();

        $data = [
            'title' => 'Data Mahasiswa',
            'mahasiswa' => $jurusan,
            'validasi' => $validasi,
            'id_user' => $id_user,
            'npm_user' => $npm_user,
            'nama_user' => $nama_user,
            'role' => $role,
            'logged_in' => $logged_in



        ];


        echo view('templates/header', $data);
        echo view('mahasiswa/' . $page, $data);
        echo view('templates/footer', $data);
    }
    public function profil($page = 'profil')
    {

        if (!is_file(APPPATH . 'Views/pages/' . $page . '.php')) {
            // Whoops, we don't have a page for that!
            throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
        }
        $id_user = session()->get('id_user');
        $npm_user = session()->get('npm_user');
        $nama_user = session()->get('nama_user');
        $role = session()->get('role');
        $logged_in = session()->get('logged_in');
        $validasi =  \Config\Services::validation();

        $jurusan =  $this->daftarModel->findAll();
        $simpanModel = new SimpanModel();
        $profil = $simpanModel->where('npm_user', $npm_user)->first();

        $data = [
            'title' => 'Profil Mahasiswa',
            'jurusan' => $jurusan,
            'validasi' => $validasi,
            'id_user' => $id_user,
            'npm_user' => $npm_user,
            'nama_user' => $nama_user,
            'role' => $role,
            'logged_in' => $logged_in,
            'profil' => $profil
        ];


        echo view('templates/header', $data);
        echo view('mahasiswa/' . $page, $data);
        echo view('templates/footer', $data);
    }
}
