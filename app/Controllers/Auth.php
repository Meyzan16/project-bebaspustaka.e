<?php

namespace App\Controllers;
use CodeIgniter\HTTP\Response;
use GuzzleHttp\Client;
use App\Models\M_mahasiswa;
use App\Models\M_berkas_wajib;
use App\Models\M_status_akhir;

class Auth extends BaseController
{

    function __construct()
	{        
     $this->db_mahasiswa = new M_mahasiswa(); 
     $this->db_berkas = new M_berkas_wajib(); 
     $this->status_akhir = new M_status_akhir();          
	}

    public function index(){
        if(isset($_POST['login'])){
                 $data = [
                'title' => "BEBAS PUSTAKA",
            ];

            return view('mhs/v_login', $data);
            }else{
                return redirect()->to(base_url('Home'));
                
            }
       
           
        
    }

    public function cek_login(){
		 if(isset($_POST['cek_login'])){
                    //ambil token
                    $client = new Client();   
                    $res =  $client->post('https://panda.unib.ac.id/api/login', 
                            [
                                'form_params' => [
                                    'email' => 'beasiswa.fkip@unib.ac.id', 
                                    'password' => 'J0V0vO9YCzB1'
                                ],
                            ]);
                    $token = json_decode($res->getBody())->token;

                    $client2 = new Client();
                    $username = $this->request->getVar('username');
                    $password = $this->request->getVar('password'); 
   

                    //cek username dan password
                    $res2 = $client2->get('https://panda.unib.ac.id/panda?token='.$token.'&query={
                        portallogin(username:"'.$username.'", password: "'.$password.'") 
                        {
                        is_access
                        tusrThakrId
                        }  }');

                    $body = $res2->getBody();
                    $body_array = json_decode($body);    
                    $cek_portal = $body_array->data->portallogin[0]->is_access;
                    session()->set('cek_portal', $cek_portal);
  
                    //cek jika username dan password 
                    if($cek_portal)
                    { 
                        //get Data mahasiswa
                        $getDatamhs = $client2->get('https://panda.unib.ac.id/panda?token='.$token.'&query={ 
                                    mahasiswa(mhsNiu:"'.$username.'") {
                                        mhsNiu
                                        mhsNama
                                        mhsJenisKelamin
                                        mhsTanggalLahir
                                        mhsTanggalLulus
                                        mhsProdiKode
                                            prodi {
                                            prodiFakKode
                                            prodiKode
                                            prodiJjarKode
                                            prodiNamaResmi
                                            prodiKodeUniv
                                                fakultas {
                                                    fakKode
                                                    fakKodeUniv
                                                    fakNamaResmi
                                                }
                                            }
                                    }
                            }');

                            $body2 = $getDatamhs->getBody();
                            $body_array2 = json_decode($body2);

                            $npm = $body_array2->data->mahasiswa[0]->mhsNiu;  
                            $nama = $body_array2->data->mahasiswa[0]->mhsNama; 
                            $jenkel = $body_array2->data->mahasiswa[0]->mhsJenisKelamin; 
                            $tgl_lahir = $body_array2->data->mahasiswa[0]->mhsTanggalLahir;
                            $tgl_lulus = $body_array2->data->mahasiswa[0]->mhsTanggalLulus;
                            $prodiJjarKode = $body_array2->data->mahasiswa[0]->prodi->prodiJjarKode;    //S1
                            $prodiNamaResmi = $body_array2->data->mahasiswa[0]->prodi->prodiNamaResmi; //informatika
                            $prodiKodeUniv = $body_array2->data->mahasiswa[0]->prodi->prodiKodeUniv; //G1A0
                            $fakKodeUniv = $body_array2->data->mahasiswa[0]->prodi->fakultas->fakKodeUniv; //G
                            $fakNamaResmi = $body_array2->data->mahasiswa[0]->prodi->fakultas->fakNamaResmi; //TEKNIK

                                                    session()->set('npm', $npm);
                                                    session()->set('nama', $nama);
                                                    session()->set('jenkel', $jenkel);
                                                    session()->set('prodiJjarKode', $prodiJjarKode);
                                                    session()->set('tgl_lahir', $tgl_lahir);
                                                    session()->set('nama_prodi', $prodiNamaResmi);
                                                    session()->set('kode_prodi', $prodiKodeUniv);
                                                    session()->set('kode_fak', $fakKodeUniv);
                                                    session()->set('nama_fak', $fakNamaResmi);

                        //cek wisuda atau belum 
                        if($tgl_lulus == null){                          
                            $query = $this->db->query("SELECT * FROM tb_berkas_wajib WHERE npm='$npm' ")->getRowarray();

                            //jika npm didatabase samo dengan npm di session, sudah terdaftar
                            if($query){
                                        session()->setFlashdata('message', '<div class="alert alert-success" role="alert">
                                        SELAMAT DATANG '.session()->get('nama').'  </div>');
                                        return redirect()->to(base_url('Profil'));  
                            
                            //jika tidak sama, maka dinput ke tb_mahasiswa dan tb_berkas_wajib
                            } else{
                                        $this->db_mahasiswa->save([
                                            'npm' => session()->get('npm'),
                                            'nama_mhs' => session()->get('nama'),
                                            'kode_prodi' => session()->get('kode_prodi'),
                                            'kode_fakultas' => session()->get('kode_fak')
                                            
                                        ]);
                                                       
                                        if(session()->get('prodiJjarKode') == 'D3'){
                                            $a = 'LTA';
                                            $validasi_sumbangan = null;
                                        }elseif (session()->get('prodiJjarKode') == 'S1') {
                                            $a = 'SKRIPSI';
                                            $validasi_sumbangan = null;
                                        }elseif (session()->get('prodiJjarKode') == 'S2') {
                                            $a = 'TESIS';
                                            $validasi_sumbangan = '0';
                                        }else{
                                            $a = 'DISERTASI';
                                            $validasi_sumbangan = '0';
                                        }
                            
                                        $this->db_berkas->save([
                                            'npm' => session()->get('npm'),
                                            'kode_prodi' => session()->get('kode_prodi'),
                                            'jenis_TA' => $a,
                                            'validasi_TA' => '0',
                                            'hard_TA' => '0',
                                            'validasi_jurnal' => '0',
                                            'validasi_sumbangan' => $validasi_sumbangan,
                                            'validasi_peminjaman_unit' => '0',
                                            'validasi_peminjaman_pusat' => '0'
                                        ]);

                                        $this->status_akhir->save([
                                            'npm' => session()->get('npm'),
                                            'status' => 'Belum Selesai',
                                        ]);
            
                                        session()->setFlashdata('message', '<div class="alert alert-success" role="alert">
                                        SELAMAT DATANG '.session()->get('nama').'  </div>');
                                        return redirect()->to(base_url('Profil'));

                            }

                        }else{
                                session()->setFlashdata('massage', '<div class="alert alert-danger" role="alert">
                                MAAF ANDA SUDAH LULUS </div>');
                                return view('mhs/v_login');
                        }
                    } else
                        {       
                                session()->setFlashdata('massage', '<div class="alert alert-danger" role="alert">
                                USERNAME DAN PASSWORD SALAH </div>');
                                return view('mhs/v_login');
                        }
        }else{
                        return redirect()->to(base_url('Home'));
                        
                    }

                

    
        }
    
        public function logout(){
            // session()->remove('prodiJjarKode');
                session()->remove('cek_portal');
                session()->remove('npm');
                session()->remove('nama');
                session()->remove('jenkel');
                session()->remove('tgl_lahir');
                session()->remove('nama_prodi');
                session()->remove('kode_prodi');
                session()->remove('kode_fak');
                session()->remove('nama_fak');
                session()->remove('prodiJjarKode');

                session()->setFlashdata('massage', '<div class="alert alert-success" role="alert">
                    Anda Berhasil Logout</div>');
                return redirect()->to(base_url('Auth'));

        }
   
}
