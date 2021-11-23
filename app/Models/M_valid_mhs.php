<?php 

    namespace App\Models;
    use CodeIgniter\Model;

    class M_valid_mhs extends Model {


        public function getData()  
        {
                $kode_fakultas = session()->get('kode_fakultas');
                $builder = $this->db->table('tb_prodi');
                $builder->join('tb_fakultas', 'tb_prodi.kode_fakultas = tb_fakultas.kode_fakultas');
                $builder->where([
                    'tb_prodi.kode_fakultas' => $kode_fakultas
                ]);
                return $builder->get()->getResultArray();      
        }



        public function dataMhs($npm){
                $builder = $this->db->table('tb_mahasiswa');
                $builder->join('tb_berkas_wajib', 'tb_mahasiswa.npm = tb_berkas_wajib.npm');
                $builder->join('tb_prodi', 'tb_mahasiswa.kode_prodi = tb_prodi.kode_prodi');
                $builder->join('tb_fakultas', 'tb_mahasiswa.kode_fakultas = tb_fakultas.kode_fakultas');
                $builder->where([   
                    'tb_mahasiswa.npm' => $npm
                ]);
                return $builder->get()->getResultArray();
        }


        public function mhs_prodi($kode_prodi){
            $builder = $this->db->table('tb_mahasiswa');
            $builder->join('tb_berkas_wajib', 'tb_mahasiswa.npm = tb_berkas_wajib.npm');
            $builder->join('tb_prodi', 'tb_mahasiswa.kode_prodi = tb_prodi.kode_prodi');
            $builder->join('tb_fakultas', 'tb_mahasiswa.kode_fakultas = tb_fakultas.kode_fakultas');
            $builder->where([
                'tb_mahasiswa.kode_prodi' => $kode_prodi,
            ]);
            return $builder->get()->getResultArray();
        }


        public function getDataLengkap(){
                $kode_fakultas = session()->get('kode_fakultas');
                $builder = $this->db->table('tb_mahasiswa');    
                $builder->join('tb_berkas_wajib', 'tb_mahasiswa.npm = tb_berkas_wajib.npm');
                $builder->join('tb_prodi', 'tb_mahasiswa.kode_prodi = tb_prodi.kode_prodi');
                $builder->join('tb_fakultas', 'tb_mahasiswa.kode_fakultas = tb_fakultas.kode_fakultas');
                $builder->where([
                    'tb_mahasiswa.kode_fakultas' => $kode_fakultas,
                ]);
                return $builder->get()->getResultArray();
        }
   
    
        public function update_data($data, $npm){
            $buider = $this->db->table('tb_berkas_wajib');
            return $buider->update($data, ['npm' =>  $npm]);
        }

    }
    
?>