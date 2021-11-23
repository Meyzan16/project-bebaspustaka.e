<?=  $this->extend('layout_frontend/template_frontend'); ?>
<?php foreach ($homepage as $data) {
  
} ?>


<?= $this->section('content'); ?>
<!-- ======= Hero Section ======= -->
  <section id="hero">
    <div class="hero-container" data-aos="zoom-in" data-aos-delay="100">
      <h1 class="mb-1 mt-2 ">SISTEM INFORMASI <span> BEBAS PUSTAKA </span></h1>
      <?php if($data['is_active'] != 'Tidak Aktif') {?>
        <p class="mb-2"><?= $data['isi'] ?>
      <?php } ?>

      <?php 
       $konversi = strtotime($data['tanggal_mulai']);
       $konversi1 = strtotime($data['tanggal_selesai']);
       $skrang = date('d M Y', $konversi );
       $skrang1 = date('d M Y', $konversi1 );

      if($data['is_active'] != 'Tidak Aktif') { ?>
        <p class="mb-2" style="margin-buttom: 2px; color: #ffffff;">Dibuka Dari Tanggal <?= $skrang ?> Sampai Tanggal <?= $skrang1 ?></p>    
      <?php } else {?>
        <p class="mt-2" > Belum Waktunya Pendaftaran</p>
      <?php } ?>
      
      <?php if($data['is_active'] != 'Tidak Aktif') { ?>    
          <form action="/Auth" method="post">
            <button type="submit" name="login"  class="about-btn scrollto">LOGIN</button>
          </form>
      <?php } ?>

    </div>
  </section><!-- End Hero Section -->


<?= $this->endSection(); ?>