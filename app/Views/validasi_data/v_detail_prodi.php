<?= $this->extend('layout_backend/template'); ?>

<?= $this->section('content'); ?>

                 
<div class="right_col" role="main">
          	<div class="x-panel">
            	<div class="page-title">        
             		 <div class="title_left">
                  		 <h3>DATA PRODI</h3>      
              	</div> 
       		 	<div class="clearfix"></div>
					
				<div class="x_content">
						<div class="row">
							<div class="col-md-12 col-sm-12 ">
								<div class="x_panel">
									<div class="x_title">
										<h2>Data PRODI </h2>
											
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
                                            <th class="text-center">NAMA PRODI</th>
											<th class="text-center">FAKULTAS</th>
											<th class="text-center">AKSI</th>
										</tr>
									</thead>
									<tbody>
										
										<?php 
										$i = 1;
										foreach ($data_prodi as $data) { ?>
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
								
								<a href="/Backend/Data_mhs" type="button" class="btn btn-warning float-left">Kembali</a>
							</div>
						</div>
					</div>
		
				
				
				
		

            </div>
          </div>
        </div>
        <!-- /page content -->

        
<?= $this->endSection(); ?>