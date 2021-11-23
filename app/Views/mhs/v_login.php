<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Login</title>
  <link rel="stylesheet" href="<?=base_url(); ?>/Template_mhs/template/vendors/feather/feather.css">
  <link rel="stylesheet" href="<?=base_url(); ?>/Template_mhs/template/vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="<?=base_url(); ?>/Template_mhs/template/vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="<?=base_url(); ?>/Template_mhs/template/css/vertical-layout-light/style.css">
  <link href="<?= base_url() ?>/unib.png" rel="icon">
</head>


<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-3 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <div class="brand-logo" style="">
                <img src="<?=base_url(); ?>/unib.png" alt="logo">
              </div>
              <h4 class="text-center" >Silahkan Login</h4>
            
              <div class="autohide">
                  <?php echo  session()->getflashdata('massage') ?>
              </div>

              <form action="/Auth/cek_login" class="pt-4" method="POST"  >
              
                    <div class="form-group">
                       <input type="text" class="form-control" placeholder="Username" name="username" onkeyup="upper()" id="username" autofocus required>
                    </div>

                    <div class="form-group">
                      <input type="password" class="form-control" placeholder="Password" name="password" autofocus required>
                    </div>

                    <div class="mt-3">
                      <button type="submit" name="cek_login" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" >LOGIN</button>
                    </div>
                
                
              </form>
              <a href="/Home">Kembali Ke Halaman Utama</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="<?=base_url(); ?>/Template_mhs/template/vendors/js/vendor.bundle.base.js"></script>
  <script src="<?=base_url(); ?>/Template_mhs/template/js/off-canvas.js"></script>
  <script src="<?=base_url(); ?>/Template_mhs/template/js/hoverable-collapse.js"></script>
  <script src="<?=base_url(); ?>/Template_mhs/template/js/template.js"></script>
  <script src="<?=base_url(); ?>/Template_mhs/template/js/settings.js"></script>
  <script src="<?=base_url(); ?>/Template_mhs/template/js/todolist.js"></script>

  <script>
      window.setTimeout(function() {
          $(".autohide").fadeTo(500, 0).slideUp(500, function() {
              $(this).remove();
          });
      }, 4000);
  </script>	

  <script>
          function upper() {
              const word = document.getElementById('username');
              word.value = word.value.toUpperCase();
          }
  </script>


</body>
</html>
