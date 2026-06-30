<?php
require_once 'models/user.class.php';
require_once 'models/role.class.php';

$roles = Role::readAll();
$error = '';
$success = '';

if (isset($_POST['btn-register'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role_id = $_POST['role_id'];

    // Check if email already exists
    global $db;
    $check = $db->query("SELECT id FROM users WHERE email = '$email'");
    if ($check->num_rows > 0) {
        $error = 'Email already registered. Please login.';
    } else {
        $user = new User(null, $name, $email, $password, $role_id);
        $res = $user->register();

        if (is_numeric($res)) {
            $success = 'Registration successful! <a href="login">Login now</a>';
        } else {
            $error = $res;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - City Hospital</title>
    <link rel="stylesheet" href="admin/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="admin/assets/css/style.css">
</head>
<body style="background: #f0f2f5; display: flex; align-items: center; justify-content: center; min-height: 100vh;">

<div class="container" style="max-width: 500px;">
    <div class="card bg-white border-0 rounded-3 shadow-sm">
        <div class="card-body p-4">
            <div class="text-center mb-4">
                <img src="admin/assets/images/logo-icon.png" alt="Logo" style="width: 60px;">
                <h3 class="mt-2">City Hospital</h3>
                <p class="text-muted">Create a new account</p>
            </div>

            <?php if ($success): ?>
                <div class="alert alert-success"><?= $success ?></div>
            <?php endif; ?>

            <?php if ($error): ?>
                <div class="alert alert-danger"><?= $error ?></div>
            <?php endif; ?>

            <form method="POST">
                <div class="form-group mb-3">
                    <label class="label text-secondary">Full Name</label>
                    <input type="text" name="name" class="form-control h-60 border-border-color" placeholder="Enter your full name" required>
                </div>

                <div class="form-group mb-3">
                    <label class="label text-secondary">Email Address</label>
                    <input type="email" name="email" class="form-control h-60 border-border-color" placeholder="Enter your email" required>
                </div>

                <div class="form-group mb-3">
                    <label class="label text-secondary">Password</label>
                    <input type="password" name="password" class="form-control h-60 border-border-color" placeholder="Enter your password" required>
                </div>

                <div class="form-group mb-3">
                    <label class="label text-secondary">Role</label>
                    <select class="form-control h-60 border-border-color" name="role_id" required>
                        <option value="">Select Role</option>
                        <?php foreach ($roles as $role): ?>
                            <option value="<?= $role['id'] ?>"><?= $role['name'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <button type="submit" name="btn-register" class="btn btn-primary w-100 h-60 fs-16 fw-medium">
                    <i class="material-symbols-outlined fs-18 me-1" style="vertical-align: middle;">person_add</i> Register
                </button>
            </form>

            <div class="text-center mt-3">
                <p class="fs-14">Already have an account? <a href="login" class="text-primary">Sign In</a></p>
            </div>
        </div>
    </div>
</div>

</body>
</html>