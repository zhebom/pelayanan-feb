<?php

namespace App\Controllers;

use App\Models\DaftarModel;
use App\Models\SimpanModel;
use App\Models\AktifModel;
use App\Models\MenuModel;
use Config\View;
use DateTime;
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
        if (!session()) 
        {
            return redirect()->to('/surat')->withInput();
       
        } else {
            
            $validasi =  \Config\Services::validation();
        $data = [
            'title' => 'Halaman Login',
            'validasi' => $validasi
        ];     //  view('templates/head', $data);
        echo view('pages/login', $data);
        }
    }

    public function home($page = 'sign_up')
    {

        if (!is_file(APPPATH . 'Views/pages/' . $page . '.php')) {
            // Whoops, we don't have a page for that!
            throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
        }

        $validasi =  \Config\Services::validation();

        $jurusan =  $this->daftarModel->findAll();
        $menuModel = new MenuModel();
        $menu =  $menuModel->where('role_menu', $role)->findAll();

        $data = [
            'title' => 'Form Pendaftaran Akun Pelayanan Surat',
            'jurusan' => $jurusan,
            'validasi' => $validasi,
            'menu' => $menu
        ];


        // echo view('templates/head', $data);
        echo view('pages/' . $page, $data);
        // echo view('templates/foot', $data);
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
            'lahir_user' => $this->request->getVar('tanggallahir'),
            'ortu_user' => $this->request->getVar('ortu_user'),
            'kerja_user' => $this->request->getVar('kerja_user'),
            'semester_user' => $this->request->getVar('semester_user'),
            'pangkat_user' => $this->request->getVar('pangkat_user'),
            'skripsi_user' => $this->request->getVar('skripsi_user'),
            'institusi_user' => $this->request->getVar('institusi_user'),
            'alis_user' => $this->request->getVar('alis_user')
        ];

        $simpanModel->update($id_user, $data);
        session()->setFlashdata('msg', 'Data Berhasil Dirubah');
        return redirect()->to('/aktif-kuliah')->withInput();
    }
    public function updateip($id_user)
    {
        $simpanModel = new SimpanModel();
        $data = [
            'nama_user' => $this->request->getVar('nama'),       
            'jurusan_user' => $this->request->getVar('jurusan'),
            'skripsi_user' => $this->request->getVar('skripsi'),
            'institusi_user' => $this->request->getVar('institusi_user'),
            'alis_user' => $this->request->getVar('alis_user')
        ];
        
        $simpanModel->update($id_user, $data);
        session()->setFlashdata('msg', 'Data Berhasil Dirubah');
         return redirect()->to('/ip')->withInput();
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

                return redirect()->to(base_url('surat'));
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
        $menuModel = new MenuModel();
        $menu =  $menuModel->where('role_menu', $role)->findAll();
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
            'menu' => $menu,
            'logged_in' => $logged_in



        ];


        echo view('templates/head', $data);
        echo view('mahasiswa/' . $page, $data);
        echo view('templates/foot', $data);
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
        $menuModel = new MenuModel();
        $menu =  $menuModel->where('role_menu', $role)->findAll();
        $data = [
            'title' => 'Profil Mahasiswa',
            'jurusan' => $jurusan,
            'validasi' => $validasi,
            'id_user' => $id_user,
            'npm_user' => $npm_user,
            'nama_user' => $nama_user,
            'role' => $role,
            'logged_in' => $logged_in,
            'menu' => $menu,
            'profil' => $profil
        ];


        echo view('templates/head', $data);
        echo view('mahasiswa/' . $page, $data);
        echo view('templates/foot', $data);
    }

    public function surat($page = 'surat')
    {
        $id_user = session()->get('id_user');
        $npm_user = session()->get('npm_user');
        $nama_user = session()->get('nama_user');
        $role = session()->get('role');
        $aktifModel = new AktifModel();
        $aktifkuliah = $aktifModel->selectCount('id_aktifkuliah');
        $menuModel = new MenuModel();
        $menu =  $menuModel->where('role_menu', $role)->findAll();

        $data = [
            'title' => 'Pengajuan Surat',
            'id_user' => $id_user,
            'npm_user' => $npm_user,
            'nama_user' => $nama_user,
            'role' => $role,
            'menu' => $menu,
            'aktifkuliah' => $aktifkuliah


        ];
        echo view('templates/head', $data);
        echo view('mahasiswa/' . $page, $data);
        echo view('templates/foot', $data);
    }
    public function aktifkuliah($page = 'aktif-kuliah')
    {
        // $id_user = session()->get('id_user');
        // $npm_user = session()->get('npm_user');
        // $nama_user = session()->get('nama_user');
        // $role = session()->get('role');

        // $logged_in = session()->get('logged_in');

        // $data = [
        //     'title' => 'Pengajuan Surat',
        //     'id_user' => $id_user,
        //     'npm_user' => $npm_user,
        //     'nama_user' => $nama_user,
        //     'role' => $role,


        // ];

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
        $aktifModel = new AktifModel();
        $getnosurat = $aktifModel->where('Month(created_at)', date('m'))->findAll();
        $menuModel = new MenuModel();
        $menu =  $menuModel->where('role_menu', $role)->findAll();
        $data = [
            'title' => 'Surat keterangan Aktif Kuliah',
            'jurusan' => $jurusan,
            'validasi' => $validasi,
            'id_user' => $id_user,
            'npm_user' => $npm_user,
            'nama_user' => $nama_user,
            'role' => $role,
            'logged_in' => $logged_in,
            'profil' => $profil,
            'getnosurat' => $getnosurat,
            'menu' => $menu
        ];



        date_default_timezone_set('UTC');

        $day = explode("-", $profil['lahir_user']);
        // $day =  $profil['lahir_user'];
        $arday = array($day[2], $day[1], $day[0]);
        $day1 = implode("-", $arday);
        $jur = $profil['jurusan_user'];
        switch ($jur) {
            case 1:
                $jur = "Manajemen";

                break;
            case 2:
                $jur = "Akuntansi";

                break;
            case 3:
                $jur = "Bisnis Digital";
                break;
            case 4:
                $jur = "D3 - Manajemen Perpajakan";
                break;
            default:
                $jur = "anda belum memilih jurusan";
                break;
        }

        $bulan = array(
            '01' => 'Januari',
            '02' => 'Februari',
            '03' => 'Maret',
            '04' => 'April',
            '05' => 'Mei',
            '06' => 'Juni',
            '07' => 'Juli',
            '08' => 'Agustus',
            '09' => 'September',
            '10' => 'Oktober',
            '11' => 'November',
            '12' => 'Desember',
        );
        $romawi = array(
            '01' => 'I',
            '02' => 'II',
            '03' => 'III',
            '04' => 'IV',
            '05' => 'V',
            '06' => 'VI',
            '07' => 'VII',
            '08' => 'VIII',
            '09' => 'IX',
            '10' => 'X',
            '11' => 'XI',
            '12' => 'XII',
        );
        $surat = COUNT($getnosurat) + 1;
        $romawi = $romawi[date('m')];
        $tahun = date('Y');
        $nomor = "$surat/K/I/FEB/UPS/$romawi/$tahun";
        $today = date("Y-m-d H:i:s");
        $aktifModel = new AktifModel();
        $aktifModel->save([
            'npm_aktifkuliah' => $npm_user,
            'nama_aktifkuliah' => $nama_user,
            'no_aktifkuliah' => $nomor,
            'keterangan_aktifkuliah' => 'Surat Keterangan Aktif Kuliah',
            'created_at' => $today

        ]);
        $bil = $profil['semester_user']; // Inisialisasi variabel bil dengan nilai 10

        if ($bil % 2 == 0) { //Kondisi
            $sms = "Genap"; //Kondisi true
        } else {
            $sms = "Gasal"; //Kondisi true
        }
        $html1 = '
        
            <table>
            <tr>
            <td><img src="' . $_SERVER["DOCUMENT_ROOT"] . '/brand/upstegal.png" alt="" width="100" height="100" class="d-inline-block align-text-top"></td>
            <td align="center">YAYASAN PENDIDIKAN PANCASAKTI <br>
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
   No:' . $nomor . '
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
        <td>' . $jur . '</td>
    </tr>
    <tr>
        <td>Tempat, Tanggal Lahir</td>
        <td>:</td>
        <td>' . $profil['tempat_user'] . ', ' . $day1 . '</td>
    </tr>
    <tr>
        <td>Alamat</td>
        <td>:</td>
        <td>' . $profil['alamat_user'] . '</td>
    </tr>
</table>
<br>
<p>Adalah benar yang bersangkutan terdaftar sebagai mahasiswa Program Studi
    ' . $jur . ' Semester ' . $sms . ' Tahun Akademik 2021/2022.</p>
<p>Mahasiswa tersebut di atas adalah anak dari orang tua :</p>
<table>
    <tr>
        <td>Nama</td>
        <td>:</td>
        <td>' . $profil['ortu_user'] . '</td>
    </tr>
    <tr>
        <td>Instansi</td>
        <td>:</td>
        <td>' . $profil['kerja_user'] . '</td>
    </tr>
    <tr>
        <td>Pangkat/Golongan</td>
        <td>:</td>
        <td>' . $profil['pangkat_user'] . '</td>
    </tr>
</table>
<br>
Demikian Surat Keterangan ini dibuat dengan sesungguhnya, untuk dapat dipergunakan seperlunya.
<br>
<br>
<table >
<tr>
<td width="200"></td>
<td>Tegal, ' .
            date('d') . ' ' . $bulan[date('m')] . ' ' . date('Y')

            . '</td>
</tr>
<tr>

<td width="200"></td>
<td align="top"> <strong>Dekan</strong></td>
</tr>
<tr>
<td></td>
<td height="75" ></td>
</tr>
<tr>
<td width="200"></td>
<td>Dr. Dien Noviany Rahmatika, SE., MM., Ak., CA</td>
<tr>
<td width="200"></td>
<td>NIDN. 0628117502</td>
</tr>
</tr>
</table>

';

        $html2 =  view('surat/' . $page, $data);
        $Options = new Options();
        $Options->set('chroot', realpath(''));
        $dompdf = new Dompdf($Options);

        // $dompdf = new \Dompdf\Dompdf();
        $dompdf->loadHtml($html1);

        $dompdf->setPaper('A4', 'potrait');
        $dompdf->render();
        $dompdf->stream('Surat Aktif Kuliah_' . $npm_user . '.pdf');
    }

    public function ijinpenelitian($page = 'ijin-penelitian')
    {
        // $id_user = session()->get('id_user');
        // $npm_user = session()->get('npm_user');
        // $nama_user = session()->get('nama_user');
        // $role = session()->get('role');

        // $logged_in = session()->get('logged_in');

        // $data = [
        //     'title' => 'Pengajuan Surat',
        //     'id_user' => $id_user,
        //     'npm_user' => $npm_user,
        //     'nama_user' => $nama_user,
        //     'role' => $role,


        // ];

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
        $aktifModel = new AktifModel();
        $getnosurat = $aktifModel->where('Month(created_at)', date('m'))->findAll();
        $menuModel = new MenuModel();
        $menu =  $menuModel->where('role_menu', $role)->findAll();
        $data = [
            'title' => 'Surat keterangan Aktif Kuliah',
            'jurusan' => $jurusan,
            'validasi' => $validasi,
            'id_user' => $id_user,
            'npm_user' => $npm_user,
            'nama_user' => $nama_user,
            'role' => $role,
            'logged_in' => $logged_in,
            'profil' => $profil,
            'getnosurat' => $getnosurat,
            'menu' => $menu
        ];



        date_default_timezone_set('UTC');

        $day = explode("-", $profil['lahir_user']);
        // $day =  $profil['lahir_user'];
        $arday = array($day[2], $day[1], $day[0]);
        $day1 = implode("-", $arday);
        $jur = $profil['jurusan_user'];
        switch ($jur) {
            case 1:
                $jur = "Manajemen";

                break;
            case 2:
                $jur = "Akuntansi";

                break;
            case 3:
                $jur = "Bisnis Digital";
                break;
            case 4:
                $jur = "D3 - Manajemen Perpajakan";
                break;
            default:
                $jur = "anda belum memilih jurusan";
                break;
        }

        $bulan = array(
            '01' => 'Januari',
            '02' => 'Februari',
            '03' => 'Maret',
            '04' => 'April',
            '05' => 'Mei',
            '06' => 'Juni',
            '07' => 'Juli',
            '08' => 'Agustus',
            '09' => 'September',
            '10' => 'Oktober',
            '11' => 'November',
            '12' => 'Desember',
        );
        $romawi = array(
            '01' => 'I',
            '02' => 'II',
            '03' => 'III',
            '04' => 'IV',
            '05' => 'V',
            '06' => 'VI',
            '07' => 'VII',
            '08' => 'VIII',
            '09' => 'IX',
            '10' => 'X',
            '11' => 'XI',
            '12' => 'XII',
        );
        $surat = COUNT($getnosurat) + 1;
        $romawi = $romawi[date('m')];
        $tahun = date('Y');
        $nomor = "$surat/K/E/FEB/UPS/$romawi/$tahun";
        $today = date("Y-m-d H:i:s");
        $aktifModel = new AktifModel();
        $aktifModel->save([
            'npm_aktifkuliah' => $npm_user,
            'nama_aktifkuliah' => $nama_user,
            'no_aktifkuliah' => $nomor,
            'keterangan_aktifkuliah' => 'Surat Ijin Penelitian',
            'created_at' => $today

        ]);
        $bil = $profil['semester_user']; // Inisialisasi variabel bil dengan nilai 10

        if ($bil % 2 == 0) { //Kondisi
            $sms = "Genap"; //Kondisi true
        } else {
            $sms = "Gasal"; //Kondisi true
        }
        $html1 = '
        
            <table>
            <tr>
            <td><img src="' . $_SERVER["DOCUMENT_ROOT"] . '/brand/upstegal.png" alt="" width="100" height="100" class="d-inline-block align-text-top"></td>
            <td align="center">YAYASAN PENDIDIKAN PANCASAKTI <br>
            UNIVERSITAS PANCASAKTI TEGAL <br>
               <strong size="18">FAKULTAS EKONOMI DAN BISNIS</strong><br>
               
               MANAJEMEN, AKUNTANSI, MANAJEMEN PERPAJAKAN, DAN BISNIS DIGITAL <br>
               Jl. Halmahera KM.1 Kota Tegal 52121 | Telp:(0283) 355720 | <br> Web:feb.upstegal.ac.id | Email:feb@upstegal.ac.id</td>
            </tr>
            </table>
       
        <hr>
<table>
<tr>
<td>Nomor</td>
<td>: </td>
<td width:"350">' . $nomor . '</td>
<td>Tegal, ' .
            date('d') . ' ' . $bulan[date('m')] . ' ' . date('Y')

            . '</td>
<td></td>
</tr>
<tr>
<td>Lampiran</td>
<td>:</td>
<td>-</td>
<td></td>
</tr>
<tr>
<td>Perihal</td>
<td>:</td>
<td><strong>Ijin Penelitian</strong></td>
<td></td>
</tr>
<tr>
<td>Kepada</td>
<td>:</td>
<td><strong>Yth.'. $profil['institusi_user'].' </strong></td>
</tr>
<tr>
<td></td>
<td></td>
<td>'.$profil['alis_user'].'</td>
</tr>
</table>
<p>Dengan hormat, salah satu syarat untuk menyelesaikan program sarjana (S1)
Fakultas Ekonomi dan Bisnis mahasiswa di wajibkan mengadakan penelitian
sebagai bahan menyusun skripsi.
Berkenaan dengan hal itu, mohon perkenaan Bapak membantu memberi data
yang diperlukan dalam penelitian tersebut kepada mahasiswa : :</p>


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
        <td>' . $jur . '</td>
    </tr>
 
    <tr>
        <td>Judul Skripsi</td>
        <td>:</td>
        <td>' . $profil['skripsi_user'] . '</td>
    </tr>
</table>
<br>

<p>Atas bantuan dan kerja sama yang baik kami ucapkan terimakasih</p>
<br>
<br>
<table >
<tr>
<td width="200"></td>
<td>Tegal, ' .
            date('d') . ' ' . $bulan[date('m')] . ' ' . date('Y')

            . '</td>
</tr>
<tr>

<td width="200"></td>
<td align="top"> <strong>Dekan</strong></td>
</tr>
<tr>
<td></td>
<td height="75" ></td>
</tr>
<tr>
<td width="200"></td>
<td>Dr. Dien Noviany Rahmatika, SE., MM., Ak., CA</td>
<tr>
<td width="200"></td>
<td>NIDN. 0628117502</td>
</tr>
</tr>
</table>

';

        $html2 =  view('surat/' . $page, $data);
        $Options = new Options();
        $Options->set('chroot', realpath(''));
        $dompdf = new Dompdf($Options);

        // $dompdf = new \Dompdf\Dompdf();
        $dompdf->loadHtml($html1);

        $dompdf->setPaper('A4', 'potrait');
        $dompdf->render();
        $dompdf->stream('Ijin Penelitian_' . $npm_user . '.pdf');
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
        $menuModel = new MenuModel();
        $menu =  $menuModel->where('role_menu', $role)->findAll();
        $data = [
            'title' => 'Surat keterangan Aktif Kuliah',
            'jurusan' => $jurusan,
            'validasi' => $validasi,
            'id_user' => $id_user,
            'npm_user' => $npm_user,
            'nama_user' => $nama_user,
            'role' => $role,
            'logged_in' => $logged_in,
            'profil' => $profil,
            'menu' => $menu
        ];


        echo view('templates/head', $data);
        echo view('surat/' . $page, $data);
        echo view('templates/foot', $data);
    }
    public function formijinpenelitian($page = 'ijin-penelitian')
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
        $menuModel = new MenuModel();
        $menu =  $menuModel->where('role_menu', $role)->findAll();
        $data = [
            'title' => 'Surat keterangan Ijin Penelitian',
            'jurusan' => $jurusan,
            'validasi' => $validasi,
            'id_user' => $id_user,
            'npm_user' => $npm_user,
            'nama_user' => $nama_user,
            'role' => $role,
            'logged_in' => $logged_in,
            'profil' => $profil,
            'menu' => $menu
        ];


        echo view('templates/head', $data);
        echo view('surat/' . $page, $data);
        echo view('templates/foot', $data);
    }
    public function editijinpenelitian($page = 'ijin-penelitian')
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
        $menuModel = new MenuModel();
        $menu =  $menuModel->where('role_menu', $role)->findAll();
        $data = [
            'title' => 'Surat keterangan Ijin Penelitian',
            'jurusan' => $jurusan,
            'validasi' => $validasi,
            'id_user' => $id_user,
            'npm_user' => $npm_user,
            'nama_user' => $nama_user,
            'role' => $role,
            'logged_in' => $logged_in,
            'profil' => $profil,
            'menu' => $menu
        ];


        echo view('templates/head', $data);
        echo view('mahasiswa/' . $page, $data);
        echo view('templates/foot', $data);
    }
}
