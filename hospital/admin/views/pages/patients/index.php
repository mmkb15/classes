<?php
require_once __DIR__ . '/../../../config/base.php';
require_once __DIR__ . '/../../../config/db.php';
require_once __DIR__ . '/../../../config/auth.php';

$pageTitle   = 'Patients';
$currentPage = 'patients';

// Delete
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $pdo->prepare("DELETE FROM patients WHERE id = ?")->execute([$id]);
    header('Location: index.php?msg=deleted');
    exit;
}

$patients = $pdo->query("SELECT * FROM patients ORDER BY created_at DESC")->fetchAll();

include __DIR__ . '/../../../views/layouts/header.php';
include __DIR__ . '/../../../views/layouts/sidebar.php';
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h5 class="mb-0">All Patients (<?= count($patients) ?>)</h5>
    <a href="add.php" class="btn btn-primary"><i class="fas fa-plus me-1"></i> Add Patient</a>
</div>

<?php if (isset($_GET['msg'])): ?>
    <div class="alert-<?= $_GET['msg'] == 'deleted' ? 'danger' : 'success' ?>">
        <?= $_GET['msg'] == 'deleted' ? '✅ Patient deleted.' : '✅ Patient saved successfully!' ?>
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
                        <th>Age</th>
                        <th>Gender</th>
                        <th>Phone</th>
                        <th>Blood Group</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($patients)): ?>
                        <tr><td colspan="7" class="text-center py-4 text-muted">কোনো patient নেই</td></tr>
                    <?php else: ?>
                        <?php foreach ($patients as $i => $p): ?>
                        <tr>
                            <td><?= $i + 1 ?></td>
                            <td><i class="fas fa-user-circle text-primary me-1"></i><?= htmlspecialchars($p['name']) ?></td>
                            <td><?= $p['age'] ?></td>
                            <td><?= $p['gender'] ?></td>
                            <td><?= $p['phone'] ?></td>
                            <td><span class="badge bg-danger"><?= $p['blood_group'] ?></span></td>
                            <td>
                                <a href="edit.php?id=<?= $p['id'] ?>" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="index.php?delete=<?= $p['id'] ?>" class="btn btn-sm btn-danger"
                                   onclick="return confirm('Patient delete করবে?')">
                                    <i class="fas fa-trash"></i>
                                </a>
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
