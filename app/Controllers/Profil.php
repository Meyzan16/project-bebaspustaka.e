<?php

namespace App\Controllers;

class Profil extends BaseController{

    public function index(){
        if(session()->get('cek_portal') == ''){
            session()->setFlashdata('message', '<div class="alert alert-danger" role="alert">
            Silahkan Login </div>');
            return redirect()->to(base_url('Auth')); 
        }else{

            $data = [
                'title' => 'BEBAS PUSTAKA',
                'sub_title' => 'PROFIL'
            ];

            return view('mhs/v_profil', $data);
        }

    }


}

?>