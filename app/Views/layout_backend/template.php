<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	  <link rel="icon" href="<?= base_url() ?>/unib.png"  />

    <title> BEBAS PUSTAKA </title>

	<link href="<?= base_url() ?>/unib.png" rel="icon">
    <link href="<?= base_url() ?>/template_backend/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>/template_backend/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>/template_backend/vendors/nprogress/nprogress.css" rel="stylesheet">
    <link href="<?= base_url() ?>/template_backend/vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <link href="<?= base_url() ?>/template_backend/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>/template_backend/vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
    <link href="<?= base_url() ?>/template_backend/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
    
    <!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.10.25/datatables.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css"/> -->
    <script src="<?= base_url()?>/ckeditor/samples/js/sample.js"></script>
    <script src="https://cdn.ckeditor.com/4.13.0/standard/ckeditor.js"></script>

    <link href="<?= base_url() ?>/template_backend/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>/template_backend/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>/template_backend/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>/template_backend/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>/template_backend/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
    
    <link href="<?= base_url() ?>/template_backend/build/css/custom.min.css" rel="stylesheet">

    <script src="<?= base_url() ?>/chainedJs/jquery.min.js"></script>  

  </head>

  <!-- body -->
  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col menu_fixed">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <p  style="text-align:center;" class="site_title"> <span>Bebas Pustaka</span></p>
            </div>
            <div class="clearfix"></div>

            <div class="profile clearfix">
              <div class="" style="text-align:center;">
                <p style="color: white">Selamat Datang</p>
                <h6 style="color: white"><?= session()->get('nama_user'); ?></h6>
              </div>
            </div>
            
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <ul class="nav side-menu">
                  <li><a href="/Backend/Home"><i class="fa fa-home"></i> Home </a></li>

                   

                  <?php if(session()->get('id_role') == '2') { ?>
                    <li><a href="/Backend/Data_mhs"><i class="fa fa-edit"></i> Verifikasi Data Unit </a></li>
                    <li><a href="/Backend/Verifikator/ubah_pass" ><i class="fa fa-edit"></i> Profil Verifikator </a></li>
                  <?php } else { ?>
                    <li><a href="/Backend/Data_mhs"><i class="fa fa-edit"></i> Verifikasi Data Pusat </a></li>

                    <li><a><i class="fa fa-home"></i> Berkas Tambahan <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                          <li><a href="/Backend/Berkas_tambahan/create_berkas"><i class="fa fa-edit"></i> Jenis Berkas </a></li>
                          <li><a href="/Backend/Berkas_tambahan"><i class="fa fa-edit"></i> Pengguna Berkas </a></li>
                  
                        </ul>
                    </li>
                    <li><a><i class="fa fa-home"></i> Pengaturan <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                           <li><a href="/Backend/Verifikator"><i class="fa fa-edit"></i> Verifikator </a></li>
                          <li><a href="/Backend/Halaman_utama"><i class="fa fa-edit"></i> Halaman Utama </a></li>
                  
                        </ul>
                    </li>
                  
                    
                 
                  <?php } ?>

                  
                  <li><a href="/Rumahku/logout" ><i class="fa fa-sign-out"></i> Logout </a></li>     
                </ul>
              </div>
            </div>


            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="login.html">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>

          </div>
        </div>

        <div class="top_nav">
            <div class="nav_menu">
                <div class="nav toggle">
                  <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                </div>
                <nav class="nav navbar-nav">
                <ul class=" navbar-right">
                  <li class="nav-item dropdown open" style="padding-left: 15px;">
                    <h5 class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                       <?= session()->get('nama_fakultas');  ?>
                    </h5>
                    <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                      <form action="/Rumahku/logout" method="post">
                        <button class="dropdown-item"  name="logout" ><i class="fa fa-sign-out pull-right"></i> Log Out</button>
                      </form>
                    </div>
                  </li>
  
                 
                </ul>
              </nav>
            </div>
        </div>

        <?= $this->renderSection('content'); ?>



  
       <footer>
          <div class="pull-right">
             Copyright Perpustkaan UNIVERSITAS BENGKULU 
          </div>
          <div class="clearfix"></div>
        </footer>

      </div>
    </div>

    <script src="<?= base_url(); ?>/chainedJs/jquery-1.10.2.min.js"></script>

    <script src="<?= base_url() ?>/template_backend/vendors/jquery/dist/jquery.min.js"></script>
    <script src="<?= base_url() ?>/template_backend/vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url() ?>/template_backend/vendors/fastclick/lib/fastclick.js"></script>
    <script src="<?= base_url() ?>/template_backend/vendors/nprogress/nprogress.js"></script>
    <script src="<?= base_url() ?>/template_backend/vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="<?= base_url() ?>/template_backend/build/js/custom.min.js"></script>
    <!-- <script type="text/javascript" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script> -->

    <script src="<?= base_url() ?>/template_backend/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="<?= base_url() ?>/template_backend/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="<?= base_url() ?>/template_backend/vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="<?= base_url() ?>/template_backend/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
    <script src="<?= base_url() ?>/template_backend/vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="<?= base_url() ?>/template_backend/vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="<?= base_url() ?>/template_backend/vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="<?= base_url() ?>/template_backend/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="<?= base_url() ?>/template_backend/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="<?= base_url() ?>/template_backend/vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="<?= base_url() ?>/template_backend/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script src="<?= base_url() ?>/template_backend/vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>

    <script>
        

     window.setTimeout(function() {
          $(".autohide").fadeTo(200, 0).slideUp(500, function() {
              $(this).remove();
          });
      }, 4000);
  </script>

<script>
     CKEDITOR.replace( 'editor' );
     CKEDITOR.replace( 'editor1' );
</script>

<script src="<?= base_url(); ?>/chainedJs/jquery.chained.min.js"></script>
<script>

    $("#prodi").chained("#fakultas");
</script>
  
  </body>
</html>

  <!-- akhir footer -->