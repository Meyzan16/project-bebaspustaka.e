<?= $this->extend('layout_backend/template'); ?>

<?= $this->section('content'); ?>
<?php $this->db = db_connect(); ?>
<?php foreach($data_mhs as $data) {?>
<?php } ?>

<div class="right_col" role="main">
          <div class="">
            <div class="page-title">        
              <div class="title_left">
                   <h3>VALIDASI DATA JURNAL </h3>
                   
              </div> 
        <div class="clearfix"></div>

            <h5 class="text-right;" style="color: darkgreen; text-transform: uppercase;">DETAIL :  <?= $data['npm'] ?> <?= $data['nama_mhs'] ?></h5>
            <h5 class="text-right;" style="color: darkgreen; text-transform: uppercase;">PRODI  :  <?= $data['nama_prodi'] ?> </h5>
                 <div class="autohide">
                        <?php echo session()->getFlashdata('massage'); ?>
                </div>

                <?php if(session()->getFlashdata('gagal')){ ?>
                    <div class="alert alert-danger autohide" role="alert">
                        <?= session()->getFlashdata('gagal'); ?>
                    </div>
                <?php } ?>

                    <br>
                    <div class="row">
						<div class="col-md-12 col-sm-12 ">
							<div class="x_panel">
								<div class="x_title">
									<h2>Data Mahasiswa </h2>
                                    
									<ul class="nav navbar-right panel_toolbox">
										<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
										</li>
										<li><a class="close-link"><i class="fa fa-close"></i></a>
										</li>
									</ul>
									<div class="clearfix"></div>
								</div>
         
								<div class="x_content">
									
                                        <table id="" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                                <thead>
                                                        <tr>
                                                            <th class="text-center">No</th>
                                                            <th class="text-center">Judul Jurnal</th>
                                                            <th class="text-center">File Jurnal</th>
                                                            <th class="text-center">Verifikasi</th>
                                                            <th class="text-center">Aksi</th>              
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                    <?php $i=1;
                                                    foreach($data_mhs as $data) :  ?>
                                                        <tr>
                                                            <td class="text-center"><?= $i++ ?></td>
                                                            <?php if($data['judul_jurnal'] != ''){?>
                                                                <td class="text-center"><?= $data['judul_jurnal'] ?></td>
                                                            <?php } else {?>
                                                                <td class="text-center">
                                                                    Mahasiswa Belum Input Judul
                                                                </td>
                                                            <?php } ?>
                                                            

                                                            <?php if($data['file_jurnal'] != '') {?>
                                                                <td class="text-center"> <a href="<?=base_url('file_mhs/file_jurnal/'.$data['file_jurnal']) ?>" target="_blank" class="btn btn-primary btn-sm "> 
                                                                        <i class="fa fa-fw fa-download"></i> <?=$data['file_jurnal']; ?> </a>
                                                                </td>
                                                            
                                                            <?php }else{?>
                                                                <td class="text-center"> 
                                                                     Tidak Ada File                                                         
                                                                </td>
                                                            <?php } ?>

                                                            <?php if($data['file_jurnal'] != '') { ?>
                                                                <td class="text-center"> 
                                                                        <form action="<?php echo base_url('Backend/Validasi_jurnal/lengkap_jurnal/'.$data['npm']); ?>" method="post"> 
                                                                            <button type="submit" class="btn btn-xs btn-info _btn" data-toggle="tooltip"  title="Lengkap" >
                                                                                <i class="fa fa-fw  fa-check"></i>                                                                          
                                                                            </button> 
                                                                        </form>
                                                                       
                                                                        <button  class="btn btn-xs btn-danger _btn" title="Belum Lengkap" data-toggle="modal" data-target="#block<?= $data['npm'] ?>">
                                                                            <i class="fa fa-fw fa-ban"></i>                             
                                                                        </button>

                                                                        
                                                                </td>
                                                            
                                                            <?php } else { ?>
                                                                <td class="text-center"> 
                                                                     Maaf Mahasiswa Belum Upload File                                                          
                                                                </td>
                                                            <?php } ?>
                                                            
                                                            <?php if($data['file_jurnal'] != '') { ?>
                                                                <td class="text-center"> 
                                                                    <button class="btn btn-xs btn-info" data-toggle="modal" data-target="#edit_data<?= $data['npm'] ?>">
                                                                        <?= csrf_field() ?>
                                                                            <i class="fa fa-fw fa-edit"></i>
                                                                                Edit
                                                                        </button>                                                                 
                                                                </td>
                                                            <?php } else { ?>
                                                                <td class="text-center"> 
                                                                     Maaf Mahasiswa Belum Upload File                                                           
                                                                </td>
                                                            
                                                            <?php } ?>
                                                            

                                                         

                                                            
                                                        </tr>
                                                    <?php endforeach; ?>   
                                                    </tbody>
                                        </table>

								</div>
							</div>
						</div>
					</div>

                            <a href="/Backend/Data_mhs/detail_data/<?= $data['npm'] ?>" type="button" class="btn btn-warning float-left">Kembali</a>

            </div>
          </div>
        </div>

        
                        <!-- awal edit data -->
                    <?php foreach($data_mhs as $data) { ?> 
                        <div class="modal fade" id="edit_data<?= $data['npm'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Edit Data Jurnal</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>

                                    <div class="modal-body">
                                            <form action="<?= base_url('Backend/Validasi_jurnal/update_data_jurnal'); ?>" method="post" enctype="multipart/form-data">
                                            <?= csrf_field() ?>
                                                <input type="hidden" name="npm" value="<?= $data['npm']; ?>">
                                                <input type="hidden" name="fileLama" value="<?= $data['file_jurnal']; ?>">
                                                    <div class="form-group">
                                                        <label>Judul Jurnal</label>
                                                        <textarea name="judul" id="editor1" class="form-control" rows="5" class="form-control">
                                                            <?= $data['judul_jurnal'] ?>
                                                        </textarea>
                                                    </div>

                                                

                                                    <div class="form-group">
                                                        
                                                            <label>Data File</label>   
                                                                <input type="file" class="form-control"  id="file" name="file" 
                                                                <?= $data['file_jurnal'] ?> autofocus  >                                                  
                                                            </div>

                                                    <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                    <button type="submit" name="edit" class="btn btn-primary">Submit</button>
                                                    </div>
                                            </form>
                                    </div>

                                        </div>
                                    </div>
                        </div>
                    <?php }  ?> 
                        <!-- akhir edit data -->

                        <!-- akses tolak -->
                        <?php foreach($data_mhs as $data) { ?> 
                            <div class="modal fade" id="block<?= $data['npm'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">CATATAN</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <div class="modal-body">
                                            <form action="<?= base_url('Backend/Validasi_jurnal/belum_lengkap_jurnal'); ?>" method="post" >
                                                <?= csrf_field(); ?>
                                                    <input type="hidden" name="npm" value="<?= $data['npm']; ?>">
                                                     <input type="hidden" name="fileLama" value="<?= $data['file_jurnal']; ?>">

                                                    <div class="form-group">
                                                        <label> Catatan </label>
                                                        <textarea name="catatan" class="form-control" cols="10" rows="2" maxlength="50"></textarea>
                                                    </div>

                                                        <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                        <button type="submit" name="edit" class="btn btn-primary">Submit</button>
                                                        </div>
                                                </form>
                                        </div>

                                            </div>
                                        </div>
                            </div>
                        <?php }  ?> 
                        <!-- akhir akses tolak -->


<?= $this->endSection(); ?>
