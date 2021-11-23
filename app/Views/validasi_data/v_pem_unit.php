<?= $this->extend('layout_backend/template'); ?>

<?= $this->section('content'); ?>
<?php $this->db = db_connect(); ?>
<?php foreach($data_mhs as $data) {?>
<?php } ?>


<div class="right_col" role="main">
        <div class="">
            <div class="page-title">        
              <div class="title_left">
                   <h3>VALIDASI DATA PEMINJAMAN UNIT</h3>
                   
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
                                                            <th class="text-center">Verifikasi Peminjaman Unit</th>           
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                    

                                                    <?php $i=1;
                                                    foreach($data_mhs as $data) :  ?>
                                                        <tr>
                                                            <td class="text-center"><?= $i++ ?></td>

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
                                                        
                                                        $tb_berkas_tambahan = $this->db->query("SELECT * FROM tb_berkas_tambahan WHERE npm = '$npm'")->getRowArray();                      
                                                    ?>


                                                <?php
                                                       
                                                    $npm = $data['npm'];
                                                    $query = $this->db->query("SELECT * FROM tb_berkas_wajib WHERE npm='$npm' ")->getRow();
                                                    
                                                                                       
                                                    if($pengguna_berkas_fak && $pengguna_berkas_fak['kode_prodi'] == $kode_prodi  && $pengguna_berkas_fak['is_active'] == 1 ){  ?>     
                                                            <?php if($tb_berkas_tambahan) { ?>
                                                                <?php if($query->jenis_TA == 'LTA' || $query->jenis_TA == 'SKRIPSI') { ?>
                                                                        <?php if($query->validasi_TA == '1' && $query->hard_TA == '1' && $tb_berkas_tambahan['validasi_berkas'] == '1' && $query->validasi_jurnal == '1') { ?>
                                                                        <td class="text-center">               
                                                                                <form action="<?php echo base_url('Backend/Validasi_unit/lengkap_unit/'.$data['npm']); ?>" method="post"> 
                                                                                        <button type="submit" class="btn btn-xs btn-info _btn" data-toggle="tooltip"  title="Lengkap" >
                                                                                            <i class="fa fa-fw  fa-check"></i>                                                                          
                                                                                        </button> 
                                                                                    </form>
                                                                                
                                                                                    <button  class="btn btn-xs btn-danger _btn" title="Belum Lengkap" data-toggle="modal" data-target="#block<?= $data['npm'] ?>">
                                                                                        <i class="fa fa-fw fa-ban"></i>                             
                                                                                    </button>
            
                                                                        </td>
                                                                        <?php  } else{ ?>
                                                                            <td class="text-center">
                                                                                <p>  Masih ada <span class="text-danger">berkas tambahan</span> yang belum divalidasi</p>
                                                                            </td>
                                                                        <?php } ?>
                                                                <?php } elseif($query->jenis_TA == 'TESIS' || $query->jenis_TA == 'DISERTASI') { ?>
                                                                        <?php if($query->validasi_TA == '1' && $query->hard_TA == '1' && $tb_berkas_tambahan['validasi_berkas'] == '1' && $query->validasi_jurnal == '1' && $query->validasi_sumbangan == '1'){?>
                                                                            <td class="text-center">               
                                                                                    <form action="<?php echo base_url('Backend/Validasi_unit/lengkap_unit/'.$data['npm']); ?>" method="post"> 
                                                                                            <button type="submit" class="btn btn-xs btn-info _btn" data-toggle="tooltip"  title="Lengkap" >
                                                                                                <i class="fa fa-fw  fa-check"></i>                                                                          
                                                                                            </button> 
                                                                                        </form>
                                                                                    
                                                                                        <button  class="btn btn-xs btn-danger _btn" title="Belum Lengkap" data-toggle="modal" data-target="#block<?= $data['npm'] ?>">
                                                                                            <i class="fa fa-fw fa-ban"></i>                             
                                                                                        </button>
                                                                            </td>
                                                                        <?php } else { ?>
                                                                            <td class="text-center">
                                                                            <p>  Masih ada <span class="text-danger">berkas tambahan</span> yang belum divalidasi</p>
                                                                        </td>
                                                                        <?php } ?>
                                                                <?php } ?>
                                                            <?php }else{ ?>
                                                                <td class="text-center">
                                                                        Masih ada <span class="text-danger">berkas tambahan</span> yang belum divalidasi
                                                                </td>
                                                            <?php } ?>     

                                                    <?php } else if($pengguna_berkas_fak1 && $pengguna_berkas_fak1['kode_prodi'] == ''  && $pengguna_berkas_fak1['is_active'] == 1  ) { ?>
                                                            <?php if($tb_berkas_tambahan) { ?>
                                                                <?php if($query->jenis_TA == 'LTA' || $query->jenis_TA == 'SKRIPSI') { ?>
                                                                        <?php if($query->validasi_TA == '1' && $query->hard_TA == '1' && $tb_berkas_tambahan['validasi_berkas'] == '1' && $query->validasi_jurnal == '1') { ?>
                                                                        <td class="text-center">               
                                                                                <form action="<?php echo base_url('Backend/Validasi_unit/lengkap_unit/'.$data['npm']); ?>" method="post"> 
                                                                                        <button type="submit" class="btn btn-xs btn-info _btn" data-toggle="tooltip"  title="Lengkap" >
                                                                                            <i class="fa fa-fw  fa-check"></i>                                                                          
                                                                                        </button> 
                                                                                    </form>
                                                                                
                                                                                    <button  class="btn btn-xs btn-danger _btn" title="Belum Lengkap" data-toggle="modal" data-target="#block<?= $data['npm'] ?>">
                                                                                        <i class="fa fa-fw fa-ban"></i>                             
                                                                                    </button>
            
                                                                        </td>
                                                                        <?php  } else{ ?>
                                                                            <td class="text-center">
                                                                                <p class="text-danger">Masih ada berkas yang belum divalidasi</p>
                                                                            </td>
                                                                        <?php } ?>
                                                                <?php } elseif($query->jenis_TA == 'TESIS' || $query->jenis_TA == 'DISERTASI') { ?>
                                                                        <?php if($query->validasi_TA == '1' && $query->hard_TA == '1' && $tb_berkas_tambahan['validasi_berkas'] == '1' && $query->validasi_jurnal == '1' && $query->validasi_sumbangan == '1'){?>
                                                                            <td class="text-center">               
                                                                                    <form action="<?php echo base_url('Backend/Validasi_unit/lengkap_unit/'.$data['npm']); ?>" method="post"> 
                                                                                            <button type="submit" class="btn btn-xs btn-info _btn" data-toggle="tooltip"  title="Lengkap" >
                                                                                                <i class="fa fa-fw  fa-check"></i>                                                                          
                                                                                            </button> 
                                                                                        </form>
                                                                                    
                                                                                        <button  class="btn btn-xs btn-danger _btn" title="Belum Lengkap" data-toggle="modal" data-target="#block<?= $data['npm'] ?>">
                                                                                            <i class="fa fa-fw fa-ban"></i>                             
                                                                                        </button>
                                                                            </td>
                                                                        <?php } else { ?>
                                                                            <td class="text-center">
                                                                            <p class="text-danger">Masih ada berkas yang belum divalidasi</p>
                                                                        </td>
                                                                        <?php } ?>
                                                                <?php } ?>
                                                            <?php }else{ ?>
                                                                <td class="text-center">
                                                                        Masih ada <span class="text-danger">berkas tambahan</span> yang belum divalidasi
                                                                </td>
                                                            <?php } ?> 

                                                    <?php }else{ ?>

                                                        <?php if($query->jenis_TA == 'LTA' || $query->jenis_TA == 'SKRIPSI') { ?>
                                                            <?php if($query->validasi_TA == '1' && $query->hard_TA == '1' && $query->validasi_jurnal == '1') { ?>
                                                                <td class="text-center">               
                                                                        <form action="<?php echo base_url('Backend/Validasi_unit/lengkap_unit/'.$data['npm']); ?>" method="post"> 
                                                                                <button type="submit" class="btn btn-xs btn-info _btn" data-toggle="tooltip"  title="Lengkap" >
                                                                                    <i class="fa fa-fw  fa-check"></i>                                                                          
                                                                                </button> 
                                                                            </form>
                                                                           
                                                                            <button  class="btn btn-xs btn-danger _btn" title="Belum Lengkap" data-toggle="modal" data-target="#block<?= $data['npm'] ?>">
                                                                                <i class="fa fa-fw fa-ban"></i>                             
                                                                            </button>
    
                                                                </td>
                                                            <?php  } else{ ?>
                                                                <td class="text-center">
                                                                    <p class="text-danger">Masih ada berkas yang belum divalidasi</p>
                                                                </td>
                                                           <?php } ?>
                                                        <?php } elseif($query->jenis_TA == 'TESIS' || $query->jenis_TA == 'DISERTASI') { ?>
                                                            <?php if($query->validasi_TA == '1' && $query->hard_TA == '1' && $query->validasi_jurnal == '1' && $query->validasi_sumbangan == '1'){?>
                                                                <td class="text-center">               
                                                                        <form action="<?php echo base_url('Backend/Validasi_unit/lengkap_unit/'.$data['npm']); ?>" method="post"> 
                                                                                <button type="submit" class="btn btn-xs btn-info _btn" data-toggle="tooltip"  title="Lengkap" >
                                                                                    <i class="fa fa-fw  fa-check"></i>                                                                          
                                                                                </button> 
                                                                            </form>
                                                                           
                                                                            <button  class="btn btn-xs btn-danger _btn" title="Belum Lengkap" data-toggle="modal" data-target="#block<?= $data['npm'] ?>">
                                                                                <i class="fa fa-fw fa-ban"></i>                             
                                                                            </button>
                                                                </td>
                                                            <?php } else { ?>
                                                                <td class="text-center">
                                                                   <p class="text-danger">Masih ada berkas yang belum divalidasi</p>
                                                               </td>
                                                            <?php } ?>
                                                         <?php } ?>

                                                    <?php }  ?>

                                                            
                                                     

                                                         

                                                            
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
                                            <form action="<?= base_url('Backend/Validasi_unit/belum_lengkap_unit'); ?>" method="post" >
                                                <?= csrf_field(); ?>
                                                    <input type="hidden" name="npm" value="<?= $data['npm']; ?>">

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