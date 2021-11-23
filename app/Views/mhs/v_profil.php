<?=  $this->extend('layout_mhs/template_mhs'); ?>
<?php $this->db = db_connect(); ?>

<?= $this->section('content'); ?>

<div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
              <div class="col-md-12 grid-margin">
                <div class="row">
                  <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                    <h3 class="font-weight-bold"><?= $sub_title; ?> </h3>
                    
                  </div>
                  
                </div>
              </div>
            </div>

            
                     <?php
                        
                            $kode_fakultas = session()->get('kode_fak');
                            $kode_prodi = session()->get('kode_prodi');
                            
                            //query cek tb_berkas_wajib
                            $npm = session()->get('npm');
                            $data = $this->db->query("SELECT * FROM tb_berkas_wajib WHERE npm='$npm' ")->getRowarray();


                            //query pengguna berkas
                            $pengguna_berkas_fak = $this->db->query("SELECT * FROM tb_pengguna_berkas JOIN
                            jenis_berkas_tambahan ON jenis_berkas_tambahan.id_jenis_berkas = tb_pengguna_berkas.id_jenis_berkas                    
                            WHERE
                            kode_fakultas='$kode_fakultas' AND
                            kode_prodi='$kode_prodi'        
                            ")->getRowArray();

                            $pengguna_berkas_fak1 = $this->db->query("SELECT * FROM tb_pengguna_berkas JOIN
                            jenis_berkas_tambahan ON jenis_berkas_tambahan.id_jenis_berkas = tb_pengguna_berkas.id_jenis_berkas                    
                            WHERE
                            kode_fakultas='$kode_fakultas' OR
                            kode_prodi='$kode_prodi'        
                            ")->getRowArray();

                            //query tb_berkas_tambahan               
                            $tb_berkas_tambahan = $this->db->query("SELECT * FROM tb_berkas_tambahan WHERE npm='$npm'")->getRowArray();
                    ?>
                    

            <div class="autohide">
              <?php echo session()->getFlashdata('message'); ?>    
            </div>


            <div class="row">
                <div class="col-lg-8 grid-margin stretch-card">
                    <div class="card tale-bg shadow mb-4">
                          <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">PROFIL <?= session()->get('nama') ?> </h6>
                            </div>
                            <div class="card-body ">

                            <div class="row">
                                    <table class="table table-hover">
                                          <tr><td>NPM</td><td> : </td><td><?= session()->get('npm') ?></td></tr>
                                          <tr><td>Nama</td><td> : </td><td><?= session()->get('nama') ?></td></tr>
                                          <tr><td>Jenis Kelamin</td><td> : </td><td><?= session()->get('jenkel') ?></td></tr>
                                          <tr><td>Tanggal Lahir</td><td> : </td><td><?= session()->get('tgl_lahir') ?></td></tr>
                                          <tr><td>Program Studi</td><td> : </td><td><?= session()->get('nama_prodi') ?></td></tr>
                                          <tr><td>Fakultas</td><td> : </td><td><?= session()->get('nama_fak') ?></td></tr>
                                    </table>
                            </div>
                      </div>

                    </div>

                </div>

                   <!-- <div class="col-md-4 grid-margin">
                            <div class="card tale-bg">
                                <div class="card-body">
                                <p class="card-title"> PEMBERITAHUAN </p>
                                <ul class="icon-data-list">
                                    <li>
                                        <div class="d-flex">
                                            <div>
                                            <h4 class="text-primary mb-1">Validasi Data Tugas Akhir</h4>
                                            <?php if($data['validasi_TA'] == '0' && $data['catatan_ta'] == '') {?>
                                              <p>File tugas akhir belum diverifikasi</p>
                                            <?php }else if($data['validasi_TA'] == '1' && $data['catatan_ta'] == '') {?>
                                                <p>verifikasi diterima <i class="fa-check"></i>   </p>  
                                            <?php }else if($data['catatan_ta'] != '') {?> ?>
                                                <p>Verifikasi Ditolak, Catatan : <?=  $data['catatan_ta'] ?></p>
                                            <?php } ?>
                                            </div>
                                        </div>

                                    </li>
            
                                    <li>

                                        <div class="d-flex">                                     
                                            <div>
                                            <h4 class="text-primary mb-1">Validasi Data Jurnal</h4>
                                            <?php if($data['validasi_jurnal'] == '0' && $data['catatan_ta'] == '') {?>
                                              <p>File tugas akhir belum diverifikasi</p>
                                            <?php }else if($data['validasi_jurnal'] == '1' && $data['catatan_ta'] == '') {?>
                                                <p>verifikasi diterima <i class="fa-check"></i>   </p>  
                                            <?php }else if($data['catatan_ta'] != '') {?> ?>
                                                <p>Verifikasi Ditolak, Catatan : <?=  $data['catatan_ta'] ?></p>
                                            <?php } ?>
                                              
                                            </div>
                                        </div>
                                    </li>

                                    <li>
                                        <div class="d-flex">
                                            
                                            <div>
                                            <h4 class="text-primary mb-1">Validasi File Sumbangan</h4>
                                            
                                            </div>
                                        </div>
                                    </li>

                                    <li>
                                        <div class="d-flex">
                                            
                                            <div>
                                            <h4 class="text-primary mb-1">Validasi Peminjaman Fakultas</h4>
                                            
                                            </div>
                                        </div>
                                    </li>

                                    <li>
                                        <div class="d-flex">
                                            
                                            <div>
                                            <h4 class="text-primary mb-1">Validasi Peminjaman Perpus UNIB</h4>
                                           
                                            </div>
                                        </div>
                                    </li>

                                </ul>
                                </div>
                            </div>
                  </div> -->
            </div>

          
    
        
          
</div>



<?= $this->endSection(); ?>