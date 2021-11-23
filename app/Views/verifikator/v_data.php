<?php $this->db = db_connect(); ?>

<?= $this->extend('layout_backend/template'); ?>
<?= $this->section('content'); ?>

			<div class="right_col" role="main">
          			<div class="x-panel">
            			<div class="page-title">        
             		 		<div class="title_left">
                  		 		<h3>Data Verifikator</h3>      
              				</div> 
       		 				<div class="clearfix"></div>
                            <div class="x_content">     

                            <div class="autohide">
                                <?php echo session()->getFlashdata('message'); ?>
                            </div>

                            <?php if(session()->getFlashdata('gagal')){ ?>
                                <div class="alert alert-danger autohide" role="alert">
                                    <?= session()->getFlashdata('gagal'); ?>
                                </div>
                            <?php } ?>

                                    <div class="row">
                                        <div class="col-md-12 col-sm-12 ">
                                            <div class="x_panel">
                                                <div class="x_title">
                                                    <h2>Data Verifikator </h2>
                                                        
                                                    <ul class="nav navbar-right panel_toolbox">
                                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                                        </li>
                                                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                                                        </li>
                                                    </ul>
                                                    <div class="clearfix"></div>
                                                </div>

                                                <div class="x_content">
                                                <button class="btn btn-fill btn-info" data-toggle="modal" data-target="#tambah_data"><i class="fa fa-fw fa-plus"></i>Tambah Data</button>          
                                                </div>

                                                <div class="x_content">    
                                                <table id="myTable" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                                        <thead>
                                                            <tr>
                                                                <th class="text-center">No</th>
                                                                <th class="text-center">Nama User</th>
                                                                <th class="text-center">Username</th>
                                                                <th class="text-center">Nama Fakultas</th>
                                                                <th class="text-center">AKSI</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            
                                                            <?php  
                                                            $i = 1;
                                                            foreach ($user_role_pusat as $data) { ?>
                                                            <tr>
                                                                <td class="text-center"><?= $i++; ?></td>
                                                                <td class="text-center"><?= $data['nama_user'] ?></td>
                                                                <td class="text-center"><?= $data['username'] ?></td>
                                                                <td class="text-center"><?= $data['nama_fakultas'] ?></td>

                                                                <td class="text-center">

                                                                    <button class="btn btn-xs btn-info" data-toggle="modal" data-target="#edit_data<?= $data['id_user'] ?>">
                                                                        <i class="fa fa-fw fa-edit"></i>
                                                                            Edit
                                                                    </button>                                                                     
                                                                     

                                                                    <form action="/Backend/verifikator/hapus/<?= $data['id_user']; ?>" method="post"  class="d-inline">
                                                                    <?= csrf_field() ?>
                                                                    <input type="hidden" name="hapus" value="DELETE">
                                                                        <button type="submit" name="hapus"  class="btn btn-xs btn-danger " onclick="return confirm('Apakah Anda Yakin Hapus Data ?')" > <i class="fa fa-fw fa-trash"> </i> Delete
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



<div class="modal fade" id="tambah_data" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Tambah Data Verifikator</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
          
					<div class="modal-body">
						<form action="<?= base_url('Backend/verifikator/create'); ?>" method="post"  >
                    <?= csrf_field(); ?>

                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" class="form-control" name="nama" placeholder="Nama" maxlength="30" autofocus required >  

                        <label>Username</label>
                        <input type="text" class="form-control" name="username" placeholder="Username" maxlength="50" autofocus required >   

                        <label>Password</label>
                        <input type="text" class="form-control" name="password" placeholder="Password" maxlength="50" autofocus required > 

                        <label>Fakultas</label>
                        <select name="fakultas" id="fakultas" class="form-control">
                            <?php $b = $this->db->query("SELECT * FROM tb_fakultas")->getResultArray(); ?>
                                <option value="">Pilih Data</option>
                            <?php foreach($b as $b )  {?>
                                <option value="<?= $b['kode_fakultas'] ?>"> <?= $b['nama_fakultas'] ?></option>
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



<?php foreach($user_role_pusat as $data) { ?> 
<div class="modal fade" id="edit_data<?= $data['id_user'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit data Verifikator</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>

              <div class="modal-body">
                    <form action="<?= base_url('Backend/verifikator/update'); ?>" method="post" >
                         <input type="hidden" name="id_user" value="<?= $data['id_user']; ?>">

                            <div class="form-group">
                                <label>Nama</label>
                                <input type="text" class="form-control" name="nama"  maxlength="30"
                                value="<?php echo $data['nama_user']; ?>" autofocus >
                            </div>

                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" class="form-control" name="username" 
                                value="<?php echo $data['username']; ?>" maxlength="50" autofocus >
                            </div>

                            <div class="form-group">
                                <label>Password</label>
                                <input type="text" class="form-control" name="password" 
                                value="<?php echo $data['password']; ?>" maxlength="50" autofocus >
                            </div>
                            

                            <div class="form-group">
                                <label>Prodi</label>
                                <select name="fakultas" id="fakultas" class="form-control" >
                                 <option value="<?= $data['kode_fakultas'] ?>"> <?= $data['nama_fakultas'] ?></option>
                                 <?php $b = $this->db->query("SELECT * FROM tb_fakultas")->getResultArray(); ?>                                 
                                <?php foreach ($b as $b) { ?>
                                  <?php if($b['kode_fakultas'] != $data['kode_fakultas']) { ?>
                                    <option value="<?= $b['kode_fakultas']; ?> "><?= $b['nama_fakultas']; ?></option>
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
<?php }  ?> 
				
				
		

            


        
<?= $this->endSection(); ?>