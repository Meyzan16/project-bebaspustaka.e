<?php

namespace App\Controllers\Backend;
use App\Controllers\BaseController;
use App\Models\M_valid_mhs;
use App\Models\M_berkas_wajib;

class Validasi_unit extends BaseController
{
    function __construct()
	{        
     $this->valid_mhs = new M_valid_mhs();   
     $this->db_berkas = new M_berkas_wajib();      
	}
 
    public function valid_unit($npm){
        if(session()->get('username')=='')  {
            session()->setFlashdata('massage', '<div class="alert alert-danger" role="alert">
            Silahkan Login </div>');
            return redirect()->to(base_url('Rumahku')); 
        } else{
        
            $data = [
                'title' => "BEBAS PUSTAKA",
                'data_mhs' => $this->valid_mhs->dataMhs($npm),
                'validation' => $this->validation
            ];
            
            return view('validasi_data/v_pem_unit', $data);
        }
    }

   
    public function lengkap_unit($npm){
        if(session()->get('username')=='')  {
            session()->setFlashdata('massage', '<div class="alert alert-danger" role="alert">
            Silahkan Login </div>');
            return redirect()->to(base_url('Rumahku')); 
        } else{
            

        $data = [
            'catatan_unit' => null,
            'validasi_peminjaman_unit' => '1',
            'updated_at' => date('Y-m-d  h:i:s')
        ];
                    $this->db_berkas->update_data($data, $npm);

                    session()->setFlashdata('message', '<div class="alert alert-success" role="alert">
                    Data Validasi Peminjaman Unit Berhasil Di Verifikasi </div>');
                    $data = [
                        'title' => "BEBAS PUSTAKA",
                        'data_mhs' => $this->valid_mhs->dataMhs($npm),
                        'validation' => $this->validation,
                    ];
        
                    return view('validasi_data/v_detail_mhs', $data);
                }
    }

    public function belum_lengkap_unit(){
        if(session()->get('username')=='')  {
            session()->setFlashdata('massage', '<div class="alert alert-danger" role="alert">
            Silahkan Login </div>');
            return redirect()->to(base_url('Rumahku')); 
        } else{
            $npm = $this->request->getPost('npm');
        $data = [
            'catatan_unit' => $this->request->getPost('catatan'),
            'validasi_peminjaman_unit' => '0',
            'updated_at' => date('Y-m-d  h:i:s')
        ];
                    $this->db_berkas->update_data($data, $npm);

                    session()->setFlashdata('message', '<div class="alert alert-success" role="alert">
                    Data Validasi Peminjaman Unit Di Verifikasi </div>');
                    $data = [
                        'title' => "BEBAS PUSTAKA",
                        'data_mhs' => $this->valid_mhs->dataMhs($npm),
                        'validation' => $this->validation,
                    ];
        
                    return view('validasi_data/v_detail_mhs', $data);
                }
                
    }






}