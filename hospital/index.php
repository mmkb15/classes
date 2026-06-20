<?php
session_start();
require_once 'admin/config/base.php';
require_once 'admin/config/db.php';

// Already logged in থাকলে dashboard এ পাঠাও
if (isset($_SESSION['user_id'])) {
    header('Location: admin/index.php');
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if ($username && $password) {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ? AND password = MD5(?)");
        $stmt->execute([$username, $password]);
        $user = $stmt->fetch();

        if ($user) {
            $_SESSION['user_id']   = $user['id'];
            $_SESSION['username']  = $user['username'];
            $_SESSION['role']      = $user['role'];
            header('Location: admin/index.php');
            exit;
        } else {
            $error = 'Username অথবা Password ভুল!';
        }
    } else {
        $error = 'সব field পূরণ করো।';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="admin/assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <title>Login - Hospital Management System</title>
    <style>
        body { background: #f0f4f8; display: flex; align-items: center; justify-content: center; min-height: 100vh; margin: 0; font-family: 'Segoe UI', sans-serif; }
        .login-card { background: #fff; border-radius: 16px; box-shadow: 0 10px 40px rgba(0,0,0,0.12); padding: 48px 40px; width: 100%; max-width: 420px; }
        .login-logo { text-align: center; margin-bottom: 32px; }
        .login-logo i { font-size: 48px; color: #3584fc; }
        .login-logo h2 { margin: 12px 0 4px; color: #1a1a2e; font-size: 22px; font-weight: 700; }
        .login-logo p { color: #888; font-size: 14px; margin: 0; }
        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; margin-bottom: 6px; color: #444; font-size: 14px; font-weight: 500; }
        .form-group input { width: 100%; padding: 12px 16px; border: 1.5px solid #e0e0e0; border-radius: 8px; font-size: 15px; box-sizing: border-box; transition: border-color 0.2s; outline: none; }
        .form-group input:focus { border-color: #3584fc; }
        .btn-login { width: 100%; padding: 13px; background: #3584fc; color: #fff; border: none; border-radius: 8px; font-size: 16px; font-weight: 600; cursor: pointer; transition: background 0.2s; }
        .btn-login:hover { background: #1a6ef5; }
        .alert-error { background: #fff0f0; border: 1px solid #ffcccc; color: #c0392b; padding: 12px 16px; border-radius: 8px; margin-bottom: 20px; font-size: 14px; }
        .hint { text-align: center; margin-top: 20px; color: #aaa; font-size: 13px; }
    </style>
</head>
<body>
    <div class="login-card">
        <div class="login-logo">
            <i class="fas fa-hospital-alt"></i>
            <h2>Hospital Management</h2>
            <p>Admin Panel এ প্রবেশ করুন</p>
        </div>

        <?php if ($error): ?>
            <div class="alert-error"><i class="fas fa-exclamation-circle"></i> <?= $error ?></div>
        <?php endif; ?>

        <form method="POST">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" placeholder="admin" value="<?= htmlspecialchars($_POST['username'] ?? '') ?>" required>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" placeholder="••••••••" required>
            </div>
            <button type="submit" class="btn-login"><i class="fas fa-sign-in-alt"></i> Login</button>
        </form>
        <div class="hint">Default: admin / admin123</div>
    </div>
</body>
</html>
