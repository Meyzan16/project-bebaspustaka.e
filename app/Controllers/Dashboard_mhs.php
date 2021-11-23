<?php

namespace App\Controllers;
use App\Models\M_status_akhir;

class Dashboard_mhs extends BaseController
{


    public function index(){
        if(session()->get('cek_portal') =='')  {
            session()->setFlashdata('message', '<div class="alert alert-danger" role="alert">
            Silahkan Login </div>');
            return redirect()->to(base_url('Auth')); 
        } else{  
            $this->query = new M_status_akhir();
            
            $npm = session()->get('npm');
            $query = $this->query->where('npm', $npm)->first();
            
            $data = [
                'title' => "BEBAS PUSTAKA",
                'cek_status' => $query,
                'validation' => $this->validation
            ];

            return view('mhs/v_dashboard', $data);
    }
}
    

    
}