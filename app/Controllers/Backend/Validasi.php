<?php

namespace App\Controllers\Backend;
use App\Controllers\BaseController;
use App\Models\M_valid_mhs;
use App\Models\M_berkas_wajib;

class Validasi extends BaseController
{
    function __construct()
	{        
     $this->valid_mhs = new M_valid_mhs();   
     $this->db_berkas = new M_berkas_wajib();      
	}
 
    public function valid_ta($npm){
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
            
            return view('validasi_data/v_data_ta', $data);
        }
    }

    public function valid_hard_file($npm){
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
            
            return view('validasi_data/v_hard_file', $data);
        }
    }

    public function lengkap_ta($npm){
        if(session()->get('username')=='')  {
            session()->setFlashdata('massage', '<div class="alert alert-danger" role="alert">
            Silahkan Login </div>');
            return redirect()->to(base_url('Rumahku')); 
        } else{

        $data = [
            'catatan_ta' => null,
            'validasi_TA' => '1',
            'updated_at' => date('Y-m-d  h:i:s')
        ];

                    $this->db_berkas->update_data($data, $npm);
                    session()->setFlashdata('message', '<div class="alert alert-success" role="alert">
                    Data Validasi Tugas Akhir Berhasil Di Verifikasi </div>');
                    $data = [
                        'title' => "BEBAS PUSTAKA",
                        'data_mhs' => $this->valid_mhs->dataMhs($npm),
                        'validation' => $this->validation,
                    ];
        
                    return view('validasi_data/v_detail_mhs', $data);
                }   

    }

    public function belum_lengkap_ta(){
        if(session()->get('username')=='')  {
            session()->setFlashdata('massage', '<div class="alert alert-danger" role="alert">
            Silahkan Login </div>');
            return redirect()->to(base_url('Rumahku')); 
        } else{

            $npm = $this->request->getPost('npm');
            //$filefile = $this->request->getFile('file');
            unlink('file_mhs/file_ta/' . $this->request->getVar('fileLama'));

            $data = [
                'file_TA' => null,
                'catatan_ta' => $this->request->getPost('catatan'),
                'validasi_TA' => '0',
                'updated_at' => date('Y-m-d  h:i:s')
            ];
                        $this->db_berkas->update_data($data, $npm);

                        session()->setFlashdata('message', '<div class="alert alert-success" role="alert">
                        Data Validasi Tugas Akhir Berhasil Di Verifikasi </div>');
                        $data = [
                            'title' => "BEBAS PUSTAKA",
                            'data_mhs' => $this->valid_mhs->dataMhs($npm),
                            'validation' => $this->validation,
                        ];
            
                        return view('validasi_data/v_detail_mhs', $data);
                    }
    }

    public function update_data_ta(){

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
        
        return view('validasi_data/v_data_ta', $data);
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
              $filefile->move('file_mhs/file_ta/', $namafile);
              //hapus file yang lama
              unlink('file_mhs/file_ta/' . $this->request->getVar('fileLama'));
         
          }
          
          //jika validasi berhasil              
          $nama_file = $namafile; 
          $data = array(
                  'judul_TA' => $this->request->getPost('judul'),
                  'file_TA' => $nama_file,
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
            
            return view('validasi_data/v_data_ta', $data);
              
          }        
    }


    public function lengkap_hard($npm){
        if(session()->get('username')=='')  {
            session()->setFlashdata('massage', '<div class="alert alert-danger" role="alert">
            Silahkan Login </div>');
            return redirect()->to(base_url('Rumahku')); 
        } else{

        $data = [
            'hard_TA' => '1',
            'catatan_hard_file' => null,
            'updated_at' => date('Y-m-d  H:m:s')
        ];
                    $this->db_berkas->update_data($data, $npm);

                    session()->setFlashdata('message', '<div class="alert alert-success" role="alert">
                    Data Hard Tugas Akhir Berhasil Di Verifikasi </div>');
                    $data = [
                        'title' => "BEBAS PUSTAKA",
                        'data_mhs' => $this->valid_mhs->dataMhs($npm),
                        'validation' => $this->validation,
                    ];
        
                    return view('validasi_data/v_detail_mhs', $data);
                    
                }
    }

    public function belum_lengkap_hard(){

        $npm = $this->request->getPost('npm');
        if(session()->get('username')=='')  {
            session()->setFlashdata('massage', '<div class="alert alert-danger" role="alert">
            Silahkan Login </div>');
            return redirect()->to(base_url('Rumahku')); 
        } else{

        $data = [
            'hard_TA' => '0',
            'catatan_hard_file' => $this->request->getPost('catatan'),
            'updated_at' => date('Y-m-d  H:i:s')
        ];
                    $this->db_berkas->update_data($data, $npm);

                    session()->setFlashdata('message', '<div class="alert alert-success" role="alert">
                    Data Hard Tugas Akhir Berhasil Di Verifikasi </div>');
                    $data = [
                        'title' => "BEBAS PUSTAKA",
                        'data_mhs' => $this->valid_mhs->dataMhs($npm),
                        'validation' => $this->validation,
                    ];
        
                    return view('validasi_data/v_detail_mhs', $data);
     
                }
    }



}