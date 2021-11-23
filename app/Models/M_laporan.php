<?php 

    namespace App\Models;
    use CodeIgniter\Model;

    class M_laporan extends Model {

        protected $table = 'tb_mah';
       

        public function getData(){
            $npm = session()->get('npm');

            $builder = $this->db->table('tb_mahasiswa');
            $builder->join('tb_berkas_wajib', 'tb_berkas_wajib.npm = tb_mahasiswa.npm');
            $builder->join('tb_prodi', 'tb_prodi.kode_prodi = tb_mahasiswa.kode_prodi');
            $builder->join('tb_fakultas', 'tb_fakultas.kode_fakultas = tb_mahasiswa.kode_fakultas');
            $builder->where([
                'tb_mahasiswa.npm' => $npm
            ]);
            return $builder->get()->getResultArray();
        }
    
      

    }
    
?>