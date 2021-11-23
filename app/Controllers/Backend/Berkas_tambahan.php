<?php 

namespace App\Controllers\Backend;
use App\Controllers\BaseController;
use App\Models\M_jenis_berkas;
use App\Models\M_pengguna_berkas;
use App\Models\M_berkas_tambahan;
use App\Models\M_valid_mhs;


class Berkas_tambahan extends BaseController
{
    function __construct()
    {
        $this->berkas_tambahan = new M_jenis_berkas();
        $this->pengguna_berkas = new M_pengguna_berkas();
        $this->valid_mhs = new M_valid_mhs(); 
        $this->berkas_tambahan1 = new M_berkas_tambahan();   
    }

    public function index(){
        if(session()->get('username') == ''){
            session()->setFlashdata('massage', '<div class="alert alert-danger" role="alert">
            Silahkan Login </div>');
            return redirect()->to(base_url('Rumahku'));
        } else{
            $data = [
                'title' => "BEBAS PUSTAKA",
                'berkas_tambahan' => $this->pengguna_berkas->getData(),
                'validation' => $this->validation
            ];
            return  view('berkas_tambahan/v_data', $data);
        }

    }

    public function aktif($id_pengguna){
        if(session()->get('username')=='')  {
            session()->setFlashdata('massage', '<div class="alert alert-danger" role="alert">
            Silahkan Login </div>');
            return redirect()->to(base_url('Rumahku')); 
        } else{

        $data = [
            'is_active' => '1',
            'updated_at' => date('Y-m-d  h:i:s')
        ];
                    $this->pengguna_berkas->update_data($data, $id_pengguna);

                    session()->setFlashdata('message', '<div class="alert alert-success" role="alert">
                    Data Berkas Tambahan Berhasil Di Aktifkan </div>');
                    return redirect()->to(base_url('Backend/Berkas_tambahan'));
                }
    }

    public function non_aktif($id_pengguna){
        if(session()->get('username')=='')  {
            session()->setFlashdata('massage', '<div class="alert alert-danger" role="alert">
            Silahkan Login </div>');
            return redirect()->to(base_url('Rumahku')); 
        } else{
            
            $data = [
                'is_active' => '0',
                'updated_at' => date('Y-m-d  h:i:s')
            ];
                        $this->pengguna_berkas->update_data($data, $id_pengguna);

                        session()->setFlashdata('message', '<div class="alert alert-success" role="alert">
                        Data Berkas Tambahan Tidak Di Aktifkan </div>');
                        return redirect()->to(base_url('Backend/Berkas_tambahan'));
                    }
                
    }

    public function pengguna_berkas(){
        
        $berkas = $this->request->getPost('berkas');
        $fakultas = $this->request->getPost('fakultas');
        $prodi = $this->request->getPost('prodi');

        
        if($prodi) {
        $valid = $this->validate([
            'prodi' => [
                'rules' => 'is_unique[tb_pengguna_berkas.kode_prodi]',
                'errors' => [
                        'is_unique' => 'Nama prodi sudah digunakan'
                ]              
            ] 
        ]);
    
        if(!$valid) {  
            session()->setFlashdata('gagal', $this->validation->listErrors() );
            $data = [
                'title' => "BEBAS PUSTAKA",
                'berkas_tambahan' => $this->pengguna_berkas->getData(),
                'validation' => $this->validation
            ];
            return  view('berkas_tambahan/v_data', $data);
    
        } 
        else {
            $this->pengguna_berkas->save([
                'id_jenis_berkas' => $berkas,
                'kode_fakultas' => $fakultas,
                'kode_prodi' => $prodi,
                'is_active' => '0'
                
            ]);
    
            session()->setFlashdata('message', '<div class="alert alert-success" role="alert">
                            Data Pengguna Berkas Berhasil Di Tambahakan</div>');
                            return redirect()->to(base_url('Backend/Berkas_tambahan'));
        
        }

        }else{

            $valid = $this->validate([
                'fakultas' => [
                    'rules' => 'is_unique[tb_pengguna_berkas.kode_fakultas]',
                    'errors' => [
                            'is_unique' => 'Nama Fakultas sudah digunakan'
                    ]              
                ] 
            ]);
        
            if(!$valid) {  
                session()->setFlashdata('gagal', $this->validation->listErrors() );
                $data = [
                    'title' => "BEBAS PUSTAKA",
                    'berkas_tambahan' => $this->pengguna_berkas->getData(),
                    'validation' => $this->validation
                ];
                return  view('berkas_tambahan/v_data', $data);
        
            } 
            else {

                $this->pengguna_berkas->save([
                    'id_jenis_berkas' => $berkas,
                    'kode_fakultas' => $fakultas,
                    'kode_prodi' => $prodi,
                    'is_active' => '0'
                    
                ]);
        
                session()->setFlashdata('message', '<div class="alert alert-success" role="alert">
                                Data Pengguna Berkas Berhasil Di Tambahakan</div>');
                                return redirect()->to(base_url('Backend/Berkas_tambahan'));
            }
            
        }
    }

    public function hapus($id_pengguna){
      
        if(isset($_POST['hapus'])){
            
            $data = [
                'status_pengguna_berkas' => 'dihapus'
            ];

            $this->berkas_tambahan1->update_status($data, $id_pengguna);


            $delete = $this->pengguna_berkas->hapus($id_pengguna);
            // $delete = $this->berkas_tambahan1->hapusBerkas($id_pengguna);
                if($delete){
                session()->setFlashdata('massage', '<div class="alert alert-success" role="alert">
                        Data Berhasil Di Hapus</div>');
                return redirect()->to(base_url('Backend/Berkas_tambahan'));
                }

        }else {
            return redirect()->to(base_url('Backend/Berkas_tambahan'));
        }
    }

    public function create_berkas(){
        if(session()->get('username') == ''){
            session()->setFlashdata('massage', '<div class="alert alert-danger" role="alert">
            Silahkan Login </div>');
            return redirect()->to(base_url('Rumahku'));
        } else{
            $data = [
                'title' => "BEBAS PUSTAKA",
                'jenis_berkas' => $this->berkas_tambahan->getData(),
                'validation' => $this->validation
            ];
            return  view('berkas_tambahan/v_add_berkas', $data);
        }
    }

    public function add_berkas(){
        
        $nama_berkas = $this->request->getPost('nama');
        $catatan = $this->request->getPost('catatan');


        $this->berkas_tambahan->save([
            'nama_berkas' => $nama_berkas,
            'catatan' => $catatan,
            
        ]);

        session()->setFlashdata('message', '<div class="alert alert-success" role="alert">
                        Berkas Tambahan Berhasil Di Tambahkan</div>');
                        return redirect()->to(base_url('Backend/Berkas_tambahan/create_berkas'));
    }

    public function hapus_jenis_berkas($id_jenis_berkas){
      
        if(isset($_POST['hapus'])){
           
            $delete = $this->pengguna_berkas->hapus_jenis_berkas($id_jenis_berkas);      
            $delete = $this->berkas_tambahan->hapus($id_jenis_berkas);
            $delete = $this->berkas_tambahan1->hapusBerkas($id_jenis_berkas);
                
                if($delete){
                session()->setFlashdata('massage', '<div class="alert alert-success" role="alert">
                        Data Berhasil Di Hapus</div>');
                return redirect()->to(base_url('Backend/Berkas_tambahan/create_berkas'));
                }

        }else {
            return redirect()->to(base_url('Backend/Berkas_tambahan/create_berkas'));
        }
    }

    public function update_jenis_berkas(){

        $id_jenis_berkas = $this->request->getPost('id_jenis_berkas');
        $nama_berkas = $this->request->getPost('nama');
        $catatan = $this->request->getPost('catatan');


        $data = [
            'nama_berkas' => $nama_berkas,
            'catatan' => $catatan,
        ];

        $this->berkas_tambahan->update_data($data, $id_jenis_berkas);


        session()->setFlashdata('message', '<div class="alert alert-success" role="alert">
                        Berkas Tambahan Berhasil Di Tambahkan</div>');
                        return redirect()->to(base_url('Backend/Berkas_tambahan/create_berkas'));
    }

    public function validasi_berkas($npm){

         if(session()->get('username')=='')  {
            session()->setFlashdata('massage', '<div class="alert alert-danger" role="alert">
            Silahkan Login </div>');
            return redirect()->to(base_url('Rumahku')); 
        } else{
        
            $data = [
                'title' => "BEBAS PUSTAKA",
                'data_mhs' => $this->berkas_tambahan1->dataMhs($npm),
            ];
            
            return view('validasi_data/v_berkas_tambahan', $data);
        }

    }

    public function lengkap($npm){
         if(session()->get('username')=='')  {
            session()->setFlashdata('massage', '<div class="alert alert-danger" role="alert">
            Silahkan Login </div>');
            return redirect()->to(base_url('Rumahku')); 
        } else{

        $data = [
            'catatan_berkas' => null,
            'validasi_berkas' => '1',
            'updated_at' => date('Y-m-d  h:i:s')
        ];
                    $this->berkas_tambahan1->update_data($data, $npm);

                     $data = [
                        'title' => "BEBAS PUSTAKA",
                        'data_mhs' => $this->valid_mhs->dataMhs($npm),
                        'validation' => $this->validation,
                    ];
                    return view('validasi_data/v_detail_mhs', $data);
                }
    }

      public function nonlengkap(){
         if(session()->get('username')=='')  {
            session()->setFlashdata('massage', '<div class="alert alert-danger" role="alert">
            Silahkan Login </div>');
            return redirect()->to(base_url('Rumahku')); 
        } else{
            $npm = $this->request->getPost('npm');

            $data = [
                'catatan_berkas' => $this->request->getPost('catatan'),
                'validasi_berkas' => '0',
                'updated_at' => date('Y-m-d  h:i:s')
            ];
                    $this->berkas_tambahan1->update_data($data, $npm);

                     $data = [
                        'title' => "BEBAS PUSTAKA",
                        'data_mhs' => $this->valid_mhs->dataMhs($npm),
                        'validation' => $this->validation,
                    ];
                    return view('validasi_data/v_detail_mhs', $data);
                }
    }

    public function update_berkas(){
        
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
                'data_mhs' => $this->berkas_tambahan1->dataMhs($npm),
            ];
            
            return view('validasi_data/v_berkas_tambahan', $data);
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
              $namafile = $filefile->getName();
              //pindahkan file ke public dan file baru
              $filefile->move('file_mhs/berkas_tambahan/', $namafile);
              //hapus file yang lama
              unlink('file_mhs/berkas_tambahan/' . $this->request->getVar('fileLama'));       
          }
          
          //jika validasi berhasil              
          $nama_file = $namafile; 
          $data = array(
                  'file_berkas' => $nama_file,
                  'updated_at' => date('Y-m-d  h:i:s')                
           
              );
              

              $this->berkas_tambahan1->update_data($data, $npm);

              session()->setFlashdata('massage', '<div class="alert alert-success" role="alert">
              Data Berhasil di Ubah </div>');
                $data = [
                    'title' => "BEBAS PUSTAKA",
                    'data_mhs' => $this->berkas_tambahan1->dataMhs($npm),
                ];
                
                return view('validasi_data/v_berkas_tambahan', $data);
              
          }        
    }








}


?>