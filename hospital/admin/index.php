<?php
require_once __DIR__ . '/config/base.php';
require_once __DIR__ . '/config/db.php';
require_once __DIR__ . '/config/auth.php';

$pageTitle   = 'Dashboard';
$currentPage = 'dashboard';

// Stats
$totalPatients     = $pdo->query("SELECT COUNT(*) FROM patients")->fetchColumn();
$totalDoctors      = $pdo->query("SELECT COUNT(*) FROM doctors")->fetchColumn();
$todayAppointments = $pdo->query("SELECT COUNT(*) FROM appointments WHERE appointment_date = CURDATE()")->fetchColumn();
$pendingAppoints   = $pdo->query("SELECT COUNT(*) FROM appointments WHERE status = 'Pending'")->fetchColumn();

// Recent appointments
$recentAppoints = $pdo->query("
    SELECT a.*, p.name AS patient_name, d.name AS doctor_name
    FROM appointments a
    JOIN patients p ON a.patient_id = p.id
    JOIN doctors  d ON a.doctor_id  = d.id
    ORDER BY a.created_at DESC
    LIMIT 5
")->fetchAll();

include __DIR__ . '/views/layouts/header.php';
include __DIR__ . '/views/layouts/sidebar.php';
?>

<!-- Stat Cards -->
<div class="row g-4 mb-4">
    <div class="col-xl-3 col-md-6">
        <div class="card-stat" style="background:linear-gradient(135deg,#3584fc,#1a6ef5);">
            <i class="fas fa-procedures"></i>
            <div class="stat-info">
                <h3><?= $totalPatients ?></h3>
                <p>Total Patients</p>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card-stat" style="background:linear-gradient(135deg,#28a745,#1e7e34);">
            <i class="fas fa-user-md"></i>
            <div class="stat-info">
                <h3><?= $totalDoctors ?></h3>
                <p>Total Doctors</p>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card-stat" style="background:linear-gradient(135deg,#fd7e14,#e56b0b);">
            <i class="fas fa-calendar-day"></i>
            <div class="stat-info">
                <h3><?= $todayAppointments ?></h3>
                <p>Today's Appointments</p>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card-stat" style="background:linear-gradient(135deg,#dc3545,#c82333);">
            <i class="fas fa-clock"></i>
            <div class="stat-info">
                <h3><?= $pendingAppoints ?></h3>
                <p>Pending Appointments</p>
            </div>
        </div>
    </div>
</div>

<!-- Recent Appointments Table -->
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="fas fa-calendar-check me-2 text-primary"></i>Recent Appointments</h5>
        <a href="<?= BASE_URL_ADMIN ?>views/pages/appointments/index.php" class="btn btn-sm btn-primary">View All</a>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Patient</th>
                        <th>Doctor</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($recentAppoints)): ?>
                        <tr><td colspan="6" class="text-center py-4 text-muted">কোনো appointment নেই</td></tr>
                    <?php else: ?>
                        <?php foreach ($recentAppoints as $i => $a): ?>
                        <tr>
                            <td><?= $i + 1 ?></td>
                            <td><?= htmlspecialchars($a['patient_name']) ?></td>
                            <td><?= htmlspecialchars($a['doctor_name']) ?></td>
                            <td><?= date('d M Y', strtotime($a['appointment_date'])) ?></td>
                            <td>
                                <?php
                                $badges = ['Pending'=>'warning','Confirmed'=>'success','Cancelled'=>'danger','Completed'=>'info'];
                                $badge  = $badges[$a['status']] ?? 'secondary';
                                ?>
                                <span class="badge bg-<?= $badge ?>"><?= $a['status'] ?></span>
                            </td>
                            <td>
                                <a href="<?= BASE_URL_ADMIN ?>views/pages/appointments/slip.php?id=<?= $a['id'] ?>" 
                                   class="btn btn-sm btn-outline-primary" target="_blank">
                                    <i class="fas fa-print"></i> Slip
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

<?php include __DIR__ . '/views/layouts/footer.php'; ?>
