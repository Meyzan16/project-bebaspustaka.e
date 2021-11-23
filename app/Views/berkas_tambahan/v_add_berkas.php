<?= $this->extend('layout_backend/template'); ?>

<?= $this->section('content'); ?>
<?php $this->db = db_connect(); ?>
                 
<div class="right_col" role="main">
          	<div class="x-panel">
            	<div class="page-title">        
             		 <div class="title_left">
                  		 <h3>DATA BERKAS TAMBAHAN</h3>      
              	</div> 
       		 	<div class="clearfix"></div>

                <div class="autohide">
                        <?php echo session()->getFlashdata('massage'); ?>
                </div>
					
				<div class="x_content">
						<div class="row">
							<div class="col-md-12 col-sm-12 ">
								<div class="x_panel">
									<div class="x_title">
										<h2>BERKAS TAMBAHAN</h2>
											
										<ul class="nav navbar-right panel_toolbox">
											<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
											</li>
											<li><a class="close-link"><i class="fa fa-close"></i></a>
											</li>
										</ul>
										<div class="clearfix"></div>
									</div>
									<div class="x_content">
                                    <div class="x_content">
                                                <button class="btn btn-fill btn-info" data-toggle="modal" data-target="#tambah_data"><i class="fa fa-fw fa-plus"></i>Tambah Data</button>          
                                                </div>
										
							<table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
									<thead>
										<tr>
											<th class="text-center">No</th>
                                            <th class="text-center">NAMA BERKAS</th>
											<th class="text-center">Catatan</th>
											<th class="text-center">Tanggal Diupdate</th>
                                            <th class="text-center">AKSI</th>
										</tr>
									</thead>
									<tbody>
										
										<?php 
										$i = 1;
										foreach ($jenis_berkas as $data) { ?>
										<tr>
											<td class="text-center"><?= $i++; ?></td>
                                            <td class="text-center"><?= $data['nama_berkas'] ?></td>
											<td class="text-center"><?= $data['catatan'] ?></td>
                                            <td class="text-center"><?= $data['created_at'] ?></td>


                                            <td class="text-center">

                                                    <button    class="btn btn-xs btn-info" data-toggle="modal" data-target="#edit_data<?= $data['id_jenis_berkas'] ?>">
                                                                        <i class="fa fa-fw fa-edit"></i>
                                                                            Edit
                                                    </button>

                                                    <form action="/Backend/Berkas_tambahan/hapus_jenis_berkas/<?= $data['id_jenis_berkas'] ?>" method="post"  class="d-inline" >
                                                    <?= csrf_field(); ?>
                                                        <button type="submit" name="hapus" class="btn btn-xs btn-danger"onclick="return confirm('Apakah Anda Yakin Hapus Data ?')" > <i class="fa fa-fw fa-trash"> </i> Delete
                                                        </button>
                                                    </form>

                                            </td>
										</tr>
										
										<?php } ?>                 
											
									</tbody>
							</table>

									</div>
								</div>
							</div>
						</div>
					</div>
			

            </div>
          </div>
        </div>
        <!-- /page content -->

<div class="modal fade" id="tambah_data" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Tambah Data Berkas</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
          
					<div class="modal-body">
				<form action="<?= base_url('Backend/Berkas_tambahan/add_berkas'); ?>" method="post"  >
                    <?= csrf_field(); ?>

                    <div class="form-group">
                        <label>Nama Berkas </label>
                        <input type="text" class="form-control" name="nama" placeholder="nama berkas" autofocus required >  

                        <label for="foto" class="col-md-4 col-form-label">Catatan </label>
                        <input type="text" class="form-control" name="catatan"  autofocus required placeholder="Catatan ">

                                                                   
                    </div>

                      <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="submit" name="tambah" class="btn btn-primary">Submit</button>
                      </div>
              </form>
					</div>

				</div>
			</div>
</div>



<?php foreach($jenis_berkas as $data) { ?> 
<div class="modal fade" id="edit_data<?= $data['id_jenis_berkas'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Jenis Berkas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>

              <div class="modal-body">
                    <form action="<?= base_url('Backend/Berkas_tambahan/update_jenis_berkas'); ?>" method="post" >
                    <?= csrf_field(); ?>
                         <input type="hidden" name="id_jenis_berkas" value="<?= $data['id_jenis_berkas']; ?>">

                         <div class="form-group">
                            <label>Nama Berkas </label>
                            <input type="text" class="form-control" name="nama" value="<?= $data['nama_berkas'] ?>" placeholder="nama berkas" autofocus required >  

                            <label for="foto" class="col-md-4 col-form-label">Catatan </label>
                            <input type="text" class="form-control" name="catatan" value="<?= $data['catatan'] ?>"  autofocus required placeholder="Catatan ">

                                                                      
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


<?= $this->endSection(); ?>