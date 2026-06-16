        <?php
            include_once 'config/base.php';
            require_once 'config/db.php';
        ?>
        
        <?php
        include_once 'config/base.php';
        ?>

        <!-- Start Header Area -->
            <?php include_once 'views/layouts/header.php'; ?>
        <!-- End Header Area -->

        <!-- Start Preloader Area -->
            <?php //include_once 'views/layouts/preloader.php'; ?>
        <!-- End Preloader Area -->

        <!-- Start Sidebar Area -->
            <?php include_once 'views/layouts/sidebar.php'; ?>
        <!-- End Sidebar Area -->

        <!-- Start Main Content Area -->
            <?php include_once 'route.php'; ?>
        <!-- Start Main Content Area -->

        <!-- Start Footer Area -->
        <?php include_once 'views/layouts/footer.php'?>
        <!-- End Footer Area -->