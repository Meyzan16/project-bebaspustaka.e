<?php

namespace App\Models;
use  CodeIgniter\Model;

class M_homepage extends Model {

    protected $table = 'tb_homepage';
    protected $primaryKey = 'id';

    public function getData(){
        $builder = $this->db->table($this->table);
        return $builder->get()->getResultArray();

    }

     public function update_data($data, $id){
            $builder = $this->db->table($this->table);
            return $builder->update($data, ['id' =>  $id]);
        }

 


}

?>