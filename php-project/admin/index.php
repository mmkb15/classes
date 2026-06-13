<?php
include_once 'config/base.php';
require_once 'config/db.php';
?>


<!-- header -->
<?php include_once 'views/layouts/head.php'; ?>
<!-- /.header -->

<!-- wrapper -->
<div class="wrapper">

  <!-- Preloader -->
  <!-- <?php //include_once 'views/layouts/preloader.php'; ?> -->

  <!-- Navbar -->
  <?php include_once 'views/layouts/nav.php'; ?>
  <!-- /.navbar -->

  <!-- aside -->
  <?php include_once 'views/layouts/aside.php'; ?>
  <!-- /.aside -->


  <!-- Page Content -->
  <?php include_once 'route.php'; ?>
  <!-- /.Page Content -->

  <!-- footer -->
  <?php include_once 'views/layouts/footer.php'; ?>
  <!-- /.footer -->


  <!-- Control Sidebar -->
  <?php include_once 'views/layouts/control-sidebar.php'; ?>
  <!-- /.control-sidebar -->
   
</div>
<!-- ./wrapper -->


<!-- foot -->
<?php include_once 'views/layouts/foot.php'; ?>
<!-- /.foot -->