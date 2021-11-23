<?php $this->db = db_connect(); ?>
<?=  $this->extend('layout_mhs/template_mhs'); ?>


<?= $this->section('content'); ?>

<div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
              <div class="col-md-12 grid-margin">
                <div class="row">
                  <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                    <h3 class="font-weight-bold"><?= $sub_title; ?> </h3>
                    <br>

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
                  </div>                
                </div>
              </div>
            </div>
            

            <div class="autohide">
              <?php echo session()->getFlashdata('message'); ?>    
            </div>

            <?php

            if(($data['judul_TA'] == '') && ($data['judul_jurnal'] == '') ) { ?>
                <div class="row">
                    <div class="col-lg-8 grid-margin stretch-card">
                        <div class="card tale-bg shadow mb-4">
                                        <div class="card-header py-3">
                                            <h6 class="m-0 font-weight-bold text-primary"> NAMA <?= session()->get('nama') ?> </h6>
                                        </div>
                                        <div class="card-body ">
                                        
                              <form action="<?= base_url('/Mahasiswa/update_judul') ?>" method="post" >
                                  <?= csrf_field(); ?>
                              

                                        <div class="form-group row ">
                                                    <label class="col-sm-4 col-form-label">NPM</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" 
                                                        readonly  autofocus value="<?= session()->get('npm'); ?>">
                                                    </div>
                                        </div>

                                        <div class="form-group row ">
                                                    <label class="col-sm-4 col-form-label">NAMA MAHASISWA</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" 
                                                        readonly value="<?= session()->get('nama'); ?>">
                                                    </div>
                                        </div>

                                        <div class="form-group row ">
                                                    <label class="col-sm-4 col-form-label">JUDUL TUGAS AKHIR</label>
                                                    <div class="col-sm-8">
                                                        <textarea name="judul_ta" id="editor1" class="form-control " required   rows="5" class="form-control <?= ($validation->hasError('judul_ta')) ? 'is-invalid' : ''; ?>">
                                                          
                                                        </textarea>
                                                    </div>
                                                    <div class="invalid-feedback">
                                                    <?= $validation->getError('judul_ta'); ?>
                                                </div>

                                        </div>

                                        <div class="form-group row ">
                                                    <label class="col-sm-4 col-form-label">JUDUL JURNAL</label>
                                                    <div class="col-sm-8">
                                                        <textarea name="judul_jurnal" id="editor" class="form-control" required rows="5"> </textarea>
                                                    </div>
                                        </div>                                       
                                        <button type="submit" name="lengkapi_data"  class="btn btn-primary mr-2 float-right">Submit</button>
                                        <a  href="/Dashboard_mhs" type="button" class="btn btn-warning float-left">Cancel</a>                              
                              </form>

                            </div>
                
                        </div>

                </div>

                   
            <?php } else { ?>
            
                <div class="row">
                    <div class="col-lg-8 grid-margin stretch-card">
                        <div class="card tale-bg shadow mb-4">
                                        <div class="card-header py-3">
                                            
                                            <?php                                    
                                                if($pengguna_berkas_fak && $pengguna_berkas_fak['is_active'] == 1 ){  ?>     

                                                    	<?php if($tb_berkas_tambahan) { ?>

                                                                <?php } else { ?>
                                                    <form  action="/Mahasiswa/Berkas_tambahan" method="post">
                                                                                        <button type="submit" name="berkas_tambahan"  class="btn btn-primary mr-2 float-left"><?= $pengguna_berkas_fak['nama_berkas'] ?></button>
                                                                                </form>
                                                <?php } ?>
                                                
                                                                    <?php } else if($pengguna_berkas_fak1 && $pengguna_berkas_fak1['kode_prodi'] == ''  && $pengguna_berkas_fak1['is_active'] == 1  ) { ?>

                                                                        <?php if($tb_berkas_tambahan) { ?>

                                                                        <?php } else { ?>	
                                                <form  action="/Mahasiswa/Berkas_tambahan" method="post">
                                                                                <button type="submit" name="berkas_tambahan"  class="btn btn-primary mr-2 float-left"><?= $pengguna_berkas_fak1['nama_berkas'] ?></button>
                                                                            </form>
                                                <?php } ?>

                                            <?php }  ?>

                                            <?php if($data['jenis_TA'] == 'TESIS' || $data['jenis_TA'] == 'DISERTASI') { ?>
                                            
                                                <?php if(($data['file_TA'] == '') || ($data['file_jurnal'] == '') || ($data['file_sumbangan'] == '')) { ?>
                                                    <form  action="/Mahasiswa/upload_file" method="post">
                                                        <button type="submit" name="upload"  class="btn btn-primary mr-2 float-right">Upload File</button>
                                                    </form>
                                                <?php } ?>
                                            <?php } else if ($data['jenis_TA'] == 'SKRIPSI' || $data['jenis_TA'] == 'LTA') {?>
                                                <?php if(($data['file_TA'] == '') || ($data['file_jurnal'] == '')) { ?>
                                                    <form  action="/Mahasiswa/upload_file" method="post">
                                                        <button type="submit" name="upload"  class="btn btn-primary mr-2 float-right">Upload File</button>
                                                    </form>
                                                <?php } ?>
                                            <?php }  ?>

                                            
                                            <?php if($data['jenis_TA'] == 'TESIS' || $data['jenis_TA'] == 'DISERTASI') { ?>
                                                <?php
                                                if(($data['file_TA'] != '') && ($data['file_jurnal'] != '') && ($data['file_sumbangan'] != '')) { ?>  
                                                            <form  action="/Mahasiswa/perbaki_file" method="post">
                                                                <button type="submit" name="perbaiki"  class="btn btn-primary mr-2 float-right">Perbaiki File </button>
                                                            </form>
                                                <?php } if(($data['validasi_TA'] == '1') && ($data['validasi_jurnal'] == '1') && ($data['validasi_sumbangan'] == '1') ) { ?>

                                                <?php } ?>

                                            <?php } else if($data['jenis_TA'] == 'SKRIPSI' || $data['jenis_TA'] == 'LTA') { ?>
                                                <?php
                                                if(($data['file_TA'] != '') && ($data['file_jurnal'] != '')) { ?>  
                                                            <form  action="/Mahasiswa/perbaki_file" method="post">
                                                                <button type="submit" name="perbaiki"  class="btn btn-primary mr-2 float-right">Perbaiki File </button>
                                                            </form>
                                                <?php } if(($data['validasi_TA'] == '1') && ($data['validasi_jurnal'] == '1') && ($data['validasi_sumbangan'] == '1') ) { ?>

                                                <?php } ?>

                                           <?php }  ?>



                                        </div>


                                        <div class="card-body ">
                                        
                                            <form action="<?= base_url('/Mahasiswa/update_judul') ?>" method="post" >
                                                <?= csrf_field(); ?>
                                            

                                                        <div class="form-group row ">
                                                                    <label class="col-sm-4 col-form-label">NPM</label>
                                                                    <div class="col-sm-8">
                                                                        <input type="text" class="form-control" 
                                                                        readonly  autofocus value="<?= session()->get('npm'); ?>">
                                                                    </div>
                                                        </div>

                                                        <div class="form-group row ">
                                                                    <label class="col-sm-4 col-form-label">NAMA MAHASISWA</label>
                                                                    <div class="col-sm-8">
                                                                        <input type="text" class="form-control" 
                                                                        readonly value="<?= session()->get('nama'); ?>">
                                                                    </div>
                                                        </div>
                                                        
                                                    <?php if($data['validasi_TA'] == '1' && $data['validasi_jurnal'] == '1') {?>
                                                    
                                                    <?php } else if($data['validasi_TA'] == '0' || $data['validasi_jurnal'] == '0') { ?>
                                                        <div class="form-group row ">
                                                                    <label class="col-sm-4 col-form-label">JUDUL TUGAS AKHIR</label>
                                                                    <div class="col-sm-8" required >
                                                                        <textarea required="required" name="judul_ta" id="editor1" class="form-control "    rows="5" class="form-control">
                                                                            <?= $data['judul_TA'] ?>
                                                                        </textarea>
                                                                    </div>
                                                                    

                                                        </div>

                                                        <div class="form-group row ">
                                                                    <label class="col-sm-4 col-form-label">JUDUL JURNAL</label>
                                                                    <div class="col-sm-8" required>
                                                                        <textarea required name="judul_jurnal" id="editor" class="form-control"  rows="5">
                                                                            <?= $data['judul_jurnal'] ?>
                                                                        </textarea>
                                                                    </div>
                                                        </div>
                                                    <?php } ?>

                                                    <?php if($data['validasi_TA'] == '1' && $data['validasi_jurnal'] == '1') {?>

                                                    <?php } else if($data['validasi_TA'] == '0' || $data['validasi_jurnal'] == '0') { ?>
                                                        <button type="submit"  class="btn btn-primary mr-2 float-right">Update</button>

                                                        <a  href="/Dashboard_mhs" type="button" class="btn btn-warning float-left">Cancel</a>

                                                    <?php } ?>
                                            
                                            </form>
                                        </div>
                        </div>
                    </div>

                     <div class="col-md-4 grid-margin">
                            <div class="card tale-bg">
                                <div class="card-body">
                                <p class="card-title"> PEMBERITAHUAN </p>
                                <ul class="icon-data-list">
                                    <li>
                                        <div class="d-flex">
                                            <div>
                                            <h4 class="text-primary mb-1">Judul Tugas Akhir</h4>
                                            <p>   <?= $data['judul_TA'] ?> </p>     
                                            </div>
                                        </div>
                                    </li>

                                    <li>
                                        <div class="d-flex">
                                        
                                            <div>
                                            <h4 class="text-primary mb-1">Judul Jurnal</h4>
                                            <p>   <?= $data['judul_jurnal'] ?> </p>
                                            </div>
                                        </div>
                                    </li>

                                    <li>
                                        <div class="d-flex">                                  
                                            <div>
                                                <h4 class="text-primary mb-1">File Tugas Akhir</h4>

                                                <?php if($data['file_TA'] != '') { ?>
                                                    <a class="text-decoration-none" target="_blank" href="<?=base_url('file_mhs/file_ta/'.$data['file_TA']) ?>">  <?= $data['file_TA'] ?></a>
                                                <?php }else{ ?>
                                                    <p>Belum Upload File</p>
                                                <?php } ?>

                                                <?php if($data['file_TA'] == '' && $data['validasi_TA'] == '0'  &&  $data['catatan_ta'] != '' ) { ?>
                                                      <p>Verifikasi Ditolak, Dengan Catatan <?= $data['catatan_ta'] ?></p>
                                                <?php } if($data['file_TA'] != ''  && $data['validasi_TA'] == '0' && $data['catatan_ta'] != '') {?>
                                                    <p>Menunggu Diverifikasi Ulang</p>
                                                <?php } if($data['file_TA'] != '' && $data['validasi_TA'] == '1' && $data['catatan_ta'] == '') {?>
                                                    <p>Verifikasi Diterima</p>
                                                <?php } if($data['file_TA'] != '' && $data['validasi_TA'] == '0' && $data['catatan_ta'] == '') {?>
                                                    <p>Data Belum Diverifikasi</p>
                                                <?php }  ?>   

                                            </div>
                                        </div>
                                    </li>

                                    <li>
                                        <div class="d-flex">                                    
                                            <div>
                                            <h4 class="text-primary mb-1">File Jurnal</h4>
                                            <?php if($data['file_jurnal'] != '') { ?>
                                                     <a class="text-decoration-none" target="_blank" href="<?=base_url('file_mhs/file_jurnal/'.$data['file_jurnal']) ?>">  <?= $data['file_jurnal'] ?></a>
                                                <?php }else{ ?>
                                                    <p>Belum Upload File</p>
                                                <?php } ?>

                                                 <?php if($data['file_jurnal'] == '' && $data['validasi_jurnal'] == '0'  &&  $data['catatan_jurnal'] != '' ) { ?>
                                                                        <p>Verifikasi Ditolak, Dengan Catatan <?= $data['catatan_jurnal'] ?></p>
                                                                    <?php } if($data['file_jurnal'] != ''  && $data['validasi_jurnal'] == '0' && $data['catatan_jurnal'] != '') {?>
                                                                        <p>Menunggu Diverifikasi Ulang</p>
                                                                    <?php } if($data['file_jurnal'] != '' && $data['validasi_jurnal'] == '1' && $data['catatan_jurnal'] == '') {?>
                                                                        <p>Verifikasi Diterima</p>
                                                                    <?php } if($data['file_jurnal'] != '' && $data['validasi_jurnal'] == '0' && $data['catatan_jurnal'] == '') {?>
                                                                        <p>Data Belum Diverifikasi</p>
                                                                <?php }  ?> 
                                              
                                            </div>
                                        </div>
                                    </li>
                                    
                                    <?php if($data['jenis_TA'] == 'TESIS' || $data['jenis_TA'] == 'DISERTASI' ) { ?>
                                        <li>
                                            <div class="d-flex">
                                                
                                                <div>
                                                <h4 class="text-primary mb-1">File Sumbangan</h4>
                                                <?php if($data['file_sumbangan'] != '') { ?>
                                                    <a class="text-decoration-none" target="_blank" href="<?=base_url('file_mhs/file_sumbangan/'.$data['file_sumbangan']) ?>">  <?= $data['file_sumbangan'] ?></a>                                        
                                                    <?php }else{ ?>
                                                        <p>Belum Upload File</p>
                                                    <?php } ?>
                                                
                                                                    <?php if($data['file_sumbangan'] == '' && $data['validasi_sumbangan'] == '0'  &&  $data['catatan_sum'] != '' ) { ?>
                                                                            <p>Verifikasi Ditolak, Dengan Catatan <?= $data['catatan_sum'] ?></p>
                                                                        <?php } if($data['file_sumbangan'] != ''  && $data['validasi_sumbangan'] == '0' && $data['catatan_sum'] != '') {?>
                                                                            <p>Menunggu Diverifikasi Ulang</p>
                                                                        <?php } if($data['file_sumbangan'] != '' && $data['validasi_sumbangan'] == '1' && $data['catatan_sum'] == '') {?>
                                                                            <p>Verifikasi Diterima</p>
                                                                        <?php } if($data['file_sumbangan'] != '' && $data['validasi_sumbangan'] == '0' && $data['catatan_sum'] == '') {?>
                                                                            <p>Data Belum Diverifikasi</p>
                                                                    <?php }  ?> 
                                                </div>
                                            </div>
                                        </li>
                                    
                                    <?php } ?>

                                    <li>
                                        <div class="d-flex">                                    
                                            <div>
                                            <h4 class="text-primary mb-1">Hard File</h4>
                                           
                                                 <?php if( $data['hard_TA'] == '0'  &&  $data['catatan_hard_file'] != '' ) { ?>
                                                                        <p>Verifikasi Ditolak, Dengan Catatan <?= $data['catatan_hard_file'] ?></p>
                                                                    <?php } if($data['hard_TA'] == '1' && $data['catatan_hard_file'] == '') {?>
                                                                        <p>Verifikasi Diterima</p>
                                                                    <?php } if($data['hard_TA'] == '0' && $data['catatan_hard_file'] == '') {?>
                                                                        <p>Data Belum Diverifikasi</p>
                                                                <?php }  ?> 
                                              
                                            </div>
                                        </div>
                                    </li>

                                    <li>
                                        <div class="d-flex">                                    
                                            <div>
                                            <h4 class="text-primary mb-1">Peminjaman Difakultas</h4>
                                           
                                                 <?php if( $data['validasi_peminjaman_unit'] == '0'  &&  $data['catatan_unit'] != '' ) { ?>
                                                                        <p>Verifikasi Ditolak, Dengan Catatan <?= $data['catatan_unit'] ?></p>
                                                                    <?php } if($data['validasi_peminjaman_unit'] == '1' && $data['catatan_unit'] == '') {?>
                                                                        <p>Verifikasi Diterima</p>
                                                                    <?php } if($data['validasi_peminjaman_unit'] == '0' && $data['catatan_unit'] == '') {?>
                                                                        <p>Data Belum Diverifikasi</p>
                                                                <?php }  ?> 
                                              
                                            </div>
                                        </div>
                                    </li>

                                    <li>
                                        <div class="d-flex">                                    
                                            <div>
                                            <h4 class="text-primary mb-1">Peminjaman Perpus Unib</h4>
                                           
                                                 <?php if( $data['validasi_peminjaman_pusat'] == '0'  &&  $data['catatan_pusat'] != '' ) { ?>
                                                                        <p>Verifikasi Ditolak, Dengan Catatan <?= $data['catatan_pusat'] ?></p>
                                                                    <?php } if($data['validasi_peminjaman_pusat'] == '1' && $data['catatan_pusat'] == '') {?>
                                                                        <p>Verifikasi Diterima</p>
                                                                    <?php } if($data['validasi_peminjaman_pusat'] == '0' && $data['catatan_pusat'] == '') {?>
                                                                        <p>Data Belum Diverifikasi</p>
                                                                <?php }  ?> 
                                              
                                            </div>
                                        </div>
                                    </li>
                                </ul>

                                <?php                               
                                      if($pengguna_berkas_fak && $pengguna_berkas_fak['is_active'] == 1 ){  ?>   
					<?php if($tb_berkas_tambahan) { ?>          
                                                        <p class="card-title"> BERKAS TAMBAHAN </p>
                                                            <ul class="icon-data-list">
                                                                <li>
                                                                    <div class="d-flex">
                                                                        <div>
                                                                        <h4 class="text-primary mb-1">Judul <?= $pengguna_berkas_fak['nama_berkas'] ?></h4>
									<?php if($tb_berkas_tambahan['file_berkas'] == '') { ?>
										<p>Belum Upload File</p>
                                                                        <?php } if($tb_berkas_tambahan['file_berkas'] != '' && $tb_berkas_tambahan['validasi_berkas'] == 0 && $tb_berkas_tambahan['catatan_berkas'] =='' ) {?>
                                                                            <a class="text-decoration-none" target="_blank" href="<?=base_url('file_mhs/berkas_tambahan/'.$tb_berkas_tambahan['file_berkas']) ?>">  <?= $tb_berkas_tambahan['file_berkas'] ?></a> 
                                                                            <p>Belum Diverifikasi</p>
                                                                        <?php }if($tb_berkas_tambahan['validasi_berkas'] == 0 && $tb_berkas_tambahan['catatan_berkas'] != '' ) {?>
                                                                            <p>Verifikasi Ditolak, Dengan Catatan <?= $tb_berkas_tambahan['catatan_berkas'] ?></p>
                                                                        <?php } if ($tb_berkas_tambahan['validasi_berkas'] == 1 && $tb_berkas_tambahan['catatan_berkas'] != '') { ?>
                                                                            <a class="text-decoration-none" target="_blank" href="<?=base_url('file_mhs/berkas_tambahan/'.$tb_berkas_tambahan['file_berkas']) ?>">  <?= $tb_berkas_tambahan['file_berkas'] ?></a> 
                                                                            <p>Menunggu Diverifikasi Ulang</p>
                                                                        <?php }if($tb_berkas_tambahan['validasi_berkas'] == 1 && $tb_berkas_tambahan['catatan_berkas'] == '') {?>
                                                                            <a class="text-decoration-none" target="_blank" href="<?=base_url('file_mhs/berkas_tambahan/'.$tb_berkas_tambahan['file_berkas']) ?>">  <?= $tb_berkas_tambahan['file_berkas'] ?></a> 
                                                                            <p>Verifikasi Diterima</p>
                                                                        <?php } ?>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                            </ul>         
					<?php } else {?>

<?php } ?>      
                                                <?php } else if($pengguna_berkas_fak1 && $pengguna_berkas_fak1['kode_prodi'] == ''  && $pengguna_berkas_fak1['is_active'] == 1  ) { ?>   
                                                   <?php if($tb_berkas_tambahan) { ?>
                                                        <p class="card-title"> BERKAS TAMBAHAN </p>
                                                            <ul class="icon-data-list">
                                                                <li>
                                                                    <div class="d-flex">
                                                                        <div>
                                                                        <h4 class="text-primary mb-1">Judul <?= $pengguna_berkas_fak1['nama_berkas'] ?></h4>
									<?php if($tb_berkas_tambahan['file_berkas'] == '') { ?>
										<p>Belum Upload File</p>
                                                                        <?php } if($tb_berkas_tambahan['file_berkas'] != '' && $tb_berkas_tambahan['validasi_berkas'] == 0 && $tb_berkas_tambahan['catatan_berkas'] =='' ) {?>
                                                                            <a class="text-decoration-none" target="_blank" href="<?=base_url('file_mhs/berkas_tambahan/'.$tb_berkas_tambahan['file_berkas']) ?>">  <?= $tb_berkas_tambahan['file_berkas'] ?></a> 
                                                                            <p>Belum Diverifikasi</p>
                                                                        <?php }if($tb_berkas_tambahan['validasi_berkas'] == 0 && $tb_berkas_tambahan['catatan_berkas'] != '' ) {?>
                                                                            <p>Verifikasi Ditolak, Dengan Catatan <?= $tb_berkas_tambahan['catatan_berkas'] ?></p>
                                                                        <?php } if ($tb_berkas_tambahan['validasi_berkas'] == 1 && $tb_berkas_tambahan['catatan_berkas'] != '') { ?>
                                                                            <a class="text-decoration-none" target="_blank" href="<?=base_url('file_mhs/berkas_tambahan/'.$tb_berkas_tambahan['file_berkas']) ?>">  <?= $tb_berkas_tambahan['file_berkas'] ?></a> 
                                                                            <p>Menunggu Diverifikasi Ulang</p>
                                                                        <?php }if($tb_berkas_tambahan['validasi_berkas'] == 1 && $tb_berkas_tambahan['catatan_berkas'] == '') {?>
                                                                            <a class="text-decoration-none" target="_blank" href="<?=base_url('file_mhs/berkas_tambahan/'.$tb_berkas_tambahan['file_berkas']) ?>">  <?= $tb_berkas_tambahan['file_berkas'] ?></a> 
                                                                            <p>Verifikasi Diterima</p>
                                                                        <?php } ?>
                                                                        </div>
								
                                                                    </div>
                                                                </li>
                                                            </ul>
<?php }  ?>
                                				

<?php } ?>                      

                                </div>
                            </div>
                    </div>


                </div>

            <?php } ?>

            
          
         
        
          
</div>

<?= $this->endSection(); ?>

