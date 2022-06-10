<?php

namespace App\Controllers;

use App\Models\DaftarModel;
use App\Models\SimpanModel;
use Config\View;
use Dompdf\Dompdf;
use Dompdf\Options;

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
        ];     //  view('templates/header', $data);
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
            return redirect()->to(base_url('/daftar'))->withInput();
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

    public function surat($page = 'surat')
    {
        $id_user = session()->get('id_user');
        $npm_user = session()->get('npm_user');
        $nama_user = session()->get('nama_user');
        $role = session()->get('role');
        $logged_in = session()->get('logged_in');

        $data = [
            'title' => 'Pengajuan Surat',
            'id_user' => $id_user,
            'npm_user' => $npm_user,
            'nama_user' => $nama_user,
            'role' => $role

        ];
        echo view('templates/header', $data);
        echo view('mahasiswa/' . $page, $data);
        echo view('templates/footer', $data);
    }
    public function convertpdf()
    {
        $id_user = session()->get('id_user');
        $npm_user = session()->get('npm_user');
        $nama_user = session()->get('nama_user');
        $role = session()->get('role');
        $logged_in = session()->get('logged_in');

        $data = [
            'title' => 'Pengajuan Surat',
            'id_user' => $id_user,
            'npm_user' => $npm_user,
            'nama_user' => $nama_user,
            'role' => $role,


        ];
        $html1 = '
        
            <table>
            <tr>
            <td><img src="' . $_SERVER["DOCUMENT_ROOT"] . '/brand/upstegal.png" alt="" width="100" height="100" class="d-inline-block align-text-top"></td>
            <td align="center">YAYASAN PENDIDIKAN PANCASAKTI
            UNIVERSITAS PANCASAKTI TEGAL <br>
               <strong size="18">FAKULTAS EKONOMI DAN BISNIS</strong><br>
               
               MANAJEMEN, AKUNTANSI, MANAJEMEN PERPAJAKAN, DAN BISNIS DIGITAL <br>
               Jl. Halmahera KM.1 Kota Tegal 52121 | Telp:(0283) 355720 | <br> Web:feb.upstegal.ac.id | Email:feb@upstegal.ac.id</td>
            </tr>
            </table>
       
        <hr>
<center>
    <strong>
        SURAT KETERANGAN

      
    </strong>
</center>
<center>
   No.
</center>
<p>Dekan Fakultas Ekonomi dan Bisnis Universitas Pancasakti Tegal menerangkan dengan
    sebenarnya bahwa :</p>


<table>
    <tr>
        <td>Nama</td>
        <td>:</td>
        <td>' . $nama_user . '</td>
    </tr>
    <tr>
        <td>NPM</td>
        <td>:</td>
        <td>' . $npm_user . '</td>
    </tr>
    <tr>
        <td>Program Studi</td>
        <td>:</td>
        <td></td>
    </tr>
    <tr>
        <td>Tempat, Tanggal Lahir</td>
        <td>:</td>
        <td>' . $profil['tempat_user'] . '</td>
    </tr>
    <tr>
        <td>Alamat</td>
        <td>:</td>
        <td></td>
    </tr>
</table>
<br>
<p>Adalah benar yang bersangkutan terdaftar sebagai mahasiswa Program Studi
    Manajemen Semester Genap Tahun Akademik 2021/2022.</p>
<p>Mahasiswa tersebut di atas adalah anak dari orang tua :</p>
<table>
    <tr>
        <td>Nama</td>
        <td>:</td>
        <td></td>
    </tr>
    <tr>
        <td>Instansi</td>
        <td>:</td>
        <td></td>
    </tr>
    <tr>
        <td>Pangkat/Golongan</td>
        <td>:</td>
        <td></td>
    </tr>
</table>';


        $Options = new Options();
        $Options->set('chroot', realpath(''));
        $dompdf = new Dompdf($Options);

        // $dompdf = new \Dompdf\Dompdf();
        $dompdf->loadHtml($html1);

        $dompdf->setPaper('A4', 'potrait');
        $dompdf->render();
        $dompdf->stream();
    }
    public function formsurat($page = 'aktif-kuliah')
    {

        if (!is_file(APPPATH . 'Views/surat/' . $page . '.php')) {
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
            'title' => 'Surat keterangan Aktif Kuliah',
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
        echo view('surat/' . $page, $data);
        echo view('templates/footer', $data);
    }
}
