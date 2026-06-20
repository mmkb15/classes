<?php
// সব admin page এর শুরুতে এটা include করো
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: ' . BASE_URL . 'index.php');
    exit;
}
?>
