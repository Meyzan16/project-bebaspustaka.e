<?= $this->extend('layout_backend/template'); ?>

<?= $this->section('content'); ?>
<?php $this->db = db_connect(); ?>
                   <?php foreach($data_mhs as $data) {?>                  
                    <?php } ?>



<div class="right_col" role="main">
          <div class="">
            <div class="page-title">        
              <div class="title_left">
                   <h3>VALIDASI DATA </h3>
                   <h5 class="text-right;" style="color: darkgreen; text-transform: uppercase;">DETAIL :  <?= $data['npm'] ?> <?= $data['nama_mhs'] ?></h5>
                    <h5 class="text-right;" style="color: darkgreen; text-transform: uppercase;">PRODI  :  <?= $data['nama_prodi'] ?> </h5>
                    

              </div> 
        <div class="clearfix"></div>
          
               
                <div class="autohide">
                <?php echo session()->getFlashdata('message'); ?>
                </div>

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
                      


                                    <a href="<?php echo base_url('Backend/Validasi/valid_ta/' . $data['npm']); ?>" > 
                                        <button type="button" class="btn btn-round btn-secondary">Validasi TA</button>
                                    </a>    

                                    <a href="<?php echo base_url('Backend/Validasi/valid_hard_file/' . $data['npm']); ?>" > 
                                     <button type="button" class="btn btn-round btn-warning">Validasi Hard File</button>
                                    </a> 

                                    <a href="<?php echo base_url('Backend/Validasi_jurnal/valid_jurnal/' . $data['npm']); ?>" > 
                                         <button type="button" class="btn btn-round btn-primary">Validasi Jurnal</button>
                                    </a> 

                                    
                                    <?php if($data['jenis_TA'] == 'TESIS' || $data['jenis_TA'] == 'DISERTASI') {?>   
                                    <a href="<?php echo base_url('Backend/Validasi_sum/valid_sum/' . $data['npm']); ?>" >     
                                         <button type="button" class="btn btn-round btn-success">Validasi File Sumbangan</button>
                                    </a> 
                                    <?php } ?>


                                    <a href="<?php echo base_url('Backend/Validasi_unit/valid_unit/' . $data['npm']); ?>" >     
                                    <button type="button" class="btn btn-round btn-info">Validasi Peminjaman Unit</button>
                                    </a>  
                                    
                                    
                                    <?php if(session()->get('id_role') != '2') {?>
                                        <a href="<?php echo base_url('Backend/Validasi_pusat/valid_pusat/' . $data['npm']); ?>" >     
                                        <button type="button" class="btn btn-round btn-dark">Validasi Peminjaman Pusat</button>
                                        </a>                          
                                    <?php } ?>
                                   

                                    
                                    <?php
                                     $kode_fakultas = $data['kode_fakultas'];
                                     $kode_prodi = $data['kode_prodi'] ;
                                     $npm = $data['npm'];

                                    //query pengguna berkas
                                    $pengguna_berkas_fak = $this->db->query("SELECT * FROM tb_pengguna_berkas JOIN
                                    jenis_berkas_tambahan ON jenis_berkas_tambahan.id_jenis_berkas = tb_pengguna_berkas.id_jenis_berkas                    
                                    WHERE
                                    kode_fakultas='$kode_fakultas' AND
                                    kode_prodi='$kode_prodi'        
                                    ")->getRowArray();

                                    $pengguna_berkas_fak1 = $this->db->query("SELECT * FROM tb_pengguna_berkas JOIN
                                    jenis_berkas_tambahan ON jenis_berkas_tambahan.id_jenis_berkas = tb_pengguna_berkas.id_jenis_berkas                    
                                    WHERE
                                    kode_fakultas='$kode_fakultas' OR
                                    kode_prodi='$kode_prodi'        
                                    ")->getRowArray();

                                    //cek tb_berkas_tambahan ada tidak npm nya              
                                    $tb_berkas_tambahan = $this->db->query("SELECT * FROM tb_berkas_tambahan WHERE npm = '$npm' ")->getRowArray();                      
                                    ?>

                                            <?php                                    
                                                if($pengguna_berkas_fak && $pengguna_berkas_fak['kode_prodi'] == $kode_prodi  && $pengguna_berkas_fak['is_active'] == 1 ){  ?>     
                                                    <?php if($tb_berkas_tambahan) {?>
                                                        <a href="<?php echo base_url('Backend/Berkas_tambahan/validasi_berkas/' . $data['npm']); ?>" >     
                                                           <button type="button" class="btn btn-round btn-info"><?= $pengguna_berkas_fak['nama_berkas'] ?></button>
                                                       </a>                  
                                                    <?php } ?>                         
                                                <?php } else if($pengguna_berkas_fak1 && $pengguna_berkas_fak1['kode_prodi'] == ''  && $pengguna_berkas_fak1['is_active'] == 1  ) { ?>
                                                    <?php if($tb_berkas_tambahan) {?>
                                                            <a href="<?php echo base_url('Backend/Berkas_tambahan/validasi_berkas/' . $data['npm']); ?>" >     
                                                                <button type="button" class="btn btn-round btn-info"><?= $pengguna_berkas_fak1['nama_berkas'] ?></button>
                                                            </a>  
                                                    <?php } ?>
                                            <?php }  ?>
                                </div>
                                
								<div class="x_content">
									
                                        <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                                <thead>
                                                        <tr>
                                                            <th class="text-center">No</th>
                                                            <th class="text-center">Data Tugas Akhir</th>
                                                            <th class="text-center">Data Hard File</th>
                                                            <th class="text-center">Data File Jurnal</th>

                                                            <?php if($data['jenis_TA'] == 'TESIS' || $data['jenis_TA'] == 'DISERTASI') {?>
                                                                <th class="text-center">Data File Sumbangan</th>
                                                            <?php } ?>

                                                           
                                                            <?php                                    
                                                                if($pengguna_berkas_fak && $pengguna_berkas_fak['kode_prodi'] == $kode_prodi  && $pengguna_berkas_fak['is_active'] == 1 ){  ?>     
                                                                    <?php if($tb_berkas_tambahan) {?>
                                                                        <th class="text-center">Data <?=$pengguna_berkas_fak['nama_berkas'] ?></th> 
                                                                    <?php } ?>                         
                                                                <?php } else if($pengguna_berkas_fak1 && $pengguna_berkas_fak1['kode_prodi'] == ''  && $pengguna_berkas_fak1['is_active'] == 1  ) { ?>
                                                                    <?php if($tb_berkas_tambahan) {?>
                                                                        <th class="text-center">Data <?=$pengguna_berkas_fak1['nama_berkas'] ?></th>     
                                                                    <?php } ?>
                                                            <?php }  ?>


                                                            

                                                             <th class="text-center">Data Peminjaman Unit</th>   
                                                            <?php if(session()->get('id_role') != '2'){?>
                                                                <th class="text-center">Data Peminjaman Pusat</th>   
                                                            <?php } ?> 

                                                            

                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                    <?php $i=1;
                                                    foreach($data_mhs as $data) :  ?>
                                                        <tr>
                                                            <td class="text-center"><?= $i++ ?></td>

                                                            <?php if($data['validasi_TA'] == '0') {
                                                                $warna = "danger";
                                                                $a = "Belum Lengkap" ;
                                                            } else {
                                                                $warna = "success";
                                                                $a = "Lengkap" ;
                                                            } ?>

                                                            <td class="text-center"><span class="badge badge-<?= $warna; ?>">
                                                                                 <?php echo $a; ?></span>  
                                                                <br> <br>

                                                                <?php if($data['file_TA'] == '' && $data['validasi_TA'] == '0'  &&  $data['catatan_ta'] != '' ) { ?>
                                                                        <p>Verifikasi Ditolak, Dengan Catatan <?= $data['catatan_ta'] ?></p>
                                                                    <?php } if($data['file_TA'] != ''  && $data['validasi_TA'] == '0' && $data['catatan_ta'] != '') {?>
                                                                        <p>Menunggu Diverifikasi Ulang</p>
                                                                    <?php } if($data['file_TA'] != '' && $data['validasi_TA'] == '1' && $data['catatan_ta'] == '') {?>
                                                                        <p>Verifikasi Diterima</p>
                                                                    <?php } if($data['file_TA'] != '' && $data['validasi_TA'] == '0' && $data['catatan_ta'] == '') {?>
                                                                        <p>Data Belum Diverifikasi</p>
                                                                <?php }  ?>  

                                                            </td>

                                                            <?php if($data['hard_TA'] == '0') {
                                                                $warna1 = "danger";
                                                                $b = "Belum Lengkap" ;
                                                            } else {
                                                                $warna1 = "success";
                                                                $b = "Lengkap" ;
                                                            } ?>

                                                            <td class="text-center"><span class="badge badge-<?= $warna1; ?>">
                                                                                 <?php echo $b; ?></span>  
                                                                                 <br><br>
                                                                 <?php if( $data['hard_TA'] == '0'  &&  $data['catatan_hard_file'] != '' ) { ?>
                                                                        <p>Verifikasi Ditolak, Dengan Catatan <?= $data['catatan_hard_file'] ?></p>
                                                                    <?php } if($data['hard_TA'] == '1' && $data['catatan_hard_file'] == '') {?>
                                                                        <p>Verifikasi Diterima</p>
                                                                    <?php } if($data['hard_TA'] == '0' && $data['catatan_hard_file'] == '') {?>
                                                                        <p>Data Belum Diverifikasi</p>
                                                                <?php }  ?> 
                                                            </td>

                                                            <?php if($data['validasi_jurnal'] == '0') {
                                                                $warna2 = "danger";
                                                                $c = "Belum Lengkap" ;
                                                            } else {
                                                                $warna2 = "success";
                                                                $c = "Lengkap" ;
                                                            } ?>

                                                            <td class="text-center"><span class="badge badge-<?= $warna2; ?>">
                                                                                 <?php echo $c; ?></span>  
                                                                 <br> <br>

                                                                <?php if($data['file_jurnal'] == '' && $data['validasi_jurnal'] == '0'  &&  $data['catatan_jurnal'] != '' ) { ?>
                                                                        <p>Verifikasi Ditolak, Dengan Catatan <?= $data['catatan_jurnal'] ?></p>
                                                                    <?php } if($data['file_jurnal'] != ''  && $data['validasi_jurnal'] == '0' && $data['catatan_jurnal'] != '') {?>
                                                                        <p>Menunggu Diverifikasi Ulang</p>
                                                                    <?php } if($data['file_jurnal'] != '' && $data['validasi_jurnal'] == '1' && $data['catatan_jurnal'] == '') {?>
                                                                        <p>Verifikasi Diterima</p>
                                                                    <?php } if($data['file_jurnal'] != '' && $data['validasi_jurnal'] == '0' && $data['catatan_jurnal'] == '') {?>
                                                                        <p>Data Belum Diverifikasi</p>
                                                                <?php }  ?>  
                                                            </td>


                                                            
                                                            <?php if($data['validasi_sumbangan'] == '0') {
                                                                $warna3 = "danger";
                                                                $d = "Belum Lengkap" ;
                                                            } else {
                                                                $warna3 = "success";
                                                                $d = "Lengkap" ;
                                                            } ?>

                                                            
                                                            <?php if($data['jenis_TA'] == 'TESIS' || $data['jenis_TA'] == 'DISERTASI') {?>                                                                
                                                                    <td class="text-center"><span class="badge badge-<?= $warna3; ?>">
                                                                                         <?php echo $d; ?></span>  
        
                                                                                         <br><br>
                                                                         <?php if($data['file_sumbangan'] == '' && $data['validasi_sumbangan'] == '0'  &&  $data['catatan_sum'] != '' ) { ?>
                                                                                <p>Verifikasi Ditolak, Dengan Catatan <?= $data['catatan_sum'] ?></p>
                                                                            <?php } if($data['file_sumbangan'] != ''  && $data['validasi_sumbangan'] == '0' && $data['catatan_sum'] != '') {?>
                                                                                <p>Menunggu Diverifikasi Ulang</p>
                                                                            <?php } if($data['file_sumbangan'] != '' && $data['validasi_sumbangan'] == '1' && $data['catatan_sum'] == '') {?>
                                                                                <p>Verifikasi Diterima</p>
                                                                            <?php } if($data['file_sumbangan'] != '' && $data['validasi_sumbangan'] == '0' && $data['catatan_sum'] == '') {?>
                                                                                <p>Data Belum Diverifikasi</p>
                                                                        <?php }  ?> 
                                                                    </td>
                                                            <?php } ?>


                                                            <?php 
                                                                if($pengguna_berkas_fak && $pengguna_berkas_fak['kode_prodi'] == $kode_prodi  && $pengguna_berkas_fak['is_active'] == 1 ){  ?>  
            
                                                                    <?php if($tb_berkas_tambahan) { ?>
                                                                        <?php 
                                                                            if($tb_berkas_tambahan['validasi_berkas'] == 0 && $tb_berkas_tambahan['catatan_berkas'] != '') {
                                                                                                                        $warna5 = "danger";
                                                                                                                        $f = "Belum Lengkap" ;
                                                                                    
                                                                                    }else if($tb_berkas_tambahan['validasi_berkas'] == 1 && $tb_berkas_tambahan['catatan_berkas'] != '') {
                                                                                        $warna5 = "danger";
                                                                                        $f = "Belum Lengkap" ;
                                                                                    }else if($tb_berkas_tambahan['validasi_berkas'] == 1 && $tb_berkas_tambahan['catatan_berkas'] == '') {
                                                                                        $warna5 = "success";
                                                                                        $f = "Lengkap" ;
                                                                                    }else if($tb_berkas_tambahan['validasi_berkas'] == 0 && $tb_berkas_tambahan['catatan_berkas'] =='') {
                                                                                        $warna5 = "danger";
                                                                                        $f = "Belum Lengkap" ;
                                                                                    } ?> 
                                                    
                                                                                <td class="text-center"><span class="badge badge-<?= $warna5; ?>">
                                                                                                        <?php echo $f; ?></span>  
                                                                                                        <br><br>
                                                                                    <?php if($tb_berkas_tambahan['validasi_berkas'] == 0 && $tb_berkas_tambahan['catatan_berkas'] != '') {?>
                                                                                        <p>Verifikasi Ditolak, Dengan Catatan <?= $tb_berkas_tambahan['catatan_berkas'] ?></p>
                                                                                    <?php } if($tb_berkas_tambahan['validasi_berkas'] == 1 && $tb_berkas_tambahan['catatan_berkas'] != '') {?>
                                                                                        <p>Menunggu Diverifikasi Ulang</p>
                                                                                    <?php } if($tb_berkas_tambahan['validasi_berkas'] == 1 && $tb_berkas_tambahan['catatan_berkas'] == '') {?>
                                                                                        <p>Verifikasi Diterima</p>
                                                                                    <?php } if($tb_berkas_tambahan['validasi_berkas'] == 0 && $tb_berkas_tambahan['catatan_berkas'] =='' ) { ?>
                                                                                        <p>Belum Diverifikasi</p>
                                                                                    <?php } ?>
                                                                                </td>  

                                                                        <?php } ?>
                                                    
                
                                                                <?php } else if($pengguna_berkas_fak1 && $pengguna_berkas_fak1['kode_prodi'] == ''  && $pengguna_berkas_fak1['is_active'] == 1  ) { ?> 
									

                                                                   <?php if($tb_berkas_tambahan) { ?>
                                                                    <?php
                                                                        if($tb_berkas_tambahan['validasi_berkas'] == 0 && $tb_berkas_tambahan['catatan_berkas'] != '') {
                                                                                                        $warna6 = "danger";
                                                                                                        $zz = "Belum Lengkap" ;
                                                                
                                                                        }else if($tb_berkas_tambahan['validasi_berkas'] == 1 && $tb_berkas_tambahan['catatan_berkas'] != '') {
                                                                            $warna6 = "danger";
                                                                            $zz = "Belum Lengkap" ;
                                                                        }else if($tb_berkas_tambahan['validasi_berkas'] == 1 && $tb_berkas_tambahan['catatan_berkas'] == '') {
                                                                            $warna6 = "success";
                                                                            $zz = "Lengkap" ;
                                                                        }else if($tb_berkas_tambahan['validasi_berkas'] == 0 && $tb_berkas_tambahan['catatan_berkas'] =='') {
                                                                            $warna6 = "danger";
                                                                            $zz = "Belum Lengkap" ;
                                                                        } ?>
 
                                                                            <td class="text-center"><span class="badge badge-<?= $warna6; ?>">
                                                                                                    <?php echo $zz; ?></span>  
                                                                                                    <br><br>
                                                                                <?php if($tb_berkas_tambahan['validasi_berkas'] == 0 && $tb_berkas_tambahan['catatan_berkas'] != '') {?>
                                                                                    <p>Verifikasi Ditolak, Dengan Catatan <?= $tb_berkas_tambahan['catatan_berkas'] ?></p>
                                                                                <?php } if($tb_berkas_tambahan['validasi_berkas'] == 1 && $tb_berkas_tambahan['catatan_berkas'] != '') {?>
                                                                                    <p>Menunggu Diverifikasi Ulang</p>
                                                                                <?php } if($tb_berkas_tambahan['validasi_berkas'] == 1 && $tb_berkas_tambahan['catatan_berkas'] == '') {?>
                                                                                    <p>Verifikasi Diterima</p>
                                                                                <?php } if($tb_berkas_tambahan['validasi_berkas'] == 0 && $tb_berkas_tambahan['catatan_berkas'] =='' ) { ?>
                                                                                    <p>Belum Diverifikasi</p>
                                                                                <?php } ?>
                                                                            </td>  
                                                                    
                                                                    <?php } ?>

                                                            <?php } ?>

                                                            
                                                            <?php if($data['validasi_peminjaman_unit'] == '0') {
                                                                $warna4 = "danger";
                                                                $e = "Belum Lengkap" ;
                                                            } else {
                                                                $warna4 = "success";
                                                                $e = "Lengkap" ;
                                                            } ?>


                                                            <td class="text-center"><span class="badge badge-<?= $warna4; ?>">
                                                                                 <?php echo $e; ?></span>  
                                                                <br><br>
                                                                 <?php if( $data['validasi_peminjaman_unit'] == '0'  &&  $data['catatan_unit'] != '' ) { ?>
                                                                        <p>Verifikasi Ditolak, Dengan Catatan <?= $data['catatan_unit'] ?></p>
                                                                    <?php } if($data['validasi_peminjaman_unit'] == '1' && $data['catatan_unit'] == '') {?>
                                                                        <p>Verifikasi Diterima</p>
                                                                    <?php } if($data['validasi_peminjaman_unit'] == '0' && $data['catatan_unit'] == '') {?>
                                                                        <p>Data Belum Diverifikasi</p>
                                                                <?php }  ?> 

                                                            </td>

                                                            <?php if(session()->get('id_role') != '2'){?>
                                                                <?php if($data['validasi_peminjaman_pusat'] == '0') {
                                                                    $warna4 = "danger";
                                                                    $e = "Belum Lengkap" ;
                                                                    } else {
                                                                        $warna4 = "success";
                                                                        $e = "Lengkap" ;
                                                                    } ?>

                                                                    <td class="text-center"><span class="badge badge-<?= $warna4; ?>">
                                                                                        <?php echo $e; ?></span> 
                                                                        <br><br>
                                                                        
                                                                        <?php if( $data['validasi_peminjaman_pusat'] == '0'  &&  $data['catatan_pusat'] != '' ) { ?>
                                                                                <p>Verifikasi Ditolak, Dengan Catatan <?= $data['catatan_pusat'] ?></p>
                                                                            <?php } if($data['validasi_peminjaman_pusat'] == '1' && $data['catatan_pusat'] == '') {?>
                                                                                <p>Verifikasi Diterima</p>
                                                                            <?php } if($data['validasi_peminjaman_pusat'] == '0' && $data['catatan_pusat'] == '') {?>
                                                                                <p>Data Belum Diverifikasi</p>
                                                                        <?php }  ?> 
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
                        
                       
                            <a href="/Backend/Data_mhs/detail_prodi_mhs/<?= $data['kode_prodi'] ?>" type="button" class="btn btn-warning float-left">Kembali</a>
                       
                        
            </div>
          </div>
        </div>





<?= $this->endSection(); ?>