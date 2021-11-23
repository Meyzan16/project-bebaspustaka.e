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
                    
                  </div>
                  
                </div>
              </div>
            </div>
            

            <div class="autohide">
              <?php echo session()->getFlashdata('message'); ?>    
            </div>

            <?php

                            $kode_fakultas = session()->get('kode_fak');
                            $active = 1;
                            $pengguna_berkas_fak = $this->db->query("SELECT * FROM tb_pengguna_berkas JOIN
                            jenis_berkas_tambahan ON jenis_berkas_tambahan.id_jenis_berkas = tb_pengguna_berkas.id_jenis_berkas
                            WHERE
                            kode_fakultas='$kode_fakultas' AND
                            is_active='$active'")->getRowArray();
            
             ?>

                <div class="row">
                    <div class="col-lg-8 grid-margin stretch-card">
                          <div class="card tale-bg shadow mb-4">

                                      <div class="card-header py-3">
                                            <h6 class="m-0 font-weight-bold text-primary"> Catatan :  <?= $pengguna_berkas_fak['nama_berkas'] ?>  <?= $pengguna_berkas_fak['catatan'] ?> </h6>
                                        </div>
                                        <div class="card-body ">
                                      <form action="<?= base_url('/Mahasiswa/simpan_berkas_tambahan') ?>" method="post" enctype="multipart/form-data" >
                                          <?= csrf_field(); ?>
                                          <input type="hidden" name="id_pengguna" value="<?=  $pengguna_berkas_fak['id_pengguna'] ?>">
                                          <input type="hidden" name="jenis_berkas" value="<?=   $pengguna_berkas_fak['id_jenis_berkas']?>">
                                          <input type="hidden" name="npm" value="<?= session()->get('npm') ?>">

                                                <div class="form-group row ">
                                                            <label class="col-sm-4 col-form-label">File <?= $pengguna_berkas_fak['nama_berkas'] ?></label>
                                                            <div class="col-sm-8">


                                                            <input type="file" name="file" id="file" required class="form-control <?= ($validation->hasError('file')) ? 'is-invalid' : ''; ?>"
                                                                required  autofocus >
                                                                <div class="invalid-feedback autohide">
                                                                    <?= $validation->getError('file'); ?>
                                                                </div>
                                                                <br>  
                                                              <h6 style="color:red">*File Format PDF</h6>
                                                            </div>
                                                </div>
                      
                                                <button type="submit"  class="btn btn-primary mr-2 float-right">Submit</button>

                                                <a  href="/Mahasiswa" type="button" class="btn btn-warning float-left">Cancel</a>                                
                                      </form>

                          </div>
                
                    </div>

                </div>
           
                  
          



           

          </div>

          

          
         
        
          
</div>

<?= $this->endSection(); ?>