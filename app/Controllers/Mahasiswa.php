<?php

namespace App\Controllers;
use App\Models\M_mahasiswa;
use App\Models\M_berkas_wajib;
use App\Models\M_berkas_tambahan;

class Mahasiswa extends BaseController
{
    function __construct()
	{        
     $this->db_mahasiswa = new M_mahasiswa(); 
     $this->db_berkas = new M_berkas_wajib();     
     $this->berkas_tambahan = new M_berkas_tambahan();   
	}


        public function index(){
            if(session()->get('cek_portal') =='')  {
                session()->setFlashdata('message', '<div class="alert alert-danger" role="alert">
                Silahkan Login </div>');
                return redirect()->to(base_url('Auth')); 
            } else{     
                if(isset($_POST['lengkapi_data'])){

                    $data = [
                        'title' => "BEBAS PUSTAKA",
                        'sub_title' => 'FORM LENGKAPI DATA',
                        'data_berkas' => $this->db_berkas->getData(),
                        'validation' => $this->validation
                    ];
        
                    return view('mhs/v_form_lengkapidata', $data);
                    
                }else{
                    return redirect()->to(base_url('Dashboard_mhs'));
                    
                }
        }
    }

         public function update_judul()
        { 
                $npm = session()->get('npm');
                $data = array(
                    'judul_TA' => $this->request->getPost('judul_ta'),
                    'judul_jurnal' => $this->request->getPost('judul_jurnal'),
                    'updated_at' => date('Y-m-d  H:i:s')
                );
                    $this->db_berkas->update_data($data, $npm);

                    session()->setFlashdata('message', '<div class="alert alert-success" role="alert">
                    Judul Berhasil Terdaftar </div>');
                    
                    $data = [
                        'title' => "BEBAS PUSTAKA",
                        'sub_title' => 'FORM LENGKAPI DATA',
                        'data_berkas' => $this->db_berkas->getData(),
                        'validation' => $this->validation
                    ];
        
                    return view('mhs/v_form_lengkapidata', $data);
      
        }

        public function upload_file(){  
               
            if(isset($_POST['upload'])){
                $data = [
                    'title' => "BEBAS PUSTAKA",
                    'sub_title' => 'UPLOAD FILE',
                    'validation' => $this->validation
                ];
                
                return view('mhs/v_upload_file', $data);
            }else{
                return redirect()->to(base_url('Dashboard_mhs'));
                
            }
        }

        public function file_jurnal()
        { 
                    $valid = $this->validate([
                        'file_ta' => [
                            'rules' => 'max_size[file_ta,2048]|ext_in[file_ta,pdf]|mime_in[file_ta,application/pdf]',
                            'errors' => [
                                    'max_size' => 'Ukuran file maksimal 2mb',
                                    'ext_in' => 'Yang anda pilih bukan file pdf',
                                    'mime_in' => 'Yang anda pilih bukan gambar'
                            ]              
                        ] 
                    ]);

                    if(!$valid) {  
                        session()->setFlashdata('gagal', $this->validation->listErrors() );
                        $data = [
                            'title' => "BEBAS PUSTAKA",
                            'sub_title' => 'UPLOAD FILE',
                            'validation' =>  $this->validation
                        ];
                        return view('mhs/v_upload_file', $data);
                
                    } 
                    else {
                        $npm = session()->get('npm');
                        // ambil file nyo 
                        $fileTA = $this->request->getFile('file_ta');
                        //generate fili ta
                        $namaFile = rand(10000, 99999).'_'.$fileTA->getName();
         
                        //pindahkan ke public
                        $fileTA->move('file_mhs/file_ta', $namaFile);


                       $data = array(
                           'file_TA' => $namaFile,
                           'updated_at' => date('Y-m-d  H:i:s')
                       );
                        
                           $this->db_berkas->update_data($data, $npm);
                           
                           $data = [
                               'title' => "BEBAS PUSTAKA",
                               'sub_title' => 'UPLOAD FILE',
                               'validation' => $this->validation
                            ];
                            
                            // session()->setFlashdata('message', '<div class="alert alert-success" role="alert">
                            // Silahkan Upload File Berikutnya </div>');
                            return view('mhs/v_upload_file', $data);
                           
                   }

        }

        public function file_sumbangan()
        { 
            if(session()->get('cek_portal') =='')  {
                session()->setFlashdata('message', '<div class="alert alert-danger" role="alert">
                Silahkan Login </div>');
                return redirect()->to(base_url('Auth')); 
            } else{ 
        
                    $valid = $this->validate([
                        'file_jurnal' => [
                            'rules' => 'max_size[file_jurnal,2048]|ext_in[file_jurnal,pdf]|mime_in[file_jurnal,application/pdf]',
                            'errors' => [
                                    'max_size' => 'Ukuran file maksimal 2mb',
                                    'ext_in' => 'Yang anda pilih bukan file pdf',
                                    'mime_in' => 'Yang anda pilih bukan gambar'
                            ]              
                        ] 
                    ]);

                    if(!$valid) {  
                        session()->setFlashdata('gagal', $this->validation->listErrors() );
                        $data = [
                            'title' => "BEBAS PUSTAKA",
                            'sub_title' => 'UPLOAD FILE',
                            'validation' =>  $this->validation
                        ];
                        return view('mhs/v_upload_file', $data);
                
                    } 
                    else {
                        $npm = session()->get('npm');
                        // ambil file nyo 
                        $file_jurnal = $this->request->getFile('file_jurnal');
                        //generate fili ta
                        $namaFile = rand(10000, 99999).'_'.$file_jurnal->getName();
                        //pindahkan ke public
                        $file_jurnal->move('file_mhs/file_jurnal', $namaFile);


                       $data = array(
                           'file_jurnal' => $namaFile,
                           'updated_at' => date('Y-m-d  H:i:s')
                       );
                        
                           $this->db_berkas->update_data($data, $npm);

                           
                           $data = [
                               'title' => "BEBAS PUSTAKA",
                               'sub_title' => 'UPLOAD FILE',
                               'validation' => $this->validation
                            ];

                            $npm = session()->get('npm'); 
                            $data1 = $this->db->query("SELECT * FROM tb_berkas_wajib WHERE npm='$npm' ")->getRowarray();

                                if($data1['jenis_TA'] == 'TESIS' || $data1['jenis_TA'] == 'DISERTASI') {
                                    return view('mhs/v_upload_file', $data);
                                } else if($data1['jenis_TA'] == 'SKRIPSI' || $data1['jenis_TA'] == 'LTA') {
                                    session()->setFlashdata('message', '<div class="alert alert-success" role="alert">
                                    Semua File Yang Dibutuhkan Sudah Terdaftar, Silahkan Menghubungi Operator Perpus Di Fakultas Anda Untuk Diverifikasi</div>');
                                    return view('mhs/v_profil', $data);  
                                }                       
                           
                   }
                }

        }

        public function file_selesai()
        { 
                    $valid = $this->validate([
                        'file_sumbangan' => [
                            'rules' => 'max_size[file_sumbangan,2048]|ext_in[file_sumbangan,pdf]|mime_in[file_sumbangan,application/pdf]',
                            'errors' => [
                                    'max_size' => 'Ukuran file maksimal 2mb',
                                    'ext_in' => 'Yang anda pilih bukan file pdf',
                                    'mime_in' => 'Yang anda pilih bukan gambar'
                            ]              
                        ] 
                    ]);

                    if(!$valid) {  
                        session()->setFlashdata('gagal', $this->validation->listErrors() );
                        $data = [
                            'title' => "BEBAS PUSTAKA",
                            'sub_title' => 'UPLOAD FILE',
                            'validation' =>  $this->validation
                        ];
                        return view('mhs/v_upload_file', $data);
                
                    } 
                    else {
                        $npm = session()->get('npm');
                        // ambil file nyo 
                        $file_sumbangan = $this->request->getFile('file_sumbangan');
                        //generate fili ta
                        $namaFile = rand(10000, 99999).'_'.$file_sumbangan->getName();
                        //pindahkan ke public
                        $file_sumbangan->move('file_mhs/file_sumbangan', $namaFile);
                        $data = array(
                            'file_sumbangan' => $namaFile,
                            'updated_at' => date('Y-m-d  H:i:s')
                        );
                            $this->db_berkas->update_data($data, $npm);
                           $data = [
                               'title' => "BEBAS PUSTAKA",
                               'sub_title' => 'UPLOAD FILE',
                               'validation' => $this->validation
                            ];
                            session()->setFlashdata('message', '<div class="alert alert-success" role="alert">
                            Semua File Yang Dibutuhkan Sudah Terdaftar, Silahkan Menghubungi Operator Perpus Di Fakultas Anda Untuk Diverifikasi</div>');
                            return view('mhs/v_profil', $data);                          
                   }

        }

        public function perbaki_file(){

            if(isset($_POST['perbaiki'])){
                $data = [
                    'title' => "BEBAS PUSTAKA",
                    'sub_title' => 'PERBAKI FILE',
                    'validation' => $this->validation
                ];
                
                return view('mhs/v_perbaki_file', $data);
            }else{
                return redirect()->to(base_url('Dashboard_mhs'));
                
            }
        }

        public function perbaki_file_ta()
        { 
          if(isset($_POST['perbaiki1'])){  
                    $npm = session()->get('npm');

                    $valid = $this->validate([
                        'file_ta' => [
                            'rules' => 'max_size[file_ta,2048]|ext_in[file_ta,pdf]|mime_in[file_ta,application/pdf]',
                            'errors' => [
                                    'max_size' => 'Ukuran file Maksimal 2 Mb',
                                    'ext_in' => 'Yang anda pilih bukan file pdf',
                                    'mime_in' => 'Yang anda pilih bukan file pdf'
                            ]              
                        ] 
                    ]);

                    if(!$valid) {  
                        session()->setFlashdata('gagal', $this->validation->listErrors() );
                        $data = [
                            'title' => "BEBAS PUSTAKA",
                            'sub_title' => 'PERBAKI FILE',
                            'validation' =>  $this->validation
                        ];
                        return view('mhs/v_perbaki_file', $data);
                
                    } 
                    else {
                             //ambil file
                            $filefile = $this->request->getFile('file_ta');
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
                                'file_TA' => $nama_file,
                                'updated_at' => date('Y-m-d  H:i:s')
                            );
                        
                           $this->db_berkas->update_data($data, $npm);

                           
                           $data = [
                               'title' => "BEBAS PUSTAKA",
                               'sub_title' => 'PERBAKI FILE',
                               'validation' => $this->validation
                            ];  
                            session()->setFlashdata('message', '<div class="alert alert-success" role="alert">
                            File Berhasil Di Perbarui </div>');
                            return view('mhs/v_perbaki_file', $data);
                           
                   }
            }else {
                 return redirect()->to(base_url('Dashboard_mhs'));
            }

        }

        public function perbaki_file_jurnal()
        { 
            if(isset($_POST['perbaiki2'])){ 
                    $npm = session()->get('npm');

                    $valid = $this->validate([
                        'file_jurnal' => [
                            'rules' => 'max_size[file_jurnal,2048]|ext_in[file_jurnal,pdf]|mime_in[file_jurnal,application/pdf]',
                            'errors' => [
                                    'max_size' => 'Ukuran file Maksimal 2 Mb',
                                    'ext_in' => 'Yang anda pilih bukan file pdf',
                                    'mime_in' => 'Yang anda pilih bukan file pdf'
                            ]              
                        ] 
                    ]);

                    if(!$valid) {  
                        session()->setFlashdata('gagal', $this->validation->listErrors() );
                        $data = [
                            'title' => "BEBAS PUSTAKA",
                            'sub_title' => 'PERBAKI FILE',
                            'validation' =>  $this->validation
                        ];
                        return view('mhs/v_perbaki_file', $data);
                
                    } 
                    else {
                             //ambil file
                            $filefile = $this->request->getFile('file_jurnal');
                            //cek file, apakah tetap file lama               
                            if($filefile->getError() == 4)
                            {
                                $namafile = $this->request->getVar('fileLama');
                            } else {
                                //generate nama foto
                                $namafile = rand(10000, 99999).'_'.$filefile->getName();
                                //pindahkan file ke public dan file baru
                                $filefile->move('file_mhs/file_jurnal/', $namafile);
                                //hapus file yang lama
                                unlink('file_mhs/file_jurnal/' . $this->request->getVar('fileLama'));       
                            }
                            
                            //jika validasi berhasil              
                            $nama_file = $namafile; 
                            $data = array(
                                'file_jurnal' => $nama_file,
                                'updated_at' => date('Y-m-d  H:i:s')
                            );
                        
                           $this->db_berkas->update_data($data, $npm);

                           
                           $data = [
                               'title' => "BEBAS PUSTAKA",
                               'sub_title' => 'PERBAKI FILE',
                               'validation' => $this->validation
                            ];  
                            session()->setFlashdata('message', '<div class="alert alert-success" role="alert">
                            File Berhasil Di Perbarui </div>');
                            return view('mhs/v_perbaki_file', $data);
                           
                   }
            }else {
                 return redirect()->to(base_url('Dashboard_mhs'));
            }

        }

        public function perbaki_file_sumbangan()
        { 
            if(isset($_POST['perbaiki3'])) {
                    $npm = session()->get('npm');

                    $valid = $this->validate([
                        'file_sumbangan' => [
                            'rules' => 'max_size[file_sumbangan,2048]|ext_in[file_sumbangan,pdf]|mime_in[file_sumbangan,application/pdf]',
                            'errors' => [
                                    'max_size' => 'Ukuran file Maksimal 2 Mb',
                                    'ext_in' => 'Yang anda pilih bukan file pdf',
                                    'mime_in' => 'Yang anda pilih bukan file pdf'
                            ]              
                        ] 
                    ]);

                    if(!$valid) {  
                        session()->setFlashdata('gagal', $this->validation->listErrors() );
                        $data = [
                            'title' => "BEBAS PUSTAKA",
                            'sub_title' => 'PERBAKI FILE',
                            'validation' =>  $this->validation
                        ];
                        return view('mhs/v_perbaki_file', $data);
                
                    } 
                    else {
                             //ambil file
                            $filefile = $this->request->getFile('file_sumbangan');
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
                                'updated_at' => date('Y-m-d  H:i:s')
                            );
                        
                           $this->db_berkas->update_data($data, $npm);

                           
                           $data = [
                               'title' => "BEBAS PUSTAKA",
                               'sub_title' => 'PERBAKI FILE',
                               'validation' => $this->validation
                            ];  
                            session()->setFlashdata('message', '<div class="alert alert-success" role="alert">
                            File Berhasil Di Perbarui </div>');
                            return view('mhs/v_perbaki_file', $data);
                           
                   }
            }else {
                 return redirect()->to(base_url('Dashboard_mhs'));
            }

        }

        public function berkas_tambahan(){
            if(isset($_POST['berkas_tambahan'])){
                $data = [
                    'title' => "BEBAS PUSTAKA",
                    'sub_title' => 'BERKAS TAMBAHAN',
                    'validation' => $this->validation
                ];
                
                return view('mhs/v_berkas_tambahan', $data);
            }else{
                return redirect()->to(base_url('Dashboard_mhs'));
                
            }
        }

        public function simpan_berkas_tambahan(){
            $valid = $this->validate([
                        'file' => [
                            'rules' => 'max_size[file,2048]|ext_in[file,pdf]|mime_in[file,application/pdf]',
                            'errors' => [
                                    'max_size' => 'Ukuran file maksimal 2mb',
                                    'ext_in' => 'Yang anda pilih bukan file pdf',
                                    'mime_in' => 'Yang anda pilih bukan gambar'
                            ]              
                        ] 
                    ]);

                    if(!$valid) {  
                        $data = [
                            'title' => "BEBAS PUSTAKA",
                            'sub_title' => 'BERKAS TAMBAHAN',
                            'validation' => $this->validation
                        ];
                        
                        return view('mhs/v_berkas_tambahan', $data);
                
                    } 
                    else {
                        $id_pengguna = $this->request->getPost('id_pengguna');
                        $id_jenis_berkas = $this->request->getPost('jenis_berkas');
                        $npm = $this->request->getPost('npm');
                        $file = $this->request->getFile('file');
                 
            
                        //generate file ta
                        $namaFile = rand(10000, 99999).'_'.$file->getName();
                        //pindahkan ke public
                        $file->move('file_mhs/berkas_tambahan', $namaFile);


                       $this->berkas_tambahan->save([
                            'id_pengguna' => $id_pengguna,
                            'id_jenis_berkas' => $id_jenis_berkas,
                            'npm' => $npm,
                            'file_berkas' => $namaFile,
                            'validasi_berkas' => '0',
                            'status_berkas' => 'aktif'
                            
                            ]);

                            session()->setFlashdata('message', '<div class="alert alert-success" role="alert">
                                        Berkas Tambahan Berhasil Di Tambahkan</div>');
                                        return redirect()->to(base_url('Mahasiswa'));
                           
                   }

               

                
        }

         public function perbaki_file_berkas_tambahan()
        { 

            if(session()->get('cek_portal') =='')  {
                session()->setFlashdata('message', '<div class="alert alert-danger" role="alert">
                Silahkan Login </div>');
                return redirect()->to(base_url('Auth')); 
            } else{     

                    $npm = session()->get('npm');

                    $valid = $this->validate([
                        'file_berkas_tambahan' => [
                            'rules' => 'max_size[file_berkas_tambahan,2048]|ext_in[file_berkas_tambahan,pdf]|mime_in[file_berkas_tambahan,application/pdf]',
                            'errors' => [
                                    'max_size' => 'Ukuran file Maksimal 2 Mb',
                                    'ext_in' => 'Yang anda pilih bukan file pdf',
                                    'mime_in' => 'Yang anda pilih bukan file pdf'
                            ]              
                        ] 
                    ]);

                    if(!$valid) {  
                        session()->setFlashdata('gagal', $this->validation->listErrors() );
                        $data = [
                            'title' => "BEBAS PUSTAKA",
                            'sub_title' => 'PERBAKI FILE',
                            'validation' =>  $this->validation
                        ];
                        return view('mhs/v_perbaki_file', $data);
                
                    } 
                    else {
                             //ambil file
                            $filefile = $this->request->getFile('file_berkas_tambahan');
                           
                            //cek file, apakah tetap file lama               
                            if($filefile->getError() == 4)
                            {
                                
                                $namafile = $this->request->getVar('fileLama');
                            } else {
                                //generate nama foto
                                $namafile = rand(10000, 99999).'_'.$filefile->getName();
                                //pindahkan file ke public dan file baru
                                $filefile->move('file_mhs/berkas_tambahan/', $namafile);
                                //hapus file yang lama
                                unlink('file_mhs/berkas_tambahan/' . $this->request->getVar('fileLama'));                                
                            }

                            $valid = '';
                            $b_t = $this->berkas_tambahan->dataMhs($npm);

                            foreach ($b_t as $data1) {
                                    if($data1['validasi_berkas'] == 0 && $data1['catatan_berkas']== '') {
                                        $valid = '0';
                                    }else if($data1['validasi_berkas'] == 0 && $data1['catatan_berkas'] != '') {
                                        $valid = '1';
                                    } else if($data1['validasi_berkas'] == 1 && $data1['catatan_berkas'] != '') {
                                        $valid = '1';
                                    }

                                }
                            
                            //jika validasi berhasil              
                            $nama_file = $namafile; 
                            $data = array(
                                'file_berkas' => $nama_file,
                                'validasi_berkas' => $valid,
                                'updated_at' => date('Y-m-d  H:i:s')
                            );
                        
                           $this->berkas_tambahan->update_data($data, $npm);

                           
                           $data = [
                               'title' => "BEBAS PUSTAKA",
                               'sub_title' => 'PERBAKI FILE',
                               'validation' => $this->validation
                            ];  
                            session()->setFlashdata('message', '<div class="alert alert-success" role="alert">
                            File Berhasil Di Perbarui </div>');
                            return view('mhs/v_perbaki_file', $data);
                           
                   }
                }

        }






    
}