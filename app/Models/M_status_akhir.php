<?php 

    namespace App\Models;
    use CodeIgniter\Model;

    class M_status_akhir extends Model {

        protected $table = 'tb_status_akhir';
        protected $primaryKey = 'id';
        protected $allowedFields = [
            'npm', 'status'
        ];

    

    public function update_data($data1, $npm){
        $builder = $this->db->table($this->table);
        return $builder->update($data1, ['npm' =>  $npm]);
    }

    public function hapus($npm){
        $builder = $this->db->table('tb_status_akhir');
        return $builder->delete(['npm' => $npm]);
    }

}

?>