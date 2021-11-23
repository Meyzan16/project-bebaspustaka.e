<?= $this->extend('layout_backend/template'); ?>

<?= $this->section('content'); ?>
<!-- page content -->
                 
<div class="right_col" role="main">
          <div class="">
            <div class="page-title">        
              <div class="title_left">

                   
              </div> 
        <div class="clearfix"></div>
            <div class="autohide">
                <?php echo session()->get('massage'); ?>
            </div>

    

            </div>
          </div>
        </div>
        <!-- /page content -->

        
<?= $this->endSection(); ?>