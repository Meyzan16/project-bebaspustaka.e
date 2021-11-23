<?php

namespace App\Controllers;
use App\Models\M_laporan;

class Laporan extends BaseController
{

    function __construct()
    {
        $this->laporan = new M_laporan();
    }

     public function index()
    {   
        if(isset($_POST['cetak'])){
            $model = $this->laporan->getData();
            $data = [
                'title' => "BEBAS PUSTAKA",
                'laporan' => $model,
            ];
            
            return view('laporan/v_unit', $data);
        }else{
            return redirect()->to(base_url('Dashboard_mhs'));       
        }
    }

    public function pusat()
    {   
        if(isset($_POST['cetak'])){
            $model = $this->laporan->getData();
            $data = [
                'title' => "BEBAS PUSTAKA",
                'laporan' => $model,
            ];
            
            return view('laporan/v_pusat', $data);
        }else{
            return redirect()->to(base_url('Dashboard_mhs'));       
        }
    }


    
}