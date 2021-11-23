<?php $this->db = db_connect(); ?>
<?=  $this->extend('layout_mhs/template_mhs'); ?>
<?= $this->section('content'); ?>

<?php
                            $npm = session()->get('npm'); 
                            $kode_fakultas = session()->get('kode_fak');
                            $kode_prodi = session()->get('kode_prodi');
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
                    <h3 class="font-weight-bold"><?= $sub_title; ?> </h3>

                    
                                               
                  </div>
                  
                </div>
              </div>
            </div>
            

            <?php if(session()->get('message')) { ?>
                <div class="autohide">
                <?php echo session()->getFlashdata('message'); ?>    
                </div>
            <?php } ?>

            
                <div class="row">
                    <div class="col-lg-8 grid-margin stretch-card">
                        <div class="card tale-bg shadow mb-4">

                                        <div class="card-header py-3">
                                            <h6 class="m-0 font-weight-bold text-primary"> NAMA <?= session()->get('nama') ?> </h6>
                                        </div>

                            <div class="card-body ">
                                         
                            <?php if($data['validasi_TA'] != 1) {?>
                                <form  action="/Mahasiswa/perbaki_file_ta" method="post" enctype="multipart/form-data">
                                        <?= csrf_field() ?>
                                        
                                        <input type="hidden" name="npm" value="<?= $npm ?>">
                                        <input type="hidden" name="fileLama" value="<?= $data['file_TA']; ?>">
                                    <div class="row">
                                                <div class="form-group col-md-6 ">
                                                            <label class=" col-form-label">PERBAKI FILE TUGAS AKHIR</label>
                                                            <div >
                                                                    <input type="file"  name="file_ta" required class="form-control <?= ($validation->hasError('file_ta')) ? 'is-invalid' : ''; ?>"
                                                                          autofocus >
                                                                        <div class="invalid-feedback autohide">
                                                                            <?= $validation->getError('file_ta'); ?>
                                                                        </div>
                                                            </div>
                                                           
                                                </div>
                                        
                                                <div class="form-group col-md-2 ">
                                                        <label class=" row col-form-label">TOMBOL FILE TA</label>
                                                       <div class="row">
                                                        <button type="submit" name="perbaiki1"  class="btn btn-primary mr-2 float-right">Perbaiki File</button>
                                                       </div>
                                                       
                                                </div>
                                    
                                    </div>
                                </form> 
                            
                            <?php } if($data['validasi_jurnal'] != 1) { ?>
                                <form  action="/Mahasiswa/perbaki_file_jurnal" method="post" enctype="multipart/form-data">
                                        <input type="hidden" name="npm" value="<?= $npm ?>">
                                        <input type="hidden" name="fileLama" value="<?= $data['file_jurnal']; ?>">
                                            <div class="row">
                                                        <div class="form-group col-md-6 ">
                                                                    <label class=" col-form-label">PERBAKI FILE JURNAL</label>
                                                                    <div class="">
                                                                            <input type="file"  name="file_jurnal" required class="form-control <?= ($validation->hasError('file_jurnal')) ? 'is-invalid' : ''; ?>"
                                                                                autofocus >

                                                                                <div class="invalid-feedback autohide">
                                                                                    <?= $validation->getError('file_jurnal'); ?>
                                                                                </div>
                                                                    </div>
                                                                
                                                        </div>
                                                
                                                        <div class="form-group col-md-4 ">
                                                                <label class=" row col-form-label">TOMBOL FILE JURNAL</label>
                                                                <div class="row">        
                                                                    <button type="submit" name="perbaiki2"  class="btn btn-primary mr-2 float-right">Perbaiki File</button>
                                                                </div>
                                                            
                                                        </div>
                                            </div>
                                </form>
                            
                            <?php } if($data['jenis_TA'] == 'TESIS' || $data['jenis_TA'] == 'DISERTASI') { ?>
                                <?php if($data['validasi_sumbangan'] != 1 ) {?>
                                    <form  action="/Mahasiswa/perbaki_file_sumbangan" method="post" enctype="multipart/form-data">
                                        <input type="hidden" name="npm" value="<?= $npm ?>">
                                        <input type="hidden" name="fileLama" value="<?= $data['file_sumbangan']; ?>">
                                            <div class="row">
                                                        <div class="form-group col-md-6 ">
                                                                    <label class=" col-form-label">PERBAKI FILE SUMBANGAN</label>
                                                                    <div class="">
                                                                            <input type="file"  name="file_sumbangan"  class="form-control <?= ($validation->hasError('file_sumbangan')) ? 'is-invalid' : ''; ?>"
                                                                                required  autofocus >

                                                                                <div class="invalid-feedback autohide">
                                                                                    <?= $validation->getError('file_sumbangan'); ?>
                                                                                </div>
                                                                    </div>
                                                                
                                                        </div>
                                                
                                                        <div class="form-group col-md-6 ">
                                                                <label class="row col-form-label">TOMBOL FILE SUMBANGAN</label>
                                                                <div class="row">
                                                                <button type="submit" name="perbaiki3"  class="btn btn-primary mr-2 float-right">Perbaiki File</button>
                                                                </div>
                                                            
                                                        </div>
                                            
                                            </div>
                                    </form>   
                                <?php } ?>                         

                            <?php }                               
                                                if($pengguna_berkas_fak && $pengguna_berkas_fak['kode_prodi'] == $kode_prodi  && $pengguna_berkas_fak['is_active'] == 1 ){  ?>     
                                                    <?php if($tb_berkas_tambahan) { ?>
                                                    
                                                        <?php if($tb_berkas_tambahan['validasi_berkas'] == 0 && $tb_berkas_tambahan['catatan_berkas'] != '') {?>

                                                            <form  action="/Mahasiswa/perbaki_file_berkas_tambahan" method="post" enctype="multipart/form-data">
                                                                <input type="hidden" name="npm" value="<?= $npm ?>">
                                                                <input type="hidden" name="fileLama" value="<?= $tb_berkas_tambahan['file_berkas']; ?>">
                                                                    <div class="row">
                                                                                <div class="form-group col-md-6 ">
                                                                                            <label class=" col-form-label">PERBAKI <?= strtoupper($pengguna_berkas_fak['nama_berkas']) ?></label>
                                                                                            <div class="">
                                                                                                    <input type="file"  name="file_berkas_tambahan"  class="form-control <?= ($validation->hasError('file_berkas_tambahan')) ? 'is-invalid' : ''; ?>"
                                                                                                        required  autofocus >
                                                                                                        <h6 class="mt-1" style="color:red;">Disarankan penamaan file berbeda dengan file sebelumnya </h6>
                                                                                                        <div class="invalid-feedback autohide">
                                                                                                            <?= $validation->getError('file_berkas_tambahan'); ?>
                                                                                                        </div>
                                                                                            </div>
                                                                                        
                                                                                </div>
                                                                        
                                                                                <div class="form-group col-md-6 ">
                                                                                        <label class="row col-form-label">TOMBOL <?= strtoupper($pengguna_berkas_fak['nama_berkas']) ?></label>
                                                                                        <div class="row">
                                                                                        <button type="submit" name="perbaiki3"  class="btn btn-primary mr-2 float-right">Perbaiki File</button>
                                                                                        </div>
                                                                                    
                                                                                </div>
                                                                    
                                                                    </div>
                                                            </form>
                                                        
                                                        <?php } if($tb_berkas_tambahan['validasi_berkas'] == 0 && $tb_berkas_tambahan['catatan_berkas'] == '') { ?>
                                                            <form  action="/Mahasiswa/perbaki_file_berkas_tambahan" method="post" enctype="multipart/form-data">
                                                                <input type="hidden" name="npm" value="<?= $npm ?>">
                                                                <input type="hidden" name="fileLama" value="<?= $tb_berkas_tambahan['file_berkas']; ?>">
                                                                    <div class="row">
                                                                                <div class="form-group col-md-6 ">
                                                                                            <label class=" col-form-label">PERBAKI <?= strtoupper($pengguna_berkas_fak['nama_berkas']) ?></label>
                                                                                            <div class="">
                                                                                                    <input type="file"  name="file_berkas_tambahan"  class="form-control <?= ($validation->hasError('file_berkas_tambahan')) ? 'is-invalid' : ''; ?>"
                                                                                                        required  autofocus >
                        
                                                                                                        <div class="invalid-feedback autohide">
                                                                                                            <?= $validation->getError('file_berkas_tambahan'); ?>
                                                                                                        </div>
                                                                                            </div>
                                                                                        
                                                                                </div>
                                                                        
                                                                                <div class="form-group col-md-6 ">
                                                                                        <label class="row col-form-label">TOMBOL <?= strtoupper($pengguna_berkas_fak['nama_berkas']) ?></label>
                                                                                        <div class="row">
                                                                                        <button type="submit" name="perbaiki3"  class="btn btn-primary mr-2 float-right">Perbaiki File</button>
                                                                                        </div>
                                                                                    
                                                                                </div>
                                                                    
                                                                    </div>
                                                            </form>
                                                            
                                                        <?php } if($tb_berkas_tambahan['validasi_berkas'] == 1 && $tb_berkas_tambahan['catatan_berkas'] != '') {?>
                                                            <form  action="/Mahasiswa/perbaki_file_berkas_tambahan" method="post" enctype="multipart/form-data">
                                                                <input type="hidden" name="npm" value="<?= $npm ?>">
                                                                <input type="hidden" name="fileLama" value="<?= $tb_berkas_tambahan['file_berkas']; ?>">
                                                                    <div class="row">
                                                                                <div class="form-group col-md-6 ">
                                                                                            <label class=" col-form-label">PERBAKI <?= strtoupper($pengguna_berkas_fak['nama_berkas']) ?></label>
                                                                                            <div class="">
                                                                                                    <input type="file"  name="file_berkas_tambahan"  class="form-control <?= ($validation->hasError('file_berkas_tambahan')) ? 'is-invalid' : ''; ?>"
                                                                                                        required  autofocus >     
                        
                                                                                                        <div class="invalid-feedback autohide">
                                                                                                            <?= $validation->getError('file_berkas_tambahan'); ?>
                                                                                                        </div>
                                                                                            </div>
                                                                                        
                                                                                </div>
                                                                        
                                                                                <div class="form-group col-md-6 ">
                                                                                        <label class="row col-form-label">TOMBOL <?= strtoupper($pengguna_berkas_fak['nama_berkas']) ?></label>
                                                                                        <div class="row">
                                                                                        <button type="submit" name="perbaiki3"  class="btn btn-primary mr-2 float-right">Perbaiki File</button>
                                                                                        </div>
                                                                                    
                                                                                </div>
                                                                    
                                                                    </div>
                                                            </form>
                                                        <?php } ?>


                                                    <?php } ?>

                            
                                                <?php } else if($pengguna_berkas_fak1  && $pengguna_berkas_fak1['kode_prodi'] == ''  && $pengguna_berkas_fak1['is_active'] == 1  ) { ?>

                                                    <?php if($tb_berkas_tambahan != '') { ?> 
                                                        
                                                        <?php if($tb_berkas_tambahan['validasi_berkas'] == 0 && $tb_berkas_tambahan['catatan_berkas'] != '') {?>

                                                            <form  action="/Mahasiswa/perbaki_file_berkas_tambahan" method="post" enctype="multipart/form-data">
                                                                <input type="hidden" name="npm" value="<?= $npm ?>">
                                                                <input type="hidden" name="fileLama" value="<?= $tb_berkas_tambahan['file_berkas']; ?>">
                                                                <div class="row">
                                                                            <div class="form-group col-md-6 ">
                                                                                        <label class=" col-form-label">PERBAKI <?= strtoupper($pengguna_berkas_fak1['nama_berkas']) ?></label>
                                                                                        <div class="">
                                                                                                <input type="file"  name="file_berkas_tambahan"  class="form-control <?= ($validation->hasError('file_berkas_tambahan')) ? 'is-invalid' : ''; ?>"
                                                                                                    required  autofocus >
                    
                                                                                                    <div class="invalid-feedback autohide">
                                                                                                        <?= $validation->getError('file_berkas_tambahan'); ?>
                                                                                                    </div>
                                                                                        </div>
                                                                                    
                                                                            </div>
                                                                    
                                                                            <div class="form-group col-md-6 ">
                                                                                    <label class="row col-form-label">TOMBOL <?= strtoupper($pengguna_berkas_fak1['nama_berkas']) ?></label>
                                                                                    <div class="row">
                                                                                    <button type="submit" name="perbaiki3"  class="btn btn-primary mr-2 float-right">Perbaiki File</button>
                                                                                    </div>
                                                                                
                                                                            </div>
                                                                
                                                                </div>
                                                            </form>

                                                        <?php } if($tb_berkas_tambahan['validasi_berkas'] == 0 && $tb_berkas_tambahan['catatan_berkas'] == '') { ?>
                                                            <form  action="/Mahasiswa/perbaki_file_berkas_tambahan" method="post" enctype="multipart/form-data">
                                                                <input type="hidden" name="npm" value="<?= $npm ?>">
                                                                <input type="hidden" name="fileLama" value="<?= $tb_berkas_tambahan['file_berkas']; ?>">
                                                                <div class="row">
                                                                            <div class="form-group col-md-6 ">
                                                                                        <label class=" col-form-label">PERBAKI <?= strtoupper($pengguna_berkas_fak1['nama_berkas']) ?></label>
                                                                                        <div class="">
                                                                                                <input type="file"  name="file_berkas_tambahan"  class="form-control <?= ($validation->hasError('file_berkas_tambahan')) ? 'is-invalid' : ''; ?>"
                                                                                                    required  autofocus >
                    
                                                                                                    <div class="invalid-feedback autohide">
                                                                                                        <?= $validation->getError('file_berkas_tambahan'); ?>
                                                                                                    </div>
                                                                                        </div>
                                                                                    
                                                                            </div>
                                                                    
                                                                            <div class="form-group col-md-6 ">
                                                                                    <label class="row col-form-label">TOMBOL <?= strtoupper($pengguna_berkas_fak1['nama_berkas']) ?></label>
                                                                                    <div class="row">
                                                                                    <button type="submit" name="perbaiki3"  class="btn btn-primary mr-2 float-right">Perbaiki File</button>
                                                                                    </div>
                                                                                
                                                                            </div>
                                                                
                                                                </div>
                                                            </form>

                                                        <?php } if($tb_berkas_tambahan['validasi_berkas'] == 1 && $tb_berkas_tambahan['catatan_berkas'] != '') {?>
                                                            <form  action="/Mahasiswa/perbaki_file_berkas_tambahan" method="post" enctype="multipart/form-data">
                                                                <input type="hidden" name="npm" value="<?= $npm ?>">
                                                                <input type="hidden" name="fileLama" value="<?= $tb_berkas_tambahan['file_berkas']; ?>">
                                                                <div class="row">
                                                                            <div class="form-group col-md-6 ">
                                                                                        <label class=" col-form-label">PERBAKI <?= strtoupper($pengguna_berkas_fak1['nama_berkas']) ?></label>
                                                                                        <div class="">
                                                                                                <input type="file"  name="file_berkas_tambahan"  class="form-control <?= ($validation->hasError('file_berkas_tambahan')) ? 'is-invalid' : ''; ?>"
                                                                                                    required  autofocus >
                    
                                                                                                    <div class="invalid-feedback autohide">
                                                                                                        <?= $validation->getError('file_berkas_tambahan'); ?>
                                                                                                    </div>
                                                                                        </div>
                                                                                    
                                                                            </div>
                                                                    
                                                                            <div class="form-group col-md-6 ">
                                                                                    <label class="row col-form-label">TOMBOL <?= strtoupper($pengguna_berkas_fak1['nama_berkas']) ?></label>
                                                                                    <div class="row">
                                                                                    <button type="submit" name="perbaiki3"  class="btn btn-primary mr-2 float-right">Perbaiki File</button>
                                                                                    </div>
                                                                                
                                                                            </div>
                                                                
                                                                </div>
                                                            </form>
                                                        <?php } ?>

                                                        

                                                        
                                                             
                                                    <?php } ?>

                                            <?php }  ?>


                                <a  href="/Mahasiswa" type="button" class="btn btn-warning float-left">Cancel</a>

                            </div>
                
                        </div>

                    </div>
                </div>
           
            
             

          


          
         
        
          
</div>

<?= $this->endSection(); ?>