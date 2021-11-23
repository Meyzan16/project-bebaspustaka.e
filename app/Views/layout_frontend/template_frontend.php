<html lang="en">

    <head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title><?= $title;  ?></title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="<?= base_url() ?>/unib.png" rel="icon">
    <link href="<?= base_url() ?>/template_frontend/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Raleway:300,400,500,700,800" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="<?= base_url() ?>/template_frontend/assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="<?= base_url() ?>/template_frontend/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>/template_frontend/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="<?= base_url() ?>/template_frontend/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>/template_frontend/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/particlesjs/2.2.2/particles.min.js" rel="stylesheet"> -->

    <!-- Template Main CSS File -->
    <link href="<?= base_url() ?>/template_frontend/assets/css/style.css" rel="stylesheet">

    </head>

<!-- tutup head -->

    <!-- header -->
    <body>

    <!-- ======= Header ======= -->
    <header id="header" class="d-flex align-items-center ">
        <div class="container-fluid container-xxl d-flex align-items-center">

        <div id="logo" class="me-auto">
            <!-- Uncomment below if you prefer to use a text logo -->
            <!-- <h1><a href="index.html">The<span>Event</span></a></h1>-->
            <a href="" class="scrollto"><img src="assets/img/logo.png" alt="" title=""></a>
        </div>

        <nav id="navbar" class="navbar order-last order-lg-0">
            <ul>
            <li><a class="nav-link scrollto" href="/Home">Home</a></li>
            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
        </nav>
  
        </div>
    </header><!-- End Header -->
    <!-- tutup header -->

    <?= $this->renderSection('content'); ?>


    <!-- ======= Footer ======= -->
    <footer id="footer">

        <div class="container">
            <div class="copyright">
                &copy; Copyright <strong>UNIVERSITAS BENGKULU</strong>. All Rights Reserved
            </div>
        <div class="credits">
           
            <!-- Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a> -->
        </div>
        </div>
    </footer><!-- End  Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="<?= base_url() ?>/template_frontend/assets/vendor/aos/aos.js"></script>
    <script src="<?= base_url() ?>/template_frontend/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url() ?>/template_frontend/assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="<?= base_url() ?>/template_frontend/assets/vendor/php-email-form/validate.js"></script>
    <script src="<?= base_url() ?>/template_frontend/assets/vendor/swiper/swiper-bundle.min.js"></script>

    <!-- Template Main JS File -->
    <script src="<?= base_url() ?>/template_frontend/assets/js/main.js"></script>
      
   <!-- <script src="path/to/particles.min.js"></script> -->

    </body>

</html>