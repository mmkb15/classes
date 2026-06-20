<?php
require_once __DIR__ . '/../../../config/base.php';
require_once __DIR__ . '/../../../config/db.php';
require_once __DIR__ . '/../../../config/auth.php';

$pageTitle   = 'Appointments';
$currentPage = 'appointments';

// Status update
if (isset($_GET['status']) && isset($_GET['id'])) {
    $id     = (int)$_GET['id'];
    $status = $_GET['status'];
    $allowed = ['Pending','Confirmed','Cancelled','Completed'];
    if (in_array($status, $allowed)) {
        $pdo->prepare("UPDATE appointments SET status = ? WHERE id = ?")->execute([$status, $id]);
    }
    header('Location: index.php?msg=updated');
    exit;
}

// Delete
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $pdo->prepare("DELETE FROM appointments WHERE id = ?")->execute([$id]);
    header('Location: index.php?msg=deleted');
    exit;
}

$appointments = $pdo->query("
    SELECT a.*, p.name AS patient_name, d.name AS doctor_name, d.specialty
    FROM appointments a
    JOIN patients p ON a.patient_id = p.id
    JOIN doctors  d ON a.doctor_id  = d.id
    ORDER BY a.appointment_date DESC, a.appointment_time ASC
")->fetchAll();

include __DIR__ . '/../../../views/layouts/header.php';
include __DIR__ . '/../../../views/layouts/sidebar.php';
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h5 class="mb-0">All Appointments (<?= count($appointments) ?>)</h5>
    <a href="add.php" class="btn btn-primary"><i class="fas fa-plus me-1"></i> Book Appointment</a>
</div>

<?php if (isset($_GET['msg'])): ?>
    <div class="alert-<?= $_GET['msg'] == 'deleted' ? 'danger' : 'success' ?>">
        <?= $_GET['msg'] == 'deleted' ? '✅ Appointment deleted.' : '✅ Updated successfully!' ?>
    </div>
<?php endif; ?>

<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Patient</th>
                        <th>Doctor</th>
                        <th>Date & Time</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($appointments)): ?>
                        <tr><td colspan="6" class="text-center py-4 text-muted">কোনো appointment নেই</td></tr>
                    <?php else: ?>
                        <?php foreach ($appointments as $i => $a): ?>
                        <tr>
                            <td><?= $i + 1 ?></td>
                            <td><?= htmlspecialchars($a['patient_name']) ?></td>
                            <td>
                                <?= htmlspecialchars($a['doctor_name']) ?>
                                <br><small class="text-muted"><?= $a['specialty'] ?></small>
                            </td>
                            <td>
                                <?= date('d M Y', strtotime($a['appointment_date'])) ?>
                                <?php if ($a['appointment_time']): ?>
                                    <br><small class="text-muted"><?= date('h:i A', strtotime($a['appointment_time'])) ?></small>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php
                                $badges = ['Pending'=>'warning','Confirmed'=>'success','Cancelled'=>'danger','Completed'=>'info'];
                                $badge  = $badges[$a['status']] ?? 'secondary';
                                ?>
                                <span class="badge bg-<?= $badge ?>"><?= $a['status'] ?></span>
                            </td>
                            <td>
                                <?php if ($a['status'] == 'Pending'): ?>
                                    <a href="index.php?id=<?= $a['id'] ?>&status=Confirmed" class="btn btn-sm btn-success" title="Confirm">
                                        <i class="fas fa-check"></i>
                                    </a>
                                <?php endif; ?>
                                <a href="slip.php?id=<?= $a['id'] ?>" class="btn btn-sm btn-primary" target="_blank" title="Print Slip">
                                    <i class="fas fa-print"></i>
                                </a>
                                <a href="index.php?delete=<?= $a['id'] ?>" class="btn btn-sm btn-danger"
                                   onclick="return confirm('Delete করবে?')" title="Delete">
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
