<?php 
include_once 'config/base.php';
include_once 'config/db.php';
?>
<?php include_once('views/layouts/head.php'); ?>
<div class="wrapper">

  <!-- Preloader -->
  <?php //include_once('views/layouts/preloader.php'); ?>

  <?php include('views/layouts/nav.php'); ?>
  <?php include('views/layouts/aside.php'); ?>

  <!-- Page content -->
  <?php include('route.php'); ?>
  <!-- /.Page content -->
   
  <?php include_once('views/layouts/footer.php'); ?>
</div>

<?php include_once('views/layouts/foot.php'); ?>
