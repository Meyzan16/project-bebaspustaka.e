<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title><?= $title; ?></title>

  <link rel="stylesheet" href="<?=base_url(); ?>/Template_mhs/template/vendors/feather/feather.css">
  <link rel="stylesheet" href="<?=base_url(); ?>/Template_mhs/template/vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="<?=base_url(); ?>/Template_mhs/template/vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="<?=base_url(); ?>/Template_mhs/template/vendors/select2/select2.min.css">
  <link rel="stylesheet" href="<?=base_url(); ?>/Template_mhs/template/vendors/select2-bootstrap-theme/select2-bootstrap.min.css">
  <link rel="stylesheet" href="<?=base_url(); ?>/Template_mhs/template/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
  <link rel="stylesheet" href="<?=base_url(); ?>/Template_mhs/template/vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" type="text/css" href="<?=base_url(); ?>/Template_mhs/template/js/select.dataTables.min.css">
  <link rel="stylesheet" href="<?=base_url(); ?>/Template_mhs/template/css/vertical-layout-light/style.css">
  <link rel="stylesheet" href="<?=base_url(); ?>/Template_mhs/template/css/vertical-layout-light/style.css">
  <link href="<?= base_url() ?>/unib.png" rel="icon">
	<script src="<?= base_url()?>/ckeditor/samples/js/sample.js"></script>

  <script src="https://cdn.ckeditor.com/4.13.0/standard/ckeditor.js"></script>
  
</head>


<body>
  <div class="container-scroller">
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo mr-5" href="index.html"><img src="<?= base_url(); ?>/unib.png" class="mr-2" alt="logo"/></a>
        <a class="navbar-brand brand-logo-mini" href="index.html"><img src="<?= base_url(); ?>/unib.png" alt="logo"/></a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
                <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                <span class="icon-menu"></span>
                </button>
                <ul class="navbar-nav navbar-nav-right">
                
                    <li class="nav-item nav-profile dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
                        <img src="<?= base_url(); ?>/unib.png" alt="profile"/> 
                        </a>
                        <h4 class="nav-link dropdown-toggle" ><?= session()->get('nama'); ?></h4>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                        <a href="/Auth/logout"  class="dropdown-item">
                            <i class="ti-power-off text-primary"></i>
                            Logout
                        </a>
                        </div>
                    </li>
                </ul>
                    <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
                    <span class="icon-menu"></span>
                    </button>
      </div>
    </nav>

 <div class="container-fluid page-body-wrapper">  
  
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="/Profil">
              <i class="icon-head menu-icon"></i>
              <span class="menu-title">Profil</span>
            </a>
          </li>
          
          <li class="nav-item">
            <a class="nav-link" href="/Dashboard_mhs">
              <i class="icon-paper menu-icon"></i>
              <span class="menu-title">Bebas Pustaka</span>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="/Auth/logout">
              <i class="ti-power-off menu-icon"></i>
              <span class="menu-title">Logout</span>
            </a>
          </li>

        </ul>
      </nav>


<?= $this->renderSection('content'); ?>

<footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright FKIP UNIB © 2021.</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"> <a href="https://www.instagram.com/adzanmagrib.e/" target="_blank"> adzanmagrib.e </a>  </span>
          </div>
        </footer>
      </div>
    </div>
  </div>
  <script src="<?=base_url(); ?>/Template_mhs/template/vendors/js/vendor.bundle.base.js"></script>
  <script src="<?=base_url(); ?>/Template_mhs/template/vendors/typeahead.js/typeahead.bundle.min.js"></script>
  <script src="<?=base_url(); ?>/Template_mhs/template/vendors/select2/select2.min.js"></script>
  <script src="<?=base_url(); ?>/Template_mhs/template/js/off-canvas.js"></script>
  <script src="<?=base_url(); ?>/Template_mhs/template/js/hoverable-collapse.js"></script>
  <script src="<?=base_url(); ?>/Template_mhs/template/js/template.js"></script>
  <script src="<?=base_url(); ?>/Template_mhs/template/js/settings.js"></script>
  <script src="<?=base_url(); ?>/Template_mhs/template/js/todolist.js"></script>
  <script src="<?=base_url(); ?>/Template_mhs/template/js/file-upload.js"></script>
  <script src="<?=base_url(); ?>/Template_mhs/template/js/typeahead.js"></script>
  <script src="<?=base_url(); ?>/Template_mhs/template/js/select2.js"></script>

  <script>
     window.setTimeout(function() {
          $(".autohide").fadeTo(500, 0).slideUp(500, function() {
              $(this).remove();
          });
      }, 4000);

      initSample();
</script>

<script>
     CKEDITOR.replace( 'editor' );
     CKEDITOR.replace( 'editor1' );
</script>
  

</body>

</html>