<?php $this->db = db_connect(); ?>

<?= $this->extend('layout_backend/template'); ?>
<?= $this->section('content'); ?>

			<div class="right_col" role="main">
          			<div class="x-panel">
            			<div class="page-title">        
             		 		<div class="title_left">
                  		 		<h3>Profil</h3>      
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
                                                    <h2>Setting Password </h2>
                                                        
                                                    <ul class="nav navbar-right panel_toolbox">
                                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                                        </li>
                                                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                                                        </li>
                                                    </ul>
                                                    <div class="clearfix"></div>
                                                </div>

                                                <div class="x_content">
                                                     <button class="btn btn-fill btn-info" data-toggle="modal" data-target="#tambah_data"><i class="fa fa-fw fa-edit"></i> Edit Data </button>          
                                                </div>

                                                <div class="x_content">  
                                                <div class="row">
                                                    
                                                        <table class="table table-hover">
                                                        <?php 
                                                            $i = 1;
                                                            foreach ($user_role as $data) { ?>
                                                        <?php } ?>
                                                            <tr><td>Nama</td><td> : </td><td><?= $data['nama_user'] ?></td></tr>
                                                            <tr><td>Username</td><td> : </td><td><?= $data['username'] ?></td></tr>
                                                            <tr><td>Password</td><td> : </td><td>*********************************</td></tr>
                                                            <tr><td>Verifikator Fakultas</td><td> : </td><td><?= $data['nama_fakultas'] ?></td></tr>
                                                        </table>
                                                </div>  
                                               

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
						<form action="<?= base_url('Backend/verifikator/update_pass'); ?>" method="post"  >
                    <?= csrf_field(); ?>
                    
                    <?php foreach ($user_role as $data) { ?>
                    <?php } ?>

                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" value="<?= $data['nama_user'] ?>" class="form-control" name="nama" placeholder="Nama" maxlength="30" autofocus required >  

                        <label>Username</label>
                        <input type="text" value="<?= $data['username'] ?>" class="form-control" name="username" placeholder="Username" maxlength="50" autofocus required >   

                        <label>Password</label>
                        <input type="text" value="<?= $data['password'] ?>" class="form-control" name="password" placeholder="Password" maxlength="50" autofocus required > 
                                                     
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


				
		

            


        
<?= $this->endSection(); ?>