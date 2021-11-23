<?= $this->extend('layout_backend/template'); ?>

<?= $this->section('content'); ?>
<?php $this->db = db_connect(); ?>

<?php $data = $this->db->query("SELECT * FROM tb_berkas_wajib")->getRowarray(); ?>

                 
<div class="right_col" role="main">
          	<div class="x-panel">
            	<div class="page-title">        
             		 <div class="title_left">
                  		 <h3>Data Mahasiswa Belum Lengkap</h3>      
              	</div> 
       		 	<div class="clearfix"></div>

				<?php if(($data['validasi_TA'] == '0') || ($data['hard_TA']=='0') || ($data['validasi_jurnal']=='0')|| ($data['validasi_sumbangan']=='0') || ($data['validasi_peminjaman_unit']=='0') ) { ?>
					<div class="x_content">
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
										
										<table id="myTable" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
												<thead>
													<tr>
														<th class="text-center">No</th>
														<th class="text-center">NPM</th>
														<th class="text-center">NAMA MAHASISWA</th>
														<th class="text-center">PRODI</th>
														<th class="text-center">FAKULTAS</th>
														<th class="text-center">STATUS</th>
														<th class="text-center">AKSI</th>
													</tr>
												</thead>
												<tbody>
													
													<?php 
													$i = 1;
													foreach ($data_belum_lengkap as $data) { ?>
													<tr>
														<td class="text-center"><?= $i++; ?></td>
														<td class="text-center"><?= $data['npm'] ?></td>
														<td class="text-center"><?= $data['nama_mhs'] ?></td>
														<td class="text-center"><?= $data['nama_prodi'] ?></td>
														<td class="text-center"><?= $data['nama_fakultas'] ?></td>
														<?php
														
															$warna = "danger";
															$a = "Belum Lengkap";
															if(($data['validasi_TA'] == '0' || $data['hard_TA']=='0' || $data['validasi_jurnal']=='0' || $data['validasi_sumbangan']=='0' || $data['validasi_peminjaman_unit']=='0' )) {
																$warna = "danger";
																$a = "Belum Lengkap" ;			
															} 
														?>

														<td class="text-center"><span class="badge badge-<?= $warna; ?>">
																	<?php echo $a; ?></span>  
														</td>


														<td class="text-center">

																<form action="/Backend/Data_mhs/detail_data/<?= $data['npm']?>" method="post">
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
				<?php } else { ?>
					<div class="x_content">
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
										
										<table id="myTable" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
												<thead>
													<tr>
														<th class="text-center">No</th>
														<th class="text-center">NPM</th>
														<th class="text-center">NAMA MAHASISWA</th>
														<th class="text-center">PRODI</th>
														<th class="text-center">FAKULTAS</th>
														<th class="text-center">STATUS</th>
														<th class="text-center">AKSI</th>
													</tr>
												</thead>
												<tbody>
													
													<?php 
													$i = 1;
													foreach ($data_belum_lengkap as $data) { ?>
													<tr>
														<td class="text-center"><?= $i++; ?></td>
														<td class="text-center"><?= $data['npm'] ?></td>
														<td class="text-center"><?= $data['nama_mhs'] ?></td>
														<td class="text-center"><?= $data['nama_prodi'] ?></td>
														<td class="text-center"><?= $data['nama_fakultas'] ?></td>
														<?php
														
															$warna = "danger";
															$a = "Belum Lengkap";
															if(($data['validasi_TA'] == '1' || $data['hard_TA']=='1' || $data['validasi_jurnal']=='1' || $data['validasi_sumbangan']=='1' || $data['validasi_peminjaman_unit']=='1' )) {
																$warna = "danger";
																$a = "Belum Lengkap" ;			
															} 
														?>

														<td class="text-center"><span class="badge badge-<?= $warna; ?>">
																	<?php echo $a; ?></span>  
														</td>


														<td class="text-center">

																<form action="/Backend/Data_mhs/detail_data/<?= $data['npm']?>" method="post">
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
				<?php } ?>
					


                <a href="/Backend/Data_mhs/" type="button" class="btn btn-warning float-left">Kembali</a>
            </div>
          </div>
        </div>
        <!-- /page content -->

        
<?= $this->endSection(); ?>