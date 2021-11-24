<?= $this->extend('layout_backend/template'); ?>

<?= $this->section('content'); ?>
<?php $this->db = db_connect(); ?>
<?php foreach($data_mhs as $data) {?>
<?php } ?>

<div class="right_col" role="main">
          <div class="">
            <div class="page-title">        
              <div class="title_left">
                   <h3>VALIDASI DATA <?= strtoupper($data['nama_berkas']) ?></h3>

                    <p> jhghjgj </p>

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
									
                                        <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                                <thead>
                                                        <tr>
                                                            <th class="text-center">No</th>
                                                            <th class="text-center">Judul Berkas</th>
                                                            <th class="text-center">File <?= $data['nama_berkas'] ?></th>
                                                            <th class="text-center">Verifikasi</th>
                                                            <!-- <th class="text-center">Aksi</th>               -->
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                    <?php $i=1;
                                                    foreach($data_mhs as $data) :  ?>
                                                        <tr>
                                                            <td class="text-center"><?= $i++ ?></td>
                                                            
                                                            <td class="text-center"><?= $data['nama_berkas'] ?></td>

                                                            <?php if($data['validasi_berkas'] == 0 && $data['catatan_berkas'] == '') {?>
                                                                <td class="text-center"> <a href="<?=base_url('file_mhs/berkas_tambahan/'.$data['file_berkas']) ?>" target="_blank" class="btn btn-primary btn-sm "> 
                                                                        <i class="fa fa-fw fa-download"></i> <?=$data['file_berkas']; ?> </a>
                                                                </td>
                                                            
                                                            <?php }if($data['validasi_berkas'] == 0 && $data['catatan_berkas'] != '') {?>
                                                                <td class="text-center"> 
                                                                     Tidak Ada File                                                         
                                                                </td>
                                                            <?php } if($data['validasi_berkas'] == 1 && $data['catatan_berkas'] != '') {?>
                                                                <td class="text-center"> <a href="<?=base_url('file_mhs/berkas_tambahan/'.$data['file_berkas']) ?>" target="_blank" class="btn btn-primary btn-sm "> 
                                                                        <i class="fa fa-fw fa-download"></i> <?=$data['file_berkas']; ?> </a>
                                                                </td>
                                                            <?php } if($data['validasi_berkas'] == 1 && $data['catatan_berkas'] == '') {?>
                                                                <td class="text-center"> <a href="<?=base_url('file_mhs/berkas_tambahan/'.$data['file_berkas']) ?>" target="_blank" class="btn btn-primary btn-sm "> 
                                                                        <i class="fa fa-fw fa-download"></i> <?=$data['file_berkas']; ?> </a>
                                                                </td>
                                                            <?php }  ?>

                                                            <!-- batas -->

                                                            <?php if($data['validasi_berkas'] == 0 && $data['catatan_berkas'] == '') {?>
                                                                <td class="text-center"> 
                                                                        <form action="<?php echo base_url('Backend/Berkas_tambahan/lengkap/'.$data['npm']); ?>" method="post"> 
                                                                            <button type="submit" class="btn btn-xs btn-info _btn" data-toggle="tooltip"  title="Lengkap" >
                                                                                <i class="fa fa-fw  fa-check"></i>                                                                          
                                                                            </button> 
                                                                        </form>
                                                                       
                                                                        <button  class="btn btn-xs btn-danger _btn" title="Belum Lengkap" data-toggle="modal" data-target="#block<?= $data['npm'] ?>">
                                                                            <i class="fa fa-fw fa-ban"></i>                             
                                                                        </button>
                                                                </td>
                                                            
                                                            <?php }if($data['validasi_berkas'] == 0 && $data['catatan_berkas'] != '') {?>
                                                                <td class="text-center"> 
                                                                     Status Ditolak Mahasiswa Belum Upload Ulang, Maaf Tidak Bisa Diverifikasi                                                        
                                                                </td>
                                                            <?php } if($data['validasi_berkas'] == 1 && $data['catatan_berkas'] != '') {?>
                                                                <td class="text-center"> 
                                                                        <form action="<?php echo base_url('Backend/Berkas_tambahan/lengkap/'.$data['npm']); ?>" method="post"> 
                                                                            <button type="submit" class="btn btn-xs btn-info _btn" data-toggle="tooltip"  title="Lengkap" >
                                                                                <i class="fa fa-fw  fa-check"></i>                                                                          
                                                                            </button> 
                                                                        </form>
                                                                       
                                                                        <button  class="btn btn-xs btn-danger _btn" title="Belum Lengkap" data-toggle="modal" data-target="#block<?= $data['npm'] ?>">
                                                                            <i class="fa fa-fw fa-ban"></i>                             
                                                                        </button>
                                                                </td>
                                                            <?php } if($data['validasi_berkas'] == 1 && $data['catatan_berkas'] == '') { ?>
                                                                <td class="text-center"> 
                                                                        <form action="<?php echo base_url('Backend/Berkas_tambahan/lengkap/'.$data['npm']); ?>" method="post"> 
                                                                            <button type="submit" class="btn btn-xs btn-info _btn" data-toggle="tooltip"  title="Lengkap" >
                                                                                <i class="fa fa-fw  fa-check"></i>                                                                          
                                                                            </button> 
                                                                        </form>
                                                                       
                                                                        <button  class="btn btn-xs btn-danger _btn" title="Belum Lengkap" data-toggle="modal" data-target="#block<?= $data['npm'] ?>">
                                                                            <i class="fa fa-fw fa-ban"></i>                             
                                                                        </button>
                                                                </td>
                                                            <?php } ?>
              
                                                                <!-- <td class="text-center"> 
                                                                    <button class="btn btn-xs btn-info" data-toggle="modal" data-target="#edit_data<?= $data['npm'] ?>">
                                                                        <?= csrf_field() ?>
                                                                            <i class="fa fa-fw fa-edit"></i>
                                                                                Edit
                                                                        </button>                                                                 
                                                                </td> -->
                                                            
                                                            

                                                         

                                                            
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
                                        
                                        <h5 class="modal-title" id="exampleModalLabel">Edit Data <?= $data['nama_berkas'] ?></h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>

                                    <div class="modal-body">
                                            <form action="<?= base_url('Backend/Berkas_tambahan/update_berkas'); ?>" method="post" enctype="multipart/form-data">
                                            <?= csrf_field() ?>
                                                <input type="hidden" name="npm" value="<?= $data['npm']; ?>">
                                                <input type="hidden" name="fileLama" value="<?= $data['file_berkas']; ?>">
                                                   

                                                

                                                    <div class="form-group">
                                                        
                                                            <label>Data File</label>   
                                                                <input type="file" class="form-control"  id="file" name="file" 
                                                                <?= $data['file_berkas'] ?> autofocus  >                                                  
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
                                            <form action="<?= base_url('Backend/Berkas_tambahan/nonlengkap'); ?>" method="post" >
                                                <?= csrf_field(); ?>
                                                    <input type="hidden" name="npm" value="<?= $data['npm']; ?>">
                                                     <input type="hidden" name="fileLama" value="<?= $data['file_berkas']; ?>">

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
