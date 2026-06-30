<?php
/**
 * Authentication & Role Check Helper Functions
 */

// Check if user is logged in and has allowed role
function checkRole($allowed_roles = []) {
    if (!isset($_SESSION['user_id'])) {
        header('Location: login');
        exit;
    }

    if (!empty($allowed_roles)) {
        $user_role = $_SESSION['role_id'] ?? 0;
        if (!in_array($user_role, $allowed_roles)) {
            header('Location: dashboard');
            exit;
        }
    }
}

// Check if current user is Admin (role_id = 1)
function isAdmin() {
    return isset($_SESSION['role_id']) && $_SESSION['role_id'] == 1;
}

// Get current user's role name
function getUserRoleName() {
    global $db;
    if (!isset($_SESSION['role_id'])) {
        return 'Guest';
    }
    $sql = "SELECT name FROM roles WHERE id = {$_SESSION['role_id']}";
    $result = $db->query($sql);
    $row = $result->fetch_assoc();
    return $row['name'] ?? 'Unknown';
}
?>