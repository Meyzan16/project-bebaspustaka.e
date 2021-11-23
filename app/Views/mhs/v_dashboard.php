<?php $this->db = db_connect(); ?>
<?=  $this->extend('layout_mhs/template_mhs'); ?>
<?= $this->section('content'); ?>
      <?php
      $kode_fakultas = session()->get('kode_fak');
      $kode_prodi = session()->get('kode_prodi');

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

<div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-12 grid-margin">
              <div class="row">
                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                  <h3 class="font-weight-bold"><?= session()->get('nama'); ?></h3>
                  
                </div>
                
              </div>
            </div>
          </div>
          
          <div class="row">
            <div class="col-md-4 grid-margin stretch-card">
              <div class="card tale-bg">
                  <p style="margin-top:15px;" class="card-title">Bebas Pustaka Fakultas</p>
                  <div class="card-people mt-auto">
                        <img src="<?= base_url() ?>/Template_mhs/template/images/dashboard/people.svg" alt="people">
                        <div class="weather-info">
                            <div class="d-flex">
                                  
                                  <div class="ml-2">
                                    <h4 class="location font-weight-normal">Indonesia</h4>
                                    <h6 class="font-weight-normal">Universita Bengkulu</h6>
                                  </div>
                            </div>
                        </div>
                  </div>
                  <div class="card-body">

                  <?php if($cek_status['status'] == 'Belum Selesai') { ?>
                    <center>
                      <form action="/Mahasiswa" method="post">
                         <button name="lengkapi_data" class="btn btn-fill btn-primary"><i class="fa fa-fw fa-"></i>Lengkapi Data</button>
                      </form>
                    </center>
                    <br>
                  <?php } ?>

                  <?php if($data['jenis_TA'] == 'TESIS' || $data['jenis_TA'] == 'DISERTASI') { ?>

                    <!-- cek ada atau tidak npm di berkas tambahan -->

                    <?php 
                      if($tb_berkas_tambahan) {  
                            if(($data['validasi_TA'] != '0') && ($tb_berkas_tambahan['validasi_berkas'] != '0') && ($data['validasi_jurnal'] != '0') && ($data['hard_TA'] != '0') && ($data['validasi_peminjaman_unit'] != '0') && ($data['validasi_sumbangan'] != '0')  ) {?>
                                <center>
                                    <form action="/Laporan/pusat" method="post">
                                        <button type="submit" name="cetak" class="btn btn-fill btn-primary"><i class="fa fa-fw fa-"></i>Cetak Data</button>
                                    </form>
                                </center>
                            <?php } else{?>
                              <center>
                              <p> Maaf, Data Belum Bisa Dicetak</p>
                              <p>Silahkan Menghubungi Perpustakan UNIB Untuk Validasi</p>
                              </center>
                            <?php } ?>

                      <?php } else {
                            if(($data['validasi_TA'] != '0') && ($data['validasi_jurnal'] != '0') && ($data['hard_TA'] != '0') && ($data['validasi_peminjaman_unit'] != '0') && ($data['validasi_sumbangan'] != '0')  ) {?>
                                <center>
                                    <form action="/Laporan/pusat" method="post">
                                        <button type="submit" name="cetak" class="btn btn-fill btn-primary"><i class="fa fa-fw fa-"></i>Cetak Data</button>
                                    </form>
                                </center>
                            <?php } else{?>
                              <center>
                              <p> Maaf, Data Belum Bisa Dicetak</p>
                              <p>Silahkan Menghubungi Perpustakan UNIB Untuk Validasi</p>
                              </center>
                            <?php } ?>
                      <?php } ?>
                      
                  <?php } else if($data['jenis_TA'] == 'SKRIPSI' || $data['jenis_TA'] == 'LTA') { ?>

                        <?php 
                        //cek ada atau tidak berkas tambahan
                        if($tb_berkas_tambahan) { 

                          if(($data['validasi_TA'] != '0') && ($tb_berkas_tambahan['validasi_berkas'] != '0') && ($data['validasi_jurnal'] != '0') && ($data['hard_TA'] != '0') && ($data['validasi_peminjaman_unit'] != '0')  ) {?>
                              <center>
                                <form action="/Laporan" method="post">
                                    <button type="submit" name="cetak" class="btn btn-fill btn-primary"><i class="fa fa-fw fa-"></i>Cetak Data</button>
                                </form>
                              </center>
                          <?php } else{?>
                            <center>
                            <p> Maaf, Data Belum Bisa Dicetak</p>
                            <p>Silahkan Menghubungi Perpustakan Fakultas Untuk Validasi</p>
                            </center>
                          <?php } ?>

                        <?php } else { 
                           if(($data['validasi_TA'] != '0')  && ($data['validasi_jurnal'] != '0') && ($data['hard_TA'] != '0') && ($data['validasi_peminjaman_unit'] != '0')  ) {?>
                              <center>
                                <form action="/Laporan" method="post">
                                    <button type="submit" name="cetak" class="btn btn-fill btn-primary"><i class="fa fa-fw fa-"></i>Cetak Data</button>
                                </form>
                              </center>
                          <?php } else{?>
                            <center>
                            <p> Maaf, Data Belum Bisa Dicetak</p>
                            <p>Silahkan Menghubungi Perpustakan Fakultas Untuk Validasi</p>
                            </center>
                          <?php } ?>
                        <?php } ?>
                      
                  <?php } ?>



                  
      
                </div>
              </div>
            </div>



            <div class="col-md-4 grid-margin stretch-card">
              <div class="card tale-bg">
                  <p style="margin-top:15px;" class="card-title">Bebas Pustaka Pusat</p>
                  <div class="card-people mt-auto">
                        <img src="<?= base_url() ?>/Template_mhs/template/images/dashboard/people.svg" alt="people">
                        <div class="weather-info">
                            <div class="d-flex">
                                  
                                  <div class="ml-2">
                                    <h4 class="location font-weight-normal">Indonesia</h4>
                                    <h6 class="font-weight-normal">Universita Bengkulu</h6>
                                  </div>
                            </div>
                        </div>
                  </div>


                  <div class="card-body">

                      <?php if($data['jenis_TA'] == 'TESIS' || $data['jenis_TA'] == 'DISERTASI') { ?>
                        <?php 
                          if(($data['validasi_TA'] != '0') && ($data['validasi_jurnal'] != '0') && ($data['hard_TA'] != '0') && ($data['validasi_peminjaman_unit'] != '0') && ($data['validasi_sumbangan'] != '0') && ($data['validasi_peminjaman_pusat'] != '0') ) {?>
                              <center>
                                  <form action="/Laporan/pusat" method="post">
                                      <button type="submit" name="cetak" class="btn btn-fill btn-primary"><i class="fa fa-fw fa-"></i>Cetak Data</button>
                                  </form>
                              </center>
                          <?php } else{?>
                            <center>
                            <p> Maaf, Data Belum Bisa Dicetak</p>
                            <p>Silahkan Menghubungi Perpustakan UNIB Untuk Validasi</p>
                            </center>
                      <?php } ?>
                      
                      <?php } else if($data['jenis_TA'] == 'SKRIPSI' || $data['jenis_TA'] == 'LTA') {?>
                        <?php 
                          if(($data['validasi_TA'] != '0') && ($data['validasi_jurnal'] != '0') && ($data['hard_TA'] != '0') && ($data['validasi_peminjaman_unit'] != '0') && ($data['validasi_peminjaman_pusat'] != '0') ) {?>
                              <center>
                                <form action="/Laporan/pusat" method="post">
                                    <button type="submit" name="cetak" class="btn btn-fill btn-primary"><i class="fa fa-fw fa-"></i>Cetak Data</button>
                                </form>
                              </center>
                          <?php } else{?>
                            <center>
                            <p> Maaf, Data Belum Bisa Dicetak</p>
                            <p>Silahkan Menghubungi Perpustakan UNIB Untuk Validasi</p>
                            </center>
                          <?php } ?>
                      
                      <?php } ?>

                  </div>
              </div>
            </div>

          </div>       
        
          
</div>

<?= $this->endSection(); ?>