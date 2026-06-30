<?php
require_once 'models/user.class.php';
require_once 'models/role.class.php';
require_once 'config/auth.php';

// Only Admin can access
checkRole([1]);

$id = isset($_GET['id']) ? $_GET['id'] : 0;
$row = User::readByID($id);

if (!$row) {
    echo "<div class='alert alert-danger'>User not found! <a href='users'>Go Back</a></div>";
    exit;
}

$roles = Role::readAll();
$error = '';
$success = '';

if (isset($_POST['btn-submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role_id = $_POST['role_id'];

    $user = new User($id, $name, $email, $password, $role_id);
    $res = $user->update();

    if ($res === true) {
        $success = 'User updated successfully!';
        $row = User::readByID($id);
    } else {
        $error = $res;
    }
}
?>

<div class="main-content-container overflow-hidden">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
        <h3 class="mb-0">Edit User</h3>
    </div>

    <?php if ($success): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= $success ?>
            <a href="users" class="alert-link">Go to List</a>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <?php if ($error): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= $error ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <div class="card bg-white border-0 rounded-3 mb-4">
        <div class="card-body p-20">
            <form method="POST">
                <div class="row">
                    <div class="col-lg-6 col-sm-12">
                        <div class="form-group mb-4">
                            <label class="label text-secondary">Full Name</label>
                            <input type="text" name="name" class="form-control h-60 border-border-color" value="<?= htmlspecialchars($row['name']) ?>" required>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <div class="form-group mb-4">
                            <label class="label text-secondary">Email Address</label>
                            <input type="email" name="email" class="form-control h-60 border-border-color" value="<?= htmlspecialchars($row['email']) ?>" required>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <div class="form-group mb-4">
                            <label class="label text-secondary">Password (Leave blank to keep current)</label>
                            <input type="password" name="password" class="form-control h-60 border-border-color" placeholder="Enter new password (optional)">
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <div class="form-group mb-4">
                            <label class="label text-secondary">Role</label>
                            <select class="form-control h-60 border-border-color" name="role_id" required>
                                <option value="">Select Role</option>
                                <?php foreach ($roles as $role): ?>
                                    <option value="<?= $role['id'] ?>" <?= ($role['id'] == $row['role_id']) ? 'selected' : '' ?>>
                                        <?= $role['name'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="d-flex flex-wrap gap-3">
                            <button class="btn btn-primary py-2 px-4 fw-medium fs-16" type="submit" name="btn-submit">
                                <i class="ri-add-line text-white fw-medium"></i> Update User
                            </button>
                            <a href="users" class="btn btn-secondary py-2 px-4 fw-medium fs-16">Cancel</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>