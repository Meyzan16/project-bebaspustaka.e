<?php

namespace App\Controllers\Backend;
use App\Controllers\BaseController;


class Home extends BaseController
{
    
    public function index(){
        if(session()->get('username')=='')  {
            session()->setFlashdata('massage', '<div class="alert alert-danger" role="alert">
            Silahkan Login </div>');
            return redirect()->to(base_url('Rumahku')); 
        } else{
        
            $data = [
                'title' => "BEBAS PUSTAKA",
                'sub_title' => "Dashboard",
            ];
            
            return view('v_home');
        }
    }

}