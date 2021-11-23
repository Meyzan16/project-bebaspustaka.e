<?php
namespace App\Controllers\Backend;
use App\Controllers\BaseController;
use App\Models\M_homepage;

class Halaman_utama extends BaseController{

    function __construct()
    {
        $this->homepage = new M_homepage(); 
    }

    public function index(){

        if(session()->get('username')==''){
            session()->setFlashdata('massage', '<div class="alert alert-danger" role="alert">
            Silahkan Login </div>');
            return redirect()->to(base_url('Rumahku')); 
        }else{
            $data = [
                'title' => 'Pengaturan Halaman Utama',
                'homepage' => $this->homepage->getData(),
            ];

            return view('halaman_utama/v_data', $data);
        }   
    }

    public function update(){

        $id = $this->request->getPost('id');
        $isi = $this->request->getPost('isi');
        $tgl_mulai = $this->request->getPost('tgl_mulai');
        $tgl_selesai = $this->request->getPost('tgl_selesai');
        $status = $this->request->getPost('status');

        $data = [
            'isi' => $isi,
            'tanggal_mulai' => $tgl_mulai,
            'tanggal_selesai' => $tgl_selesai,
            'is_active' => $status,
            'updated_at' => date('Y-m-d  h:i:s')
        ];

            $b = $this->homepage->update_data($data, $id);
            session()->setFlashdata('massage', '<div class="alert alert-success" role="alert">
            Data Berhasil Diperbarui </div>');
            return redirect()->to(base_url('Backend/Halaman_utama')); 


    }

}

?>