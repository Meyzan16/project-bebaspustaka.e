<?= $this->extend('layout_backend/template'); ?>

<?= $this->section('content'); ?>
			
		<?php if(session()->get('id_role') == '2') { ?>
			<div class="right_col" role="main">
          			<div class="x-panel">
            			<div class="page-title">        
             		 		<div class="title_left">
                  		 		<h3>Data Prodi</h3>      
              				</div> 
       		 				<div class="clearfix"></div>
					<div class="x_content">     
							<div class="row">
										<form action="/Backend/Data_mhs/data_lengkap" method="post">
											 <button type="submit" name="lengkap" class="btn btn-round btn-success">Data Lengkap</button>
										</form>
										
										<!-- <form action="/Backend/Data_mhs/data_belum_lengkap" method="post">
												<button type="submit" name="belum_lengkap" class="btn btn-round btn-info">Data Belum Lengkap</button>
										</form>    -->
							</div>
						<div class="row">
							<div class="col-md-12 col-sm-12 ">
								<div class="x_panel">
									<div class="x_title">
										<h2>Data Prodi </h2>
											
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
											<th class="text-center">PRODI</th>
											<th class="text-center">FAKULTAS</th>
											<th class="text-center">AKSI</th>
										</tr>
									</thead>
									<tbody>
										
										<?php 
										$i = 1;
										foreach ($data_unit as $data) { ?>
										<tr>
											<td class="text-center"><?= $i++; ?></td>
											<td class="text-center"><?= $data['nama_prodi'] ?></td>
											<td class="text-center"><?= $data['nama_fakultas'] ?></td>

											<td class="text-center">
													<form action="/Backend/Data_mhs/detail_prodi_mhs/<?= $data['kode_prodi']?>" method="post">
																	<button type="submit" name="detail_data" class="btn btn-xs btn-info" ><i class="fa fa-fw fa-info"></i> Detail Data
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

			<?php } else if(session()->get('id_role') == '1') { ?>
				<div class="right_col" role="main">
          			<div class="x-panel">
            			<div class="page-title">        
             		 		<div class="title_left">
                  		 		<h3>Data Fakultas</h3>      
              				</div> 
       		 				<div class="clearfix"></div>
							<div class="x_content">
								<div class="row">
									<div class="col-md-12 col-sm-12 ">
										<div class="x_panel">
											<div class="x_title">
												<h2>Data Fakultas </h2>
													
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
													<th class="text-center">FAKULTAS</th>
													<th class="text-center">AKSI</th>
												</tr>
											</thead>
											<tbody>
												
												<?php 
												$i = 1;
												foreach ($data_pusat as $data) { ?>
												<tr>
													<td class="text-center"><?= $i++; ?></td>
													<td class="text-center"><?= $data['nama_fakultas'] ?></td>
													<td class="text-center">


															<a href="/Backend/Data_mhs/detail_prodi/<?= $data['kode_fakultas']?>">
																			<button type="submit" name="detail_data" class="btn btn-xs btn-info" ><i class="fa fa-fw fa-info"></i> Detail Data
																			</button>

															</a>
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

			<?php } else if(session()->get('username') == 'unib') { ?>
				<div class="right_col" role="main">
          			<div class="x-panel">
            			<div class="page-title">        
             		 		<div class="title_left">
                  		 		<h3>Data Fakultas</h3>      
              				</div> 
       		 				<div class="clearfix"></div>
							<div class="x_content">
								<div class="row">
									<div class="col-md-12 col-sm-12 ">
										<div class="x_panel">
											<div class="x_title">
												<h2>Data Fakultas </h2>
													
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
													<th class="text-center">FAKULTAS</th>
													<th class="text-center">AKSI</th>
												</tr>
											</thead>
											<tbody>
												
												<?php 
												$i = 1;
												foreach ($data_pusat as $data) { ?>
												<tr>
													<td class="text-center"><?= $i++; ?></td>
													<td class="text-center"><?= $data['nama_fakultas'] ?></td>
													<td class="text-center">


															<a href="/Backend/Data_mhs/detail_prodi/<?= $data['kode_fakultas']?>">
																			<button type="submit" name="detail_data" class="btn btn-xs btn-info" ><i class="fa fa-fw fa-info"></i> Detail Data
																			</button>

															</a>
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
			<?php } ?>
				
				
				
		

            


        
<?= $this->endSection(); ?>