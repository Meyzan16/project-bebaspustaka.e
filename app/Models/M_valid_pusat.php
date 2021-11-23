<?php 

    namespace App\Models;
    use CodeIgniter\Model;

    class M_valid_pusat extends Model {


        public function getData()  
        {
            
            $builder = $this->db->table('tb_mahasiswa');
            $builder->join('tb_fakultas', 'tb_mahasiswa.kode_fakultas = tb_fakultas.kode_fakultas');
            $builder->GroupBy('tb_mahasiswa.kode_fakultas');
            return $builder->get()->getResultArray();
                
           
        }

        public function getProdi($kode_fakultas){

                $builder = $this->db->table('tb_prodi');
                $builder->join('tb_fakultas', 'tb_prodi.kode_fakultas = tb_fakultas.kode_fakultas');
                $builder->where([
                    'tb_prodi.kode_fakultas' => $kode_fakultas
                ]);
                return $builder->get()->getResultArray();
        }


        public function getMhsprodi($kode_prodi){

            $builder = $this->db->table('tb_mahasiswa');
            $builder->join('tb_prodi', 'tb_mahasiswa.kode_prodi = tb_prodi.kode_prodi');
            $builder->join('tb_fakultas', 'tb_mahasiswa.kode_fakultas = tb_fakultas.kode_fakultas');
            $builder->join('tb_berkas_wajib', 'tb_mahasiswa.npm = tb_berkas_wajib.npm');
            $builder->where([
                'tb_prodi.kode_prodi' => $kode_prodi
            ]);
            return $builder->get()->getResultArray();
        }

        // public function getDataLengkap(){
            
        //         $kode_fakultas = session()->get('kode_fakultas');
        //         $builder = $this->db->table('tb_mahasiswa');
        //         $builder->join('tb_berkas_wajib', 'tb_mahasiswa.npm = tb_berkas_wajib.npm');
        //         $builder->join('tb_prodi', 'tb_mahasiswa.kode_prodi = tb_prodi.kode_prodi');
        //         $builder->join('tb_fakultas', 'tb_mahasiswa.kode_fakultas = tb_fakultas.kode_fakultas');
        //         $builder->where([
        //             'kode_fakultas' => $kode_fakultas
        //         ]);
        //         return $builder->get()->getResultArray();
        // }
   
    
        public function update_data($data, $npm){
            $buider = $this->db->table('tb_berkas_wajib');
            return $buider->update($data, ['npm' =>  $npm]);
        }

    }
    
?>