<?php
session_start();

include_once 'config/base.php';
require_once 'config/db.php';
require_once 'models/user.class.php';
require_once 'config/auth.php';

// =============================================
// HANDLE LOGOUT FIRST (Before any output)
// =============================================
if (isset($_GET['page']) && $_GET['page'] == 'logout') {
    User::logout();
    header('Location: login');
    exit;
}

// =============================================
// GET CURRENT PAGE
// =============================================
$current_page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';

// =============================================
// REDIRECT LOGIC (BEFORE HEADER/SIDEBAR)
// =============================================
$public_pages = ['login', 'register'];

if (!in_array($current_page, $public_pages) && !User::isLoggedIn()) {
    header('Location: login');
    exit;
}

if (in_array($current_page, $public_pages) && User::isLoggedIn()) {
    header('Location: dashboard');
    exit;
}

// =============================================
// CHECK IF PRINT PAGE
// =============================================
$is_print_page = false;
$is_auth_page = in_array($current_page, $public_pages);

if (isset($_GET['page'])) {
    $page = $_GET['page'];
    if ($page == 'prescriptions/print' || $page == 'billings/print') {
        $is_print_page = true;
    }
}

// =============================================
// SHOW HEADER, SIDEBAR, FOOTER ONLY IF NOT AUTH PAGE
// =============================================
if (!$is_print_page && !$is_auth_page): ?>
    <?php include_once 'views/layouts/header.php'; ?>
    <?php include_once 'views/layouts/sidebar.php'; ?>
<?php endif; ?>

<?php include_once 'route.php'; ?>

<?php if (!$is_print_page && !$is_auth_page): ?>
    <?php include_once 'views/layouts/footer.php'; ?>
<?php endif; ?>