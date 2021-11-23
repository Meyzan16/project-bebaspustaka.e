<?php

namespace App\Controllers\Backend;
use App\Models\M_berkas_wajib;
use App\Models\M_mahasiswa;
use App\Models\M_valid_mhs;
use App\Models\M_valid_pusat;
use App\Models\M_berkas_tambahan;
use App\Models\M_status_akhir;
use App\Controllers\BaseController;

class Data_mhs extends BaseController
{
    function __construct()
	{        
     $this->valid_mhs = new M_valid_mhs(); 
     $this->pusat = new M_valid_pusat();   
     $this->berkas_wajib = new M_berkas_wajib();   
     $this->mhs = new M_mahasiswa();     
     $this->tb_tambahan = new M_berkas_tambahan();   
     $this->status_akhir = new M_status_akhir;
	$this->db = db_connect();
	}
 
    public function index(){
        if(session()->get('username')=='')  {
            session()->setFlashdata('massage', '<div class="alert alert-danger" role="alert">
            Silahkan Login </div>');
            return redirect()->to(base_url('Rumahku')); 
        } else{
            $data = [
                'title' => "BEBAS PUSTAKA",
                'data_unit' => $this->valid_mhs->getData(),
                'data_pusat' => $this->pusat->getData(),
                'validation' => $this->validation
            ];   
            return view('validasi_data/v_data_mhs', $data);
        }
    }

    //detail data berdasarkan npm
    public function detail_data($npm){
        if(session()->get('username')=='')  {
            session()->setFlashdata('massage', '<div class="alert alert-danger" role="alert">
            Silahkan Login </div>');
            return redirect()->to(base_url('Rumahku')); 
        } else{
            $data = [
                'title' => "BEBAS PUSTAKA",
                'data_mhs' => $this->valid_mhs->dataMhs($npm),
                'validation' => $this->validation,
            ];
            return view('validasi_data/v_detail_mhs', $data);
        }
    }
    
    //nampilkan data yang sudah lengkap di unit
    public function data_lengkap(){
        if(session()->get('username')=='')  {
            session()->setFlashdata('massage', '<div class="alert alert-danger" role="alert">
            Silahkan Login </div>');
            return redirect()->to(base_url('Rumahku')); 
        } else{

        $query = $this->valid_mhs->getDataLengkap();
            $data = [
                'title' => "BEBAS PUSTAKA",
                'data_lengkap' => $query,
                'validation' => $this->validation
            ];
            
            return view('validasi_data/v_data_lengkap', $data);
        }
    }

    //menampilkan prodi-prodi berdasarkan kode fakultas masing-masing
    public function detail_prodi($kode_fakultas){
        if(session()->get('username')=='')  {
            session()->setFlashdata('massage', '<div class="alert alert-danger" role="alert">
            Silahkan Login </div>');
            return redirect()->to(base_url('Rumahku')); 
        } else{
        $data = [
            'title' => "BEBAS PUSTAKA",
            'data_prodi' => $this->pusat->getProdi($kode_fakultas),
            'validation' => $this->validation,
        ];     
        return view('validasi_data/v_detail_prodi', $data);
    }
    }


    //menampilkan mahasiswa di prodi masing-masing
    public function detail_prodi_mhs($kode_prodi){
        if(session()->get('username')=='')  {
            session()->setFlashdata('massage', '<div class="alert alert-danger" role="alert">
            Silahkan Login </div>');
            return redirect()->to(base_url('Rumahku')); 
        } else{
            $query = $this->pusat->getMhsprodi($kode_prodi);
            
            $data = [
                'title' => 'BEBAS PUSTAKA',
                'data_mhsprodi' => $query,
                'validation' => $this->validation,
            ];
            return view('validasi_data/v_detail_mhsprodi', $data);
        }
    }

    public function hapus_Mhs(){

      

       $npm = $this->request->getPost('npm');
       $query = $this->tb_tambahan->queryHps($npm);

       $kode_prodi = $this->request->getPost('kode_prodi');
        if(isset($_POST['hapus'])){
            $delete = $this->mhs->hapus($npm);
            $delete = $this->berkas_wajib->hapus($npm);
	        $delete = $this->tb_tambahan->hapus($npm);
            $delete = $this->status_akhir->hapus($npm);
	 
                if($delete){
                   	session()->setFlashdata('message', '<div class="alert alert-success" role="alert">
                    		Data Berhasil DiHapus </div>');
                	return redirect()->to(base_url('Backend/Data_mhs/detail_prodi_mhs/'.$kode_prodi));
                }

        }else {
            return redirect()->to(base_url('Backend/Data_mhs'));
        }

    }

    public function hapus_Mhs_lengkap(){
        $npm = $this->request->getPost('npm');
        // $kode_prodi = $this->request->getPost('kode_prodi');
         if(isset($_POST['hapus'])){
             $delete = $this->mhs->hapus($npm);
             $delete = $this->berkas_wajib->hapus($npm);
 
                 if($delete){
                     session()->setFlashdata('message', '<div class="alert alert-success" role="alert">
                     Data Berhasil DiHapus </div>');
                 return redirect()->to(base_url('Backend/Data_mhs/data_lengkap'));
                 }
 
         }else {
             return redirect()->to(base_url('Backend/Data_mhs'));
         }
 
     }



}