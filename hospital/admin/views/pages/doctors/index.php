<?php
require_once __DIR__ . '/../../../config/base.php';
require_once __DIR__ . '/../../../config/db.php';
require_once __DIR__ . '/../../../config/auth.php';

$pageTitle   = 'Doctors';
$currentPage = 'doctors';

if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $pdo->prepare("DELETE FROM doctors WHERE id = ?")->execute([$id]);
    header('Location: index.php?msg=deleted');
    exit;
}

$doctors = $pdo->query("
    SELECT d.*, dep.name AS dept_name 
    FROM doctors d
    LEFT JOIN departments dep ON d.department_id = dep.id
    ORDER BY d.created_at DESC
")->fetchAll();

include __DIR__ . '/../../../views/layouts/header.php';
include __DIR__ . '/../../../views/layouts/sidebar.php';
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h5 class="mb-0">All Doctors (<?= count($doctors) ?>)</h5>
    <a href="add.php" class="btn btn-primary"><i class="fas fa-plus me-1"></i> Add Doctor</a>
</div>

<?php if (isset($_GET['msg'])): ?>
    <div class="alert-<?= $_GET['msg'] == 'deleted' ? 'danger' : 'success' ?>">
        <?= $_GET['msg'] == 'deleted' ? '✅ Doctor deleted.' : '✅ Doctor saved!' ?>
    </div>
<?php endif; ?>

<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Specialty</th>
                        <th>Department</th>
                        <th>Phone</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($doctors)): ?>
                        <tr><td colspan="7" class="text-center py-4 text-muted">কোনো doctor নেই</td></tr>
                    <?php else: ?>
                        <?php foreach ($doctors as $i => $d): ?>
                        <tr>
                            <td><?= $i + 1 ?></td>
                            <td><i class="fas fa-user-md text-success me-1"></i><?= htmlspecialchars($d['name']) ?></td>
                            <td><?= htmlspecialchars($d['specialty']) ?></td>
                            <td><?= htmlspecialchars($d['dept_name'] ?? '-') ?></td>
                            <td><?= $d['phone'] ?></td>
                            <td>
                                <span class="badge bg-<?= $d['status'] == 'Active' ? 'success' : 'secondary' ?>">
                                    <?= $d['status'] ?>
                                </span>
                            </td>
                            <td>
                                <a href="edit.php?id=<?= $d['id'] ?>" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                                <a href="index.php?delete=<?= $d['id'] ?>" class="btn btn-sm btn-danger"
                                   onclick="return confirm('Doctor delete করবে?')"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../../../views/layouts/footer.php'; ?>
