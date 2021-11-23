<?php 

    namespace App\Models;
    use CodeIgniter\Model;

    class M_jenis_berkas extends Model {

        protected $table = 'jenis_berkas_tambahan';
        protected $primaryKey = 'id_jenis_berkas';
        protected $updatedFields = 'updated_at';

        protected $allowedFields = [
            'nama_berkas', 'catatan' 
        ];

        public function getData(){

            $builder = $this->db->table('jenis_berkas_tambahan');
            return $builder->get()->getResultArray();
        }

        public function update_data($data, $id_jenis_berkas){
            $builder = $this->db->table($this->table);
            return $builder->update($data, ['id_jenis_berkas' =>  $id_jenis_berkas]);
        }

        


        public function hapus($id_jenis_berkas){
            $builder = $this->db->table($this->table);
            return $builder->delete(['id_jenis_berkas' => $id_jenis_berkas]);

        }

       
    
        
    }
    
?>