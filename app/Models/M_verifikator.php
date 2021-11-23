<?php 

namespace App\Models;
use CodeIgniter\Model;

class M_verifikator extends Model{

    protected $table = 'user_role';
    protected $primaryKey = 'id_user';
    protected $allowedFields = ['nama_user', 'username' ,'password','id_role','kode_fakultas']; 

    function __construct()
	{      
	$this->validation = \Config\Services::validation();
    $this->db = db_connect(); 
	}

    public function getData()
    {
        $kode_fakultas = session()->get('kode_fakultas');
        $builder = $this->db->table($this->table);
        $builder->join('tb_fakultas', 'tb_fakultas.kode_fakultas = user_role.kode_fakultas');
        $builder->where([
            'user_role.kode_fakultas' => $kode_fakultas
        ]);

        return  $builder->get()->getResultArray();   
    }

    public function getDataVeripusat()
    {

        $builder = $this->db->table($this->table);
        $builder->join('tb_fakultas', 'tb_fakultas.kode_fakultas = user_role.kode_fakultas');
        $builder->orderBy('id_role', 'desc');
        return  $builder->get()->getResultArray();   
    }

    public function getDataVeri()
    {
        $id_user = session()->get('id_user');
        $builder = $this->db->table($this->table);
        $builder->join('tb_fakultas', 'tb_fakultas.kode_fakultas = user_role.kode_fakultas');
        $builder->where([
            'user_role.id_user' => $id_user
        ]);
        return  $builder->get()->getResultArray();   
    }

    

    public function updateverifi($data, $id_user){
       
        $builder = $this->db->table($this->table);
        return $builder->update($data, ['id_user' => $id_user]);   
    }

    public function updatePass($data, $id_user){
     

        $builder = $this->db->table($this->table);
        return $builder->update($data, ['id_user' => $id_user]);   
    }

    public function hapus($id_user){
        
        $builder = $this->db->table($this->table);
        return $builder->delete(['id_user' => $id_user]);
    }

}

?>