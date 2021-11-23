<?php

namespace App\Models;

use CodeIgniter\Model;
use GuzzleHttp\Client;

class M_login extends Model
{
    protected $table = 'user_role';
    protected $primaryKey = 'id_role';

    // public function getData(){
    //     $builder = $this->db->table('user_role');
    //     $builder->join('data_prodi', 'data_prodi.kode_prodi = user_role.kode_prodi');
    //     $builder->get()->getRowArray();
    //     return $builder;
    // }

    public function cek_login($username,$password)
    {

        $builder = $this->db->table('user_role');
        $builder->join('tb_fakultas', 'tb_fakultas.kode_fakultas = user_role.kode_fakultas');
        $builder->where(array(
            'username' => $username,
            'password' => $password
        ));

        return $builder->get()->getRowArray();
    }

}