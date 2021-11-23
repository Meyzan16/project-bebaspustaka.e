<?= $this->extend('layout_backend/template'); ?>

<?= $this->section('content'); ?>
<?php $this->db = db_connect(); ?>
                 
<div class="right_col" role="main">
          	<div class="x-panel">
            	<div class="page-title">        
             		 <div class="title_left">
                  		 <h3> <?= $title; ?></h3>      
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
										<h2>DATA</h2>
											
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
                                            <th class="text-center">ISI SUBJUDUL</th>											
											<th class="text-center">Tanggal Mulai</th>
                                            <th class="text-center">Tanggal Selesai</th>
                                            <th class="text-center">STATUS</th>
                                            <th class="text-center">AKSI</th>
										</tr>
									</thead>
									<tbody>
										
										<?php 
										$i = 1;
										foreach ($homepage as $data) { ?>
										<tr>
											<td class="text-center"><?= $i++; ?></td>
                                            <td class="text-center"><?= $data['isi'] ?></td>
                                            <?php 
                                                $konversi = strtotime($data['tanggal_mulai']);
                                                $konversi1 = strtotime($data['tanggal_selesai']);
                                                $skrang = date('d/M/Y', $konversi );
                                                $skrang1 = date('d/M/Y', $konversi1 );
                                            ?>
											<td class="text-center"><?= $skrang ?></td>
                                            <td class="text-center"><?= $skrang1 ?></td>
                                            <?php 
                                            $warna = "";
                                            $a = "";
                                            if($data['is_active'] != 'Aktif'){
                                                $warna = "danger";
                                                $a = "Tidak Aktif";
                                            }else {
                                                $warna = "success";
                                                $a= "Aktif";

                                            }


                                            ?>
                                            <td class="text-center"><span class="badge badge-<?= $warna; ?>">
                                                                                 <?php echo $a; ?></span>  
                                            </td>


                                            <td class="text-center">

                                                    <button   button class="btn btn-xs btn-info" data-toggle="modal" data-target="#edit_data<?= $data['id'] ?>">
                                                                        <i class="fa fa-fw fa-edit"></i>
                                                                            Edit
                                                    </button>
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





<?php foreach($homepage as $data) { ?> 
<div class="modal fade" id="edit_data<?= $data['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Jenis Berkas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>

              <div class="modal-body">
                    <form action="<?= base_url('Backend/Halaman_utama/update'); ?>" method="post" >
                    <?= csrf_field(); ?>
                         <input type="hidden" name="id" value="<?= $data['id']; ?>">

                         <div class="form-group">
                            <label>Nama Berkas </label>
                              <textarea name="isi" id="editor1" class="form-control" rows="5" class="form-control">
                                                            <?= $data['isi'] ?>
                                                        </textarea>

                            <label for="foto" class="col-md-4 col-form-label">Tanggal Mulai </label>
                            <input type="date" class="form-control" name="tgl_mulai" value="<?= $data['tanggal_mulai'] ?>"  autofocus required >

                            <label for="foto" class="col-md-4 col-form-label">Tanggal Selesai </label>
                            <input type="date" class="form-control" name="tgl_selesai" value="<?= $data['tanggal_mulai'] ?>"  autofocus required >

                            <label class="col-md-4 col-form-label">STATUS </label>                          
                            <select name="status" id="status" class="form-control" >
                                <option value="<?= $data['is_active']; ?>"> <?= $data['is_active']; ?> </option>                            
                                  <?php if($data['is_active'] == 'Aktif') { ?>
                                    <option value="Tidak Aktif">Tidak Aktif</option>
                                  <?php }else {?>
                                          <option value="Aktif">Aktif</option>
                                <?php } ?>
                            </select>
                                                                      
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