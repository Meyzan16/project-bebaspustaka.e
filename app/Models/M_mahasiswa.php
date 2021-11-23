<?php

namespace App\Models;

use CodeIgniter\Model;

class M_mahasiswa extends Model
{
    
    protected $table = 'tb_mahasiswa';
    protected $allowedFields = ['npm','nama_mhs' ,'kode_prodi', 'kode_fakultas'];

    public function hapus($npm){
        $builder = $this->db->table('tb_mahasiswa');
        return $builder->delete(['npm' => $npm]);
    }


}