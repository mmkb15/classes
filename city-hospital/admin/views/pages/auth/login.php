<?php
require_once 'models/user.class.php';

// If already logged in, redirect to dashboard
if (User::isLoggedIn()) {
    header('Location: dashboard');
    exit;
}

$error = '';

if (isset($_POST['btn-login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (User::login($email, $password)) {
        header('Location: dashboard');
        exit;
    } else {
        $error = 'Invalid email or password.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - City Hospital</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        body {
            background: #f0f2f5;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin: 0;
            padding: 20px;
        }
        .login-container {
            max-width: 420px;
            width: 100%;
        }
        .login-card {
            background: #fff;
            border-radius: 12px;
            padding: 40px 35px;
            box-shadow: 0 8px 30px rgba(0,0,0,0.10);
        }
        .login-logo {
            text-align: center;
            margin-bottom: 30px;
        }
        .login-logo img {
            width: 70px;
        }
        .login-logo h3 {
            margin-top: 10px;
            font-weight: 700;
            color: #1a1a1a;
        }
        .login-logo p {
            color: #8a8a8a;
            font-size: 14px;
        }
        .form-control {
            height: 52px;
            border-radius: 8px;
            border: 1px solid #e0e0e0;
            padding: 0 16px;
            font-size: 14px;
        }
        .form-control:focus {
            border-color: #4936f5;
            box-shadow: 0 0 0 3px rgba(73, 54, 245, 0.10);
        }
        .btn-login {
            height: 52px;
            background: #4936f5;
            color: #fff;
            font-weight: 600;
            font-size: 16px;
            border: none;
            border-radius: 8px;
            width: 100%;
            transition: background 0.2s;
        }
        .btn-login:hover {
            background: #3a2bc4;
        }
        .register-link {
            text-align: center;
            margin-top: 15px;
            font-size: 14px;
            color: #5a5a5a;
        }
        .register-link a {
            color: #4936f5;
            text-decoration: none;
            font-weight: 500;
        }
        .register-link a:hover {
            text-decoration: underline;
        }
        .alert {
            border-radius: 8px;
            padding: 12px 16px;
            font-size: 14px;
        }
        .label {
            font-weight: 500;
            font-size: 14px;
            color: #1a1a1a;
            display: block;
            margin-bottom: 6px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-card">
            <div class="login-logo">
                <img src="assets/images/logo-icon.png" alt="Logo">
                <h3>City Hospital</h3>
                <p>Sign in to your account</p>
            </div>

            <?php if ($error): ?>
                <div class="alert alert-danger"><?= $error ?></div>
            <?php endif; ?>

            <form method="POST">
                <div class="form-group mb-3">
                    <label class="label">Email Address</label>
                    <input type="email" name="email" class="form-control" placeholder="Enter your email" required>
                </div>

                <div class="form-group mb-3">
                    <label class="label">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Enter your password" required>
                </div>

                <button type="submit" name="btn-login" class="btn-login">Sign In</button>
            </form>

            <div class="register-link">
                Don't have an account? <a href="register">Register</a>
            </div>
        </div>
    </div>
</body>
</html>