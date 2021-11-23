<?php

namespace App\Controllers\Backend;
use App\Controllers\BaseController;
use App\Models\M_valid_mhs;
use App\Models\M_berkas_wajib;

class Validasi_sum extends BaseController
{
    function __construct()
	{        
     $this->valid_mhs = new M_valid_mhs();   
     $this->db_berkas = new M_berkas_wajib();      
	}
 
    public function valid_sum($npm){
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
            
            return view('validasi_data/v_data_sum', $data);
        }
    }

   
    public function lengkap_sum($npm){
        if(session()->get('username')=='')  {
            session()->setFlashdata('massage', '<div class="alert alert-danger" role="alert">
            Silahkan Login </div>');
            return redirect()->to(base_url('Rumahku')); 
        } else{

        $data = [
            'catatan_sum' => null,
            'validasi_sumbangan' => '1',
            'updated_at' => date('Y-m-d  h:i:s')
        ];
                    $this->db_berkas->update_data($data, $npm);

                    session()->setFlashdata('message', '<div class="alert alert-success" role="alert">
                    Data Validasi Sumbangan Berhasil Di Verifikasi </div>');
                    $data = [
                        'title' => "BEBAS PUSTAKA",
                        'data_mhs' => $this->valid_mhs->dataMhs($npm),
                        'validation' => $this->validation,
                    ];
        
                    return view('validasi_data/v_detail_mhs', $data);
                }
    }

    public function belum_lengkap_sum(){
        if(session()->get('username')=='')  {
            session()->setFlashdata('massage', '<div class="alert alert-danger" role="alert">
            Silahkan Login </div>');
            return redirect()->to(base_url('Rumahku')); 
        } else{
             $npm = $this->request->getPost('npm');
            unlink('file_mhs/file_sumbangan/' . $this->request->getVar('fileLama'));

        $data = [
            'file_sumbangan' => null,
            'catatan_sum' => $this->request->getPost('catatan'),
            'validasi_sumbangan' => '0',
            'updated_at' => date('Y-m-d  h:i:s')
        ];
                    $this->db_berkas->update_data($data, $npm);

                    session()->setFlashdata('message', '<div class="alert alert-success" role="alert">
                    Data Validasi Sumbangan Berhasil Di Verifikasi </div>');
                    $data = [
                        'title' => "BEBAS PUSTAKA",
                        'data_mhs' => $this->valid_mhs->dataMhs($npm),
                        'validation' => $this->validation,
                    ];
        
                    return view('validasi_data/v_detail_mhs', $data);
                }
                
    }

    public function update_data_sum(){

        $npm = $this->request->getPost('npm');
        $valid = $this->validate([
            'file' => [
                'rules' => 'max_size[file,2048]|ext_in[file,pdf]|mime_in[file,application/pdf]',
                'errors' => [
                          'max_size' => 'Ukuran file Maksimal 2 MB ',
                          'ext_in' => 'Yang anda pilih bukan file pdf',
                          'mime_in' => 'Yang anda pilih bukan gambar'
                ]              
            ]  
      ]);
      //jika validasi gagal
      if(!$valid) {  
          session()->setFlashdata('gagal', $this->validation->listErrors() );
          $data = [
            'title' => "BEBAS PUSTAKA",
            'data_mhs' => $this->valid_mhs->dataMhs($npm),
            'validation' => $this->validation
        ];
        
        return view('validasi_data/v_data_sum', $data);
       } 
      
     else {
          //ambil file
          $filefile = $this->request->getFile('file');
          //cek file, apakah tetap file lama               
          if($filefile->getError() == 4)
          {
              $namafile = $this->request->getVar('fileLama');
          } else {
              //generate nama foto
              $namafile = rand(10000, 99999).'_'.$filefile->getName();
              //pindahkan file ke public dan file baru
              $filefile->move('file_mhs/file_sumbangan/', $namafile);
              //hapus file yang lama
              unlink('file_mhs/file_sumbangan/' . $this->request->getVar('fileLama'));
         
          }
          
          //jika validasi berhasil              
          $nama_file = $namafile; 
          $data = array(
                  'file_sumbangan' => $nama_file,
                  'updated_at' => date('Y-m-d  h:i:s')                
           
              );
              

              $this->db_berkas->update_data($data, $npm);

              session()->setFlashdata('massage', '<div class="alert alert-success" role="alert">
              Data Berhasil di Ubah </div>');
              $data = [
                'title' => "BEBAS PUSTAKA",
                'data_mhs' => $this->valid_mhs->dataMhs($npm),
                'validation' => $this->validation
            ];
            
            return view('validasi_data/v_data_sum', $data);
              
          }        
    }




}