<?php

namespace App\Controllers;
use App\Models\SimpanModel;
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
        session()->setFlashdata('msg', 'Password Berhasil Dirubah');
        return redirect()->to('mahasiswa')->withInput(); 
    }
}