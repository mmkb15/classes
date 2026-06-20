<?php
require_once __DIR__ . '/../../../config/base.php';
require_once __DIR__ . '/../../../config/db.php';
require_once __DIR__ . '/../../../config/auth.php';

$pageTitle   = 'Reports';
$currentPage = 'reports';

// Filter by date range
$dateFrom = $_GET['date_from'] ?? date('Y-m-01'); // এই মাসের শুরু
$dateTo   = $_GET['date_to']   ?? date('Y-m-d');  // আজকে

// Report data
$appointments = $pdo->prepare("
    SELECT a.*, p.name AS patient_name, p.gender, p.blood_group,
           d.name AS doctor_name, d.specialty
    FROM appointments a
    JOIN patients p ON a.patient_id = p.id
    JOIN doctors  d ON a.doctor_id  = d.id
    WHERE a.appointment_date BETWEEN ? AND ?
    ORDER BY a.appointment_date ASC
");
$appointments->execute([$dateFrom, $dateTo]);
$appointments = $appointments->fetchAll();

// Summary counts
$total     = count($appointments);
$confirmed = count(array_filter($appointments, fn($a) => $a['status'] == 'Confirmed'));
$pending   = count(array_filter($appointments, fn($a) => $a['status'] == 'Pending'));
$cancelled = count(array_filter($appointments, fn($a) => $a['status'] == 'Cancelled'));
$completed = count(array_filter($appointments, fn($a) => $a['status'] == 'Completed'));

include __DIR__ . '/../../../views/layouts/header.php';
include __DIR__ . '/../../../views/layouts/sidebar.php';
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h5 class="mb-0">Appointment Report</h5>
    <button onclick="printReport()" class="btn btn-primary no-print">
        <i class="fas fa-print me-1"></i> Print Report
    </button>
</div>

<!-- Date Filter -->
<div class="card mb-4 no-print">
    <div class="card-body">
        <form method="GET" class="row g-3 align-items-end">
            <div class="col-md-4">
                <label class="form-label fw-semibold">From Date</label>
                <input type="date" name="date_from" class="form-control" value="<?= $dateFrom ?>">
            </div>
            <div class="col-md-4">
                <label class="form-label fw-semibold">To Date</label>
                <input type="date" name="date_to" class="form-control" value="<?= $dateTo ?>">
            </div>
            <div class="col-md-4">
                <button type="submit" class="btn btn-primary w-100">
                    <i class="fas fa-search me-1"></i> Generate Report
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Printable Report Area -->
<div id="printArea">

    <!-- Print Header (only visible when printing) -->
    <div class="print-only" style="display:none; text-align:center; margin-bottom:24px;">
        <h2 style="color:#1a3c6e;">🏥 City General Hospital</h2>
        <h3>Appointment Report</h3>
        <p>Period: <?= date('d M Y', strtotime($dateFrom)) ?> — <?= date('d M Y', strtotime($dateTo)) ?></p>
        <p>Generated: <?= date('d M Y, h:i A') ?></p>
        <hr>
    </div>

    <!-- Summary Cards -->
    <div class="row g-3 mb-4">
        <div class="col-md-3 col-6">
            <div style="background:#e8f0fe;border-radius:10px;padding:16px;text-align:center;">
                <div style="font-size:28px;font-weight:700;color:#3584fc;"><?= $total ?></div>
                <div style="color:#555;font-size:13px;font-weight:600;">Total</div>
            </div>
        </div>
        <div class="col-md-3 col-6">
            <div style="background:#d4edda;border-radius:10px;padding:16px;text-align:center;">
                <div style="font-size:28px;font-weight:700;color:#28a745;"><?= $confirmed ?></div>
                <div style="color:#555;font-size:13px;font-weight:600;">Confirmed</div>
            </div>
        </div>
        <div class="col-md-3 col-6">
            <div style="background:#fff3cd;border-radius:10px;padding:16px;text-align:center;">
                <div style="font-size:28px;font-weight:700;color:#fd7e14;"><?= $pending ?></div>
                <div style="color:#555;font-size:13px;font-weight:600;">Pending</div>
            </div>
        </div>
        <div class="col-md-3 col-6">
            <div style="background:#f8d7da;border-radius:10px;padding:16px;text-align:center;">
                <div style="font-size:28px;font-weight:700;color:#dc3545;"><?= $cancelled ?></div>
                <div style="color:#555;font-size:13px;font-weight:600;">Cancelled</div>
            </div>
        </div>
    </div>

    <!-- Report Table -->
    <div class="card">
        <div class="card-header">
            <h6 class="mb-0">
                Appointments: <?= date('d M Y', strtotime($dateFrom)) ?> — <?= date('d M Y', strtotime($dateTo)) ?>
                <span class="badge bg-primary ms-2"><?= $total ?> records</span>
            </h6>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-bordered mb-0" id="reportTable">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Patient Name</th>
                            <th>Gender</th>
                            <th>Doctor</th>
                            <th>Specialty</th>
                            <th>Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($appointments)): ?>
                            <tr><td colspan="7" class="text-center py-4 text-muted">এই সময়ের মধ্যে কোনো appointment নেই</td></tr>
                        <?php else: ?>
                            <?php foreach ($appointments as $i => $a): ?>
                            <tr>
                                <td><?= $i + 1 ?></td>
                                <td><?= htmlspecialchars($a['patient_name']) ?></td>
                                <td><?= $a['gender'] ?></td>
                                <td><?= htmlspecialchars($a['doctor_name']) ?></td>
                                <td><?= $a['specialty'] ?></td>
                                <td><?= date('d M Y', strtotime($a['appointment_date'])) ?></td>
                                <td>
                                    <?php
                                    $badges = ['Pending'=>'warning','Confirmed'=>'success','Cancelled'=>'danger','Completed'=>'info'];
                                    $badge  = $badges[$a['status']] ?? 'secondary';
                                    ?>
                                    <span class="badge bg-<?= $badge ?>"><?= $a['status'] ?></span>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <?php if ($total > 0): ?>
        <div class="card-footer text-muted text-end" style="font-size:13px;">
            Total <?= $total ?> appointments | Confirmed: <?= $confirmed ?> | Pending: <?= $pending ?> | Cancelled: <?= $cancelled ?>
        </div>
        <?php endif; ?>
    </div>

</div><!-- /#printArea -->

<script>
function printReport() {
    // Print header দেখাও
    document.querySelector('.print-only').style.display = 'block';
    window.print();
    document.querySelector('.print-only').style.display = 'none';
}
</script>

<style>
@media print {
    .no-print { display: none !important; }
    .print-only { display: block !important; }
    .badge { border: 1px solid #ccc; padding: 2px 6px; border-radius: 4px; }
}
</style>

<?php include __DIR__ . '/../../../views/layouts/footer.php'; ?>
