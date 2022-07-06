<?php

namespace App\Controllers;
use App\Models\SimpanModel;
use App\Models\AktifModel;
use App\Models\MenuModel;
class Mahasiswa extends BaseController
{
    public function reset($user)
    {   
        $pass = "pancasakti";
        $simpanModel = new SimpanModel();
        $data = [
            
            'pass_user' => password_hash($pass, PASSWORD_DEFAULT),
           
        ];
        $simpanModel->update($user, $data);
        session()->setFlashdata('msg', 'Password Berhasil Dirubah menjadi pancasakti');
        return redirect()->to('mahasiswa')->withInput(); 
    }

    public function konfirm($user)
    {   
        $npm_user = session()->get('npm_user');
        $nama_user = session()->get('nama_user');
        $aktifModel = new AktifModel();
        $data = [
            'title' => "Konfirmasi Surat",
            'confirm_aktifkuliah' => "1"
           
        ];
        $aktifModel->update($user, $data);
        session()->setFlashdata('msg', 'Surat dari '.$npm_user.' telah dilegalkan');
        return redirect()->to('mahasiswa')->withInput(); 
    }
    public function histori($user)
    {   
        
        $id_user = session()->get('id_user');
        $npm_user = session()->get('npm_user');
        $nama_user = session()->get('nama_user');
        $role = session()->get('role');
        $menuModel = new MenuModel();
        $menu =  $menuModel->where('role_menu', $role)->orderBy('urutan_menu','ASC')->findAll();
        $aktifModel = new AktifModel();
        
        
      $histori =  $aktifModel->where('npm_aktifkuliah',$user)->orderBy('updated_at','desc')->findAll();
        $data = [
            'title' => "Konfirmasi Surat",
            
            'id_user' => $id_user,
            'npm_user' => $npm_user,
            'nama_user' => $nama_user,
            'menu' => $menu,
            'histori' => $histori
           
        ];
        
        
        
        echo view('templates/head', $data);
        echo view('mahasiswa/histori', $data);
        echo view('templates/foot', $data);
    }

    public function riwayat()
    {   
        
        $id_user = session()->get('id_user');
        $npm_user = session()->get('npm_user');
        $nama_user = session()->get('nama_user');
        $role = session()->get('role');
        $menuModel = new MenuModel();
        $menu =  $menuModel->where('role_menu', $role)->orderBy('urutan_menu','ASC')->findAll();
        $aktifModel = new AktifModel();
        $histori =  $aktifModel->where('npm_aktifkuliah',$npm_user)->orderBy('updated_at','desc')->findAll();
        $data = [
            'title' => "Riwayat Pelayanan Surat",
            
            'id_user' => $id_user,
            'npm_user' => $npm_user,
            'nama_user' => $nama_user,
            'menu' => $menu,
            'histori' => $histori
           
        ];
        
        
        
        echo view('templates/head', $data);
        echo view('mahasiswa/riwayatmhs', $data);
        echo view('templates/foot', $data);
    }
    public function dashboard()
    {   
        
        $id_user = session()->get('id_user');
        $npm_user = session()->get('npm_user');
        $nama_user = session()->get('nama_user');
        $role = session()->get('role');
        $menuModel = new MenuModel();
        $menu =  $menuModel->where('role_menu', $role)->orderBy('urutan_menu','ASC')->findAll();
        $aktifModel = new AktifModel();
        $totalsuratmasuk =  $aktifModel->countAllResults('id_aktifkuliah');
        $totalsuratkonfirm =  $aktifModel->where('confirm_aktifkuliah','1')->countAllResults();
        $data = [
            'title' => "Riwayat Pelayanan Surat",
            
            'id_user' => $id_user,
            'npm_user' => $npm_user,
            'nama_user' => $nama_user,
            'menu' => $menu,
            'totalsurat' => $totalsuratmasuk,
            'suratkonfirm' => $totalsuratkonfirm
           
        ];
        
        
        
        echo view('templates/head', $data);
        echo view('mahasiswa/dashboard', $data);
        echo view('templates/foot', $data);
    }

}