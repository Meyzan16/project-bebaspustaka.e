<?php 

namespace App\Controllers\Backend;
use App\Controllers\BaseController;
use App\Models\M_verifikator;

class Verifikator extends BaseController{

    function __construct()
    {
        $this->user_role = new M_verifikator();
    }

    public function index(){
        if(session()->get('username') == ''){
            session()->setFlashdata('massage', '<div class="alert alert-danger" role="alert">
            Silahkan Login </div>');
            return redirect()->to(base_url('Rumahku'));
        } else{
            $data = [
                'title' => "BEBAS PUSTAKA",
                'user_role' => $this->user_role->getData(),
                'user_role_pusat' => $this->user_role->getDataVeripusat(),
                'validation' => $this->validation
            ];
            return  view('verifikator/v_data', $data);
        }

    }

    public function create(){

        $valid = $this->validate([
            'username' => [
                'rules' => 'required|trim|is_unique[user_role.username]',
                'errors' =>  [
                    'is_unique' => 'Username Sudah Terdaftar',
                ]
                ],

             'fakultas' => [
                 'rules' => 'required|trim|is_unique[user_role.kode_fakultas]',
                 'errors' => [
                     'is_unique' => 'Nama Fakultas Sudah Digunakan'
                 ]
             ]   

        ]);

        //jika tidak valid
        if(!$valid){
            session()->setFlashdata('gagal',  $this->validation->listErrors() );
            
            $data = [
                'title' => "BEBAS PUSTAKA",
                'user_role' => $this->user_role->getData(),
                 'user_role_pusat' => $this->user_role->getDataVeripusat(),
                'validation' => $this->validation
            ];

            return  view('verifikator/v_data', $data);

        }else{

            $this->user_role->save(
                [
                    'nama_user' => $this->request->getPost('nama'),
                    'username' => $this->request->getPost('username'),
                    'password' => $this->request->getPost('password'),
                    'kode_fakultas' => $this->request->getPost('fakultas'),
                    'id_role' => 2,
                ]   
            );

            session()->setFlashdata('message', '<div class="alert alert-success" role="alert">
            Data Berhasil Di Tambahkan </div>');
            return redirect()->to(base_url('Backend/verifikator'));

        }   

    }

    public function update(){
        $id_user = $this->request->getPost('id_user');
        $kode_fakultas = $this->request->getPost('fakultas');

        $userLama = $this->db->query("SELECT * FROM user_role WHERE id_user='$id_user' ")->getRow();
        $fakultas = $this->db->query("SELECT * FROM user_role WHERE kode_fakultas='$kode_fakultas' ")->getRowArray();

        $username_baru = $this->request->getPost('username');


        if($userLama->username != $username_baru){
            $rules = 'is_unique[user_role.username]';
        }else if($fakultas['kode_fakultas'] != $kode_fakultas){
            $rules = 'is_unique[user_role.kode_fakultas]';
        }else{
            $rules = 'required';
        }

        $valid = $this->validate([
            'username' => [
                'rules' => $rules,
                'errors' =>  [
                    'is_unique' => 'Username Sudah Terdaftar',
                ]
            ],

            'fakultas' => [
                'rules' => $rules,
                'errors' => [
                    'is_unique' => 'Nama Fakultas Sudah Digunakan'
                ]
            ] 


        ]);

        //jika tidak valid
        if(!$valid){
            session()->setFlashdata('gagal',  $this->validation->listErrors() );
            
            $data = [
                'title' => "BEBAS PUSTAKA",
                'user_role' => $this->user_role->getData(),
                 'user_role_pusat' => $this->user_role->getDataVeripusat(),
                'validation' => $this->validation
            ];

            return  view('verifikator/v_data', $data);

        }else{

            //jika validasi berhasil
                
                
                $data = array(
                    'nama_user' => $this->request->getPost('nama'),
                    'username' => $username_baru,
                    'password' => $this->request->getPost('password'),
                    'kode_fakultas' => $kode_fakultas,
                    'created_at' => date('Y-m-d  h:i:s') 
                    );
                    

                  $this->user_role->updateverifi($data, $id_user);

                session()->setFlashdata('massage', '<div class="alert alert-success" role="alert">
                Data Berhasil Di Tambahkan </div>');
                return redirect()->to(base_url('Backend/verifikator'));

        }   


    }

    public function hapus($id_user){

        if(isset($_POST['hapus'])){
            $delete = $this->user_role->hapus($id_user);
                if($delete){
                session()->setFlashdata('massage', '<div class="alert alert-success" role="alert">
                        Data Berhasil Di Hapus</div>');
                return redirect()->to(base_url('Backend/verifikator'));
                }

        }else {
            return redirect()->to(base_url('Backend/verifikator'));
        }

    }

    public function ubah_pass() {

        if(session()->get('username') == ''){
            session()->setFlashdata('massage', '<div class="alert alert-danger" role="alert">
            Silahkan Login </div>');
            return redirect()->to(base_url('Rumahku'));
        } else{
            
            $data = [
                'title' => "BEBAS PUSTAKA",
                'user_role' => $this->user_role->getData(),
                'validation' => $this->validation
            ];
            return  view('verifikator/v_pass_unit', $data);
        }

    }

    public function update_pass(){
        $kode_fakultas = session()->get('kode_fakultas');
        $username_baru = $this->request->getPost('username');
        $id_user = session()->get('id_user');
        $userLama = $this->db->query("SELECT * FROM user_role WHERE id_user='$id_user' ")->getRow();

        if($userLama->username != $username_baru){
            $rules = 'is_unique[user_role.username]';
        }else{
            $rules = 'required';
        }

        $valid = $this->validate([
            'username' => [
                'rules' => $rules,
                'errors' =>  [
                    'is_unique' => 'Username Sudah Terdaftar',
                ]
            ],
 
        ]);

        //jika tidak valid
        if(!$valid){
            session()->setFlashdata('gagal',  $this->validation->listErrors() );
            $data = [
                'title' => "BEBAS PUSTAKA",
                'user_role' => $this->user_role->getData(),
                'validation' => $this->validation
            ];
            return  view('verifikator/v_pass_unit', $data);

        }else{

                //jika validasi berhasil
                
                
                $data = array(
                    'nama_user' => $this->request->getPost('nama'),
                    'username' => $username_baru,
                    'password' => $this->request->getPost('password'),
                    'kode_fakultas' => $kode_fakultas,
                    'created_at' => date('Y-m-d  h:i:s') 
                    );
                    

                  $this->user_role->updatePass($data, $id_user);

                session()->setFlashdata('massage', '<div class="alert alert-success" role="alert">
                Data Berhasil Di Tambahkan </div>');
                return redirect()->to(base_url('Backend/verifikator/ubah_pass'));

        }   
    }

}



?>