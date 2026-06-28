<?php
include_once 'config/base.php';
require_once 'config/db.php';

// =============================================
// CHECK IF PRINT PAGE
// =============================================
$is_print_page = false;
if(isset($_GET['page'])){
    $page = $_GET['page'];
    if($page == 'prescriptions/print' || $page == 'billings/print'){
        $is_print_page = true;
    }
}
?>

<?php if(!$is_print_page): ?>
    <!-- Start Header Area -->
    <?php include_once 'views/layouts/header.php'; ?>
    <!-- End Header Area -->

    <!-- Start Sidebar Area -->
    <?php include_once 'views/layouts/sidebar.php'; ?>
    <!-- End Sidebar Area -->
<?php endif; ?>

<!-- Start Main Content Area -->
<?php include_once 'route.php'; ?>
<!-- End Main Content Area -->

<?php if(!$is_print_page): ?>
    <!-- Start Footer Area -->
    <?php include_once 'views/layouts/footer.php'; ?>
    <!-- End Footer Area -->
<?php endif; ?>
        
        
        
        
        
        
        
        <?php
            // include_once 'config/base.php';
            // require_once 'config/db.php';
        ?>

        <!-- Start Header Area -->
            <?php //include_once 'views/layouts/header.php'; ?>
        <!-- End Header Area -->

        <!-- Start Sidebar Area -->
            <?php //include_once 'views/layouts/sidebar.php'; ?>
        <!-- End Sidebar Area -->

        <!-- Start Main Content Area -->
            <?php //include_once 'route.php'; ?>
        <!-- Start Main Content Area -->

        <!-- Start Footer Area -->
        <?php //include_once 'views/layouts/footer.php' ?>
        <!-- End Footer Area -->

        