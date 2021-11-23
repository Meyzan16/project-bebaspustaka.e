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

            $npm = session()->get('npm');
            $data = $this->db->query("SELECT * FROM tb_berkas_wajib WHERE npm='$npm' ")->getRowarray();



            
            if($data['file_TA'] == '' ){ ?>
                <div class="row">
                    <div class="col-lg-8 grid-margin stretch-card">
                          <div class="card tale-bg shadow mb-4">

                                      <div class="card-header py-3">
                                            <h6 class="m-0 font-weight-bold text-primary"> FILE TUGAS AKHIR  </h6>
                                        </div>
                                        <div class="card-body ">
                                      <form action="<?= base_url('Mahasiswa/file_jurnal') ?>" method="post" enctype="multipart/form-data" >
                                          <?= csrf_field(); ?>
                                          <input type="hidden" name="fileLama" value="<?= $data['file_TA']; ?>">
                       
                                                <div class="form-group row ">
                                                            <label class="col-sm-4 col-form-label">FILE TUGAS AKHIR</label>
                                                            <div class="col-sm-8">


                                                            <input type="file"  name="file_ta"   id="file_ta" required class="form-control <?= ($validation->hasError('file_ta')) ? 'is-invalid' : ''; ?>"
                                                                required  autofocus >
                                                                <div class="invalid-feedback autohide">
                                                                    <?= $validation->getError('file_ta'); ?>
                                                                </div>
                                                                <br>  
                                                              <h6 style="color:red">*File TA Format PDF</h6>
                                                            </div>
                                                </div>
                      
                                                <button type="submit"  class="btn btn-primary mr-2 float-right">Submit</button>

                                                <a  href="/Mahasiswa" type="button" class="btn btn-warning float-left">Cancel</a>                                
                                      </form>

                          </div>
                
                    </div>

                </div>
            <?php } else if($data['file_jurnal'] == ''){ ?>
                <div class="row">
                    <div class="col-lg-8 grid-margin stretch-card">
                          <div class="card tale-bg shadow mb-4">

                                      <div class="card-header py-3">
                                            <h6 class="m-0 font-weight-bold text-primary"> FILE JURNAL </h6>
                                        </div>
                                        <div class="card-body ">
                                      <form action="<?= base_url('Mahasiswa/file_sumbangan') ?>" method="post" enctype="multipart/form-data">
                                          <?= csrf_field(); ?> 

                                                <div class="form-group row ">
                                                            <label class="col-sm-4 col-form-label">FILE JURNAL</label>
                                                            <div class="col-sm-8">

                                                            <input type="file" class="form-control <?= ($validation->hasError('file_jurnal')) ? 'is-invalid' : ''; ?>" 
                                                                name="file_jurnal"  required  autofocus >
                                                                <div class="invalid-feedback autohide">
                                                                    <?= $validation->getError('file_jurnal'); ?>
                                                                </div>
                                                                <br>  
                                                              <h6 style="color:red">*File Jurnal Format PDF</h6>
                                                            </div>
                                                </div>
                          
                                                <button type="submit"  class="btn btn-primary mr-2 float-right">Submit</button>

                                                <a  href="/Mahasiswa" type="button" class="btn btn-warning float-left">Cancel</a>                                
                                      </form>
                          </div>
                    </div>
                </div>  
            <?php } else if($data['jenis_TA'] == 'TESIS' || $data['jenis_TA'] == 'DISERTASI') { ?>
                <?php if($data['file_sumbangan'] == '') {?>
                    <div class="row">
                      <div class="col-lg-8 grid-margin stretch-card">
                            <div class="card tale-bg shadow mb-4">
      
                                        <div class="card-header py-3">
                                              <h6 class="m-0 font-weight-bold text-primary"> FILE BUKTI SUMBANGAN </h6>
                                          </div>
                                          <div class="card-body ">
                                        <form action="<?= base_url('Mahasiswa/file_selesai') ?>" method="post" enctype="multipart/form-data">
                                            <?= csrf_field(); ?>
      
                                                  <div class="form-group row ">
                                                              <label class="col-sm-4 col-form-label">FILE SUMBANGAN  </label>
                                                              <div class="col-sm-8">
      
                                                              <input type="file" class="form-control <?= ($validation->hasError('file_sumbangan')) ? 'is-invalid' : ''; ?>" 
                                                                  name="file_sumbangan"  required  autofocus value="<?= old('file_sumbangan'); ?>">
                                                                  <div class="invalid-feedback autohide">
                                                                      <?= $validation->getError('file_sumbangan'); ?>
                                                                  </div>
                                                                  <br>  
                                                                  <h6 style="color:red">*File Sumbangan Format PDF</h6>
                                                              </div>
      
                                                  </div>
                            
                                                  <button type="submit"  class="btn btn-primary mr-2 float-right">Submit</button>
      
                                                  <a  href="/Mahasiswa" type="button" class="btn btn-warning float-left">Cancel</a>                                
                                        </form>
      
                            </div>
                  
                      </div>
      
                    </div>             
                <?php } ?>

            <?php } else  { ?>
            
              <br><br>

            <?php } ?> 



           

          </div>

          

          
         
        
          
</div>

<?= $this->endSection(); ?>