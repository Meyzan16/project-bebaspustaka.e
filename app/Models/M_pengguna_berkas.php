<?php 

    namespace App\Models;
    use CodeIgniter\Model;

    class M_pengguna_berkas extends Model {

        protected $table = 'tb_pengguna_berkas';
        protected $primaryKey = 'id_pengguna';
        protected $allowedFields = [
            'id_jenis_berkas', 'kode_fakultas', 'kode_prodi' ,'is_active'
        ];


        public function getData(){
            $builder = $this->db->table('tb_pengguna_berkas');
            $builder->join('jenis_berkas_tambahan', 'jenis_berkas_tambahan.id_jenis_berkas = tb_pengguna_berkas.id_jenis_berkas', 'left');
            $builder->join('tb_fakultas', 'tb_fakultas.kode_fakultas = tb_pengguna_berkas.kode_fakultas' , 'left');
            $builder->join('tb_prodi', 'tb_prodi.kode_prodi = tb_pengguna_berkas.kode_prodi', 'left');   
            return $builder->get()->getResultArray();
        }
    

        public function update_data($data, $id_pengguna){
            $builder = $this->db->table('tb_pengguna_berkas');
            return $builder->update($data, ['id_pengguna' =>  $id_pengguna]);
        }

        public function hapus($id_pengguna){
            $builder = $this->db->table('tb_pengguna_berkas');
            return $builder->delete(['id_pengguna' => $id_pengguna]);
        }

        public function hapus_jenis_berkas($id_jenis_berkas){
            $builder = $this->db->table('tb_pengguna_berkas');
            return $builder->delete(['id_jenis_berkas' => $id_jenis_berkas]);
        }

    }
    
?>