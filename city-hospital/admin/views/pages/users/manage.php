<?php
require_once 'models/user.class.php';
require_once 'config/auth.php';

// Only Admin can access
checkRole([1]);

/**
 * Handle Delete Request
 */
if (isset($_POST['delete_id'])) {
    $id = $_POST['delete_id'];
    $res = User::delete($id);

    if ($res === true) {
        $msg = "User deleted successfully!";
    } else {
        $msg = $res;
    }
}

/**
 * Get all users
 */
$users = User::readAll();
?>

<div class="main-content-container overflow-hidden">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
        <h3 class="mb-0">User Management</h3>
        <a href="users/create" class="btn btn-primary py-2 px-4 fw-medium fs-16">+ Add New User</a>
    </div>

    <!-- Display Message -->
    <?php if (isset($msg)): ?>
        <div class="alert alert-dark alert-dismissible fade show" role="alert">
            <?= $msg ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <div class="card bg-white border-0 rounded-3 mb-4">
        <div class="card-body p-20">
            <div class="default-table-area all-products">
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Role</th>
                                <th scope="col">Created Date</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($users as $row): ?>
                                <tr>
                                    <td><?= $row['id'] ?></td>
                                    <td><?= htmlspecialchars($row['name']) ?></td>
                                    <td><?= htmlspecialchars($row['email']) ?></td>
                                    <td><?= htmlspecialchars($row['role_name'] ?? 'N/A') ?></td>
                                    <td><?= date('d M, Y', strtotime($row['created_at'])) ?></td>
                                    <td>
                                        <div class="d-flex align-items-center gap-1">
                                            <!-- Edit -->
                                            <a href="users/edit?id=<?= $row['id'] ?>" 
                                               class="ps-0 border-0 bg-transparent lh-1 position-relative top-2" 
                                               title="Edit User">
                                                <i class="material-symbols-outlined fs-18 text-body">edit</i>
                                            </a>

                                            <!-- Delete (Prevent deleting yourself) -->
                                            <?php if ($row['id'] != $_SESSION['user_id']): ?>
                                                <form method="POST" style="display:inline;">
                                                    <input type="hidden" name="delete_id" value="<?= $row['id'] ?>">
                                                    <button type="submit" 
                                                            class="ps-0 border-0 bg-transparent lh-1 position-relative top-2" 
                                                            onclick="return confirm('Are you sure you want to delete this user?')"
                                                            title="Delete User">
                                                        <i class="material-symbols-outlined fs-18 text-danger">delete</i>
                                                    </button>
                                                </form>
                                            <?php else: ?>
                                                <span class="ps-0 lh-1 position-relative top-2 opacity-50" title="Cannot delete yourself">
                                                    <i class="material-symbols-outlined fs-18 text-secondary">delete</i>
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>