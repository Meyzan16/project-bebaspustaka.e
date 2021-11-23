<?php 

    namespace App\Models;
    use CodeIgniter\Model;

    class M_berkas_wajib extends Model {

        protected $table = 'tb_berkas_wajib';
       
        protected $primaryKey = 'id_berkas_wajib';
        protected $allowedFields = [
            'npm','kode_prodi','judul_TA','jenis_TA','validasi_TA',
            'hard_TA','judul_jurnal','validasi_jurnal',
            'validasi_sumbangan','validasi_peminjaman_unit','validasi_peminjaman_pusat'
        ];

        public function getData(){

            $builder = $this->db->table($this->table);
            $builder->join('tb_mahasiswa', 'tb_mahasiswa.npm = tb_berkas_wajib.npm');
            $builder->join('tb_prodi', 'tb_prodi.kode_prodi = tb_berkas_wajib.kode_prodi');
            return $builder->get()->getResultArray();
        }
    
        public function update_data($data, $npm){
            $buider = $this->db->table($this->table);
            return $buider->update($data, ['npm' =>  $npm]);
        }

        public function hapus($npm){
            $builder = $this->db->table('tb_berkas_wajib');
            return $builder->delete(['npm' => $npm]);
        }

    }
    
?>