<?php

namespace App\Controllers\Backend;
use App\Controllers\BaseController;
use App\Models\M_valid_mhs;
use App\Models\M_berkas_wajib;
use App\Models\M_status_akhir;

class Validasi_pusat extends BaseController
{
    function __construct()
	{        
     $this->valid_mhs = new M_valid_mhs();   
     $this->db_berkas = new M_berkas_wajib();   
     $this->status_akhir = new M_status_akhir();   
	}
 
    public function valid_pusat($npm){
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
            
            return view('validasi_data/v_pem_pusat', $data);
        }
    }

   
    public function lengkap_pusat($npm){
            if(session()->get('username')=='')  {
                    session()->setFlashdata('massage', '<div class="alert alert-danger" role="alert">
                    Silahkan Login </div>');
                    return redirect()->to(base_url('Rumahku')); 
                } 
            else{

                $data = [
                    'catatan_pusat' => null,
                    'validasi_peminjaman_pusat' => '1',
                    'updated_at' => date('Y-m-d  h:i:s')
                ];
                $this->db_berkas->update_data($data, $npm);


                $data = $this->db->query("SELECT * FROM tb_berkas_wajib WHERE npm='$npm'")->getrow();
                $a="";
                if($data->jenis_TA == 'LTA' || $data->jenis_TA == 'SKRIPSI'){
                    if($data->validasi_TA == '1' && $data->hard_TA == '1' && $data->validasi_jurnal == '1' && $data->validasi_peminjaman_unit == '1' && $data->validasi_peminjaman_pusat == '1') {
                        $a = 'Selesai';
                    }
                }
                elseif($data->jenis_TA == 'TESIS' || $data->jenis_TA == 'DISERTASI')
                {
                    if($data->validasi_TA == '1' && $data->hard_TA == '1' && $data->validasi_jurnal == '1' && $data->validasi_sumbangan == '1' && $data->validasi_peminjaman_unit == '1' && $data->validasi_peminjaman_pusat == '1') {
                        $a = 'Selesai';
                    }
                }

                $data1 = [
                    'status' => $a,
                    'updated_at' => date('Y-m-d  h:i:s')
                ];
                $this->status_akhir->update_data($data1, $npm);

                    session()->setFlashdata('message', '<div class="alert alert-success" role="alert">
                    Data Validasi Peminjaman pusat Berhasil Di Verifikasi </div>');
                    $data = [
                        'title' => "BEBAS PUSTAKA",
                        'data_mhs' => $this->valid_mhs->dataMhs($npm),
                        'validation' => $this->validation,
                    ];
        
                    return view('validasi_data/v_detail_mhs', $data);
                }
    }

    public function belum_lengkap_pusat(){
        if(session()->get('username')=='')  {
            session()->setFlashdata('massage', '<div class="alert alert-danger" role="alert">
            Silahkan Login </div>');
            return redirect()->to(base_url('Rumahku')); 
        } else{
            $npm = $this->request->getPost('npm');
            $data = [
                'catatan_pusat' => $this->request->getPost('catatan'),
                'validasi_peminjaman_pusat' => '0',
                'updated_at' => date('Y-m-d  h:i:s')
            ];
            $this->db_berkas->update_data($data, $npm);


                $dataa = $this->db->query("SELECT * FROM tb_berkas_wajib WHERE npm='$npm'")->getrow();
                $a="";
                if($dataa->jenis_TA == 'LTA' || $dataa->jenis_TA == 'SKRIPSI'){
                    if($dataa->validasi_TA == '1' && $dataa->hard_TA == '1' && $dataa->validasi_jurnal == '1' && $dataa->validasi_peminjaman_unit == '1' && $dataa->validasi_peminjaman_pusat == '0') {
                       $a = "Belum Selesai";
                    }
                }
                elseif($dataa->jenis_TA == 'TESIS' || $dataa->jenis_TA == 'DISERTASI')
                {
                    if($dataa->validasi_TA == '1' && $dataa->hard_TA == '1' && $dataa->validasi_jurnal == '1' && $dataa->validasi_sumbangan == '1' && $dataa->validasi_peminjaman_unit == '1' && $dataa->validasi_peminjaman_pusat == '0') {
                        $a = "Belum Selesai";
                    }
                }

                $data1 = [
                    'status' => $a,
                    'updated_at' => date('Y-m-d  h:i:s')
                ];
                $this->status_akhir->update_data($data1, $npm);


                    session()->setFlashdata('message', '<div class="alert alert-success" role="alert">
                    Data Validasi Peminjaman pusat Di Verifikasi </div>');
                    $data = [
                        'title' => "BEBAS PUSTAKA",
                        'data_mhs' => $this->valid_mhs->dataMhs($npm),
                        'validation' => $this->validation,
                    ];
        
                    return view('validasi_data/v_detail_mhs', $data);
                }
                
    }






}