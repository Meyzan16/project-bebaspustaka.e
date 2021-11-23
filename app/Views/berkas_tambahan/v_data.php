<?= $this->extend('layout_backend/template'); ?>

<?= $this->section('content'); ?>
<?php $this->db = db_connect(); ?>
                 
<div class="right_col" role="main">
          	<div class="x-panel">
            	<div class="page-title">        
             		 <div class="title_left">
                  		 <h3>DATA PENGGUNA BERKAS TAMBAHAN</h3>      
              	</div> 
       		 	<div class="clearfix"></div>

                    <?php if(session()->getFlashdata('gagal')){ ?>
                    <div class="alert alert-danger autohide" role="alert">
                        <?= session()->getFlashdata('gagal'); ?>
                    </div>
                <?php } ?>

                <div class="autohide">
                        <?php echo session()->getFlashdata('massage'); ?>
                </div>
					
				<div class="x_content">
						<div class="row">
							<div class="col-md-12 col-sm-12 ">
								<div class="x_panel">
									<div class="x_title">
										<h2>DATA PENGGUNA</h2>
											
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
                                                  <button class="btn btn-fill btn-info" data-toggle="modal" data-target="#tambah_data"><i class="fa fa-fw fa-plus"></i>Tambah Pengguna </button>              
 
                                                </div>
										
							<table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
									<thead>
										<tr>
											<th class="text-center">No</th>
                                            <th class="text-center">NAMA BERKAS</th>
											<th class="text-center">Catatan</th>
											<th class="text-center">Fakultas</th>
                                            <th class="text-center">PRODI</th>
                                            <th class="text-center">STATUS</th>
                                            <th class="text-center">EDIT STATUS </th>
                                            <th class="text-center">AKSI</th>
										</tr>
									</thead>
									<tbody>
										
										<?php 
										$i = 1;
										foreach ($berkas_tambahan as $data) { ?>
										<tr>
											<td class="text-center"><?= $i++; ?></td>
                                            <td class="text-center"><?= $data['nama_berkas'] ?></td>
											<td class="text-center"><?= $data['catatan'] ?></td>
                                            <td class="text-center"><?= $data['nama_fakultas'] ?></td>

                                            <?php
                                            $a = "";
                                            if ($data['kode_prodi'] == '') {
                                                $a = "-";
                                            } else {
                                                 $a = $data['nama_prodi'];
                                            }
                                            
                                            ?>
                                            
                                            <td class="text-center"><?= $a; ?></td>

                                            <?php if($data['is_active'] == '0') {
                                                                $warna = "danger";
                                                                $a = "Belum Aktif" ;
                                            } else {
                                                    $warna = "success";
                                                    $a = "Aktif" ;
                                            } ?>
                                            <td class="text-center"><span class="badge badge-<?= $warna; ?>">
                                                                                 <?php echo $a; ?></span>  
                                            </td>

											<td class="text-center">
													
                                                    <a href="<?php echo base_url('Backend/Berkas_tambahan/aktif/'.$data['id_pengguna']); ?>" class="btn btn-xs btn-info _btn" 
                                                                            data-toggle="tooltip"  title="Aktif" > 
                                                                                            <i class="fa fa-fw  fa-check"></i>
                                                    </a>

                                                                        <a href="<?php echo base_url('Backend/Berkas_tambahan/non_aktif/'.$data['id_pengguna']); ?>" class="btn btn-xs btn-danger _btn" 
                                                                            data-toggle="tooltip"  title="Tidak Aktif" > 
                                                                                            <i class="fa fa-fw fa-ban"></i>
                                                                        </a>
											</td>

                                            <td clas="text-center">
                                                    <form action="/Backend/Berkas_tambahan/hapus/<?= $data['id_pengguna'] ?>" method="post"  class="d-inline" >
                                                    <?= csrf_field(); ?>
                                                    <input type="hidden" name="hapus" id="delete">
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
						<form action="<?= base_url('Backend/Berkas_tambahan/pengguna_berkas'); ?>" method="post"  >
                    <?= csrf_field(); ?>

                    <div class="form-group">
                                <label>Pilih Berkas </label>
                                    <select name="berkas" id="berkas" class="form-control" required >
                                    <option value=""> Pilih Data </option>
                                    <?php $b = $this->db->query("SELECT * FROM jenis_berkas_tambahan")->getResultArray(); ?>                                 
                                    <?php foreach ($b as $b) { ?>
                                        <option value="<?= $b['id_jenis_berkas']; ?> "><?= $b['nama_berkas']; ?></option>
                                    <?php } ?>
                                    </select>
                            </div>      

                        <label>Fakultas</label>
                        <select name="fakultas" id="fakultas" class="form-control" required >
                            <?php $b = $this->db->query("SELECT * FROM tb_fakultas")->getResultArray(); ?>
                                <option value="">Pilih Data</option>
                            <?php foreach($b as $b )  {?>
                                <option value="<?= $b['kode_fakultas'] ?>"> <?= $b['nama_fakultas'] ?></option>
                            <?php } ?>    
                        </select>  

                        <label>Prodi</label>
                        <select name="prodi" id="prodi" class="form-control" >
                            <?php $b = $this->db->query("SELECT * FROM tb_prodi GROUP BY kode_prodi")->getResultArray(); ?>
                                <option value="">Pilih Data</option>
                            <?php foreach($b as $b )  {?>
                                <option id="prodi" class="<?php echo $b['kode_fakultas']; ?>" value="<?= $b['kode_prodi'] ?>"> <?= $b['nama_prodi'] ?></option>
                            <?php } ?>    
                        </select>  
                                                                   
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



<!-- <?php foreach($berkas_tambahan as $data) { ?> 
<div class="modal fade" id="edit_data<?= $data['id_pengguna'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Berkas Prodi <?= $data['nama_prodi'] ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>

              <div class="modal-body">
                    <form action="<?= base_url('Backend/verifikator/update_pengguna_berkas'); ?>" method="post" >
                    <?= csrf_field(); ?>
                         <input type="hidden" name="id_pengguna" value="<?= $data['id_pengguna']; ?>">

                            <div class="form-group">
                                <label>Pilih Berkas </label>
                                    <select name="berkas" id="berkas" class="form-control" >
                                    <option value="<?= $data['id_jenis_berkas'] ?>"> <?= $data['nama_berkas'] ?></option>
                                    <?php $b = $this->db->query("SELECT * FROM jenis_berkas_tambahan")->getResultArray(); ?>                                 
                                    <?php foreach ($b as $b) { ?>
                                    <?php if($b['id_jenis_berkas'] != $data['id_jenis_berkas']) { ?>
                                        <option value="<?= $b['id_jenis_berkas']; ?> "><?= $b['nama_berkas']; ?></option>
                                    <?php } ?>
                                    <?php } ?>
                                    </select>
                            </div>

                            

                            <div class="form-group">
                                <label>Fakultas</label>
                                <select name="fakultas" id="fakultas" class="form-control" >
                                 <option value="<?= $data['kode_fakultas'] ?>"> <?= $data['nama_fakultas'] ?></option>
                                 <?php $b = $this->db->query("SELECT * FROM tb_fakultas ")->getResultArray(); ?>                                 
                                <?php foreach ($b as $b) { ?>
                                  <?php if($b['kode_fakultas'] != $data['kode_fakultas']) { ?>
                                    <option value="<?= $b['kode_fakultas']; ?> "><?= $b['nama_fakultas']; ?></option>
                                  <?php } ?>
                                <?php } ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Prodi</label>
                                <select name="prodi" id="prodi" class="form-control" >
                                 <option value="<?= $data['kode_prodi'] ?>"> <?= $data['nama_prodi'] ?> </option>
                                 <?php $b = $this->db->query("SELECT * FROM tb_prodi GROUP BY kode_prodi")->getResultArray(); ?>                                 
                                <?php foreach ($b as $b) { ?>
                                    <?php if($b['kode_prodi'] != $data['kode_prodi']) { ?>
                                        <option id="prodi" class="<?php echo $b['kode_fakultas']; ?>" value="<?= $b['kode_prodi']; ?> ">
                                            <?= $b['nama_prodi']; ?>
                                        </option>
                                    <?php } ?>
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
    <?php }  ?>  -->


<?= $this->endSection(); ?>