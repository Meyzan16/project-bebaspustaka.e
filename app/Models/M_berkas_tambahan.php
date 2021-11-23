<?php 

    namespace App\Models;
    use CodeIgniter\Model;

    class M_berkas_tambahan extends Model {

        protected $table = 'tb_berkas_tambahan';
        protected $primaryKey = 'id_berkas_tambahan';

        protected $allowedFields = [
            'id_pengguna', 'id_jenis_berkas', 'npm' ,'file_berkas','validasi_berkas'
        ];

        public function dataMhs($npm){
            $builder = $this->db->table('tb_berkas_tambahan');
            $builder->join('jenis_berkas_tambahan', 'jenis_berkas_tambahan.id_jenis_berkas = tb_berkas_tambahan.id_jenis_berkas');
            $builder->join('tb_mahasiswa', 'tb_mahasiswa.npm = tb_berkas_tambahan.npm');
            $builder->join('tb_prodi', 'tb_mahasiswa.kode_prodi = tb_prodi.kode_prodi');
            $builder->where([
                'tb_berkas_tambahan.npm' => $npm
            ]);
            return $builder->get()->getResultArray();


        }

	public function queryHps($npm){
            $builder = $this->db->table('tb_berkas_tambahan');
            $builder->where([
                'tb_berkas_tambahan.npm' => $npm
            ]);
            return $builder->get()->getRowArray();
        }

        public function update_data($data, $npm){
            $buider = $this->db->table($this->table);
            return $buider->update($data, ['npm' =>  $npm]);
        }

        public function update_status($data, $id_pengguna){
            $buider = $this->db->table($this->table);
            return $buider->update($data, ['id_pengguna' =>  $id_pengguna]);
        }


        public function hapus($npm){
                $builder = $this->db->table('tb_berkas_tambahan');
                return $builder->delete(['npm' => $npm]);
            }
       

        public function hapusBerkas($id_pengguna){
            $builder = $this->db->table('tb_berkas_tambahan');
            return $builder->delete(['id_pengguna' => $id_pengguna]);
        }
   
}
    
    
?>