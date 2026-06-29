<?php
require_once 'models/billing.class.php';
require_once 'models/patient.class.php';

$id = isset($_GET['id']) ? $_GET['id'] : 0;
$bill = Billing::readByID($id);

if (!$bill) {
    echo "<div class='alert alert-danger'>Bill not found! <a href='?page=billings/manage'>Go Back</a></div>";
    exit;
}

$patient = Patient::readByID($bill['patient_id']);

// =============================================
// FETCH BREAKDOWN DATA
// =============================================

// 1. Admission Details
$admission_data = null;
$sql = "SELECT a.*, r.room_no, r.room_type, r.rate_per_day 
        FROM admissions AS a
        LEFT JOIN rooms AS r ON a.room_id = r.id
        WHERE a.patient_id = {$bill['patient_id']} AND a.status = 'Admitted'
        ORDER BY a.id DESC LIMIT 1";
$result = $db->query($sql);
$admission = $result->fetch_assoc();

if ($admission) {
    $admit_date = new DateTime($admission['admit_date']);
    $today = new DateTime();
    $days = $admit_date->diff($today)->days + 1;
    $admission_data = [
        'description' => "Room {$admission['room_no']} ({$admission['room_type']})",
        'unit_price' => $admission['rate_per_day'] ?? 500,
        'qty' => $days,
        'total' => $days * ($admission['rate_per_day'] ?? 500)
    ];
}

// 2. Medicines
$medicines = [];
$sql = "SELECT m.name AS medicine_name, m.strength, m.price, pm.dosage, pm.duration
        FROM prescription_medicines AS pm
        LEFT JOIN medicines AS m ON pm.medicine_id = m.id
        LEFT JOIN prescriptions AS p ON pm.prescription_id = p.id
        WHERE p.patient_id = {$bill['patient_id']}";
$result = $db->query($sql);
$medicines = $result->fetch_all(MYSQLI_ASSOC);

// 3. Tests
$tests = [];
$sql = "SELECT t.name AS test_name, t.price, pt.instructions
        FROM prescription_tests AS pt
        LEFT JOIN tests AS t ON pt.test_id = t.id
        LEFT JOIN prescriptions AS p ON pt.prescription_id = p.id
        WHERE p.patient_id = {$bill['patient_id']}";
$result = $db->query($sql);
$tests = $result->fetch_all(MYSQLI_ASSOC);

// Totals
$total_medicines = array_sum(array_column($medicines, 'price'));
$total_tests = array_sum(array_column($tests, 'price'));
$grand_total = ($admission_data['total'] ?? 0) + $total_medicines + $total_tests;
?>

<div class="main-content-container overflow-hidden">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
        <h3 class="mb-0">Bill Details</h3>
        <div class="d-flex gap-2">
            <a href="?page=billings/print&id=<?= $id ?>" target="_blank" class="btn btn-success py-2 px-4 fw-medium fs-14">
                <i class="material-symbols-outlined fs-18 me-1">print</i> Print
            </a>
            <a href="?page=billings/manage" class="btn btn-secondary py-2 px-4 fw-medium fs-14">
                <i class="material-symbols-outlined fs-18 me-1">arrow_back</i> Back
            </a>
        </div>
    </div>

    <!-- ==========================================
    BILL INFO CARD
    ========================================== -->
    <div class="card bg-white border-0 rounded-3 mb-4">
        <div class="card-body p-20">
            <h4 class="fs-18 fw-semibold mb-3">Invoice #<?= $id ?></h4>
            <div class="row">
                <div class="col-md-6">
                    <p><strong>Bill ID:</strong> <?= $bill['id'] ?></p>
                    <p><strong>Patient:</strong> <?= htmlspecialchars($bill['patient_name']) ?></p>
                    <p><strong>Amount:</strong> <?= number_format($bill['amount'], 2) ?> BDT</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Bill Date:</strong> <?= date('d M, Y', strtotime($bill['bill_date'])) ?></p>
                    <p><strong>Admission ID:</strong> <?= $bill['admission_id'] ?? 'N/A' ?></p>
                    <p><strong>Description:</strong> <?= htmlspecialchars($bill['description'] ?? 'N/A') ?></p>
                </div>
            </div>
        </div>
    </div>

    <!-- ==========================================
    BREAKDOWN TABLE
    ========================================== -->
    <div class="card bg-white border-0 rounded-3 mb-4">
        <div class="card-body p-20">
            <h4 class="fs-16 fw-semibold mb-3">Treatment Charges</h4>
            <div class="default-table-area">
                <div class="table-responsive">
                    <table class="table align-middle table-bordered">
                        <thead>
                            <tr>
                                <th style="width:45%;">Description</th>
                                <th style="width:20%;">Unit Price (BDT)</th>
                                <th style="width:15%;">Qty</th>
                                <th style="width:20%;">Total (BDT)</th>
                            </tr>
                        </thead>
                        <tbody>

                            <!-- ===== BED / ADMISSION ===== -->
                            <?php if ($admission_data): ?>
                            <tr class="table-secondary">
                                <td colspan="4"><strong> Bed / Admission Charges</strong></td>
                            </tr>
                            <tr>
                                <td><?= $admission_data['description'] ?></td>
                                <td><?= number_format($admission_data['unit_price'], 2) ?></td>
                                <td><?= $admission_data['qty'] ?> day(s)</td>
                                <td><?= number_format($admission_data['total'], 2) ?></td>
                            </tr>
                            <?php endif; ?>

                            <!-- ===== MEDICINES ===== -->
                            <?php if (count($medicines) > 0): ?>
                            <tr class="table-secondary">
                                <td colspan="4"><strong> Medicines</strong></td>
                            </tr>
                            <?php foreach ($medicines as $med): ?>
                            <tr>
                                <td>
                                    <?= htmlspecialchars($med['medicine_name'] ?? 'N/A') ?>
                                    <?= $med['strength'] ? '(' . $med['strength'] . ')' : '' ?>
                                    <br><small style="color:#888;"><?= $med['dosage'] ?? '' ?> <?= $med['duration'] ? '× ' . $med['duration'] : '' ?></small>
                                </td>
                                <td><?= number_format($med['price'] ?? 0, 2) ?></td>
                                <td>1</td>
                                <td><?= number_format($med['price'] ?? 0, 2) ?></td>
                            </tr>
                            <?php endforeach; ?>
                            <tr class="table-info">
                                <td colspan="3" style="text-align:right;"><strong>Subtotal (Medicines)</strong></td>
                                <td><strong><?= number_format($total_medicines, 2) ?></strong></td>
                            </tr>
                            <?php endif; ?>

                            <!-- ===== TESTS ===== -->
                            <?php if (count($tests) > 0): ?>
                            <tr class="table-secondary">
                                <td colspan="4"><strong> Tests</strong></td>
                            </tr>
                            <?php foreach ($tests as $test): ?>
                            <tr>
                                <td>
                                    <?= htmlspecialchars($test['test_name'] ?? 'N/A') ?>
                                    <br><small style="color:#888;"><?= htmlspecialchars($test['instructions'] ?? '') ?></small>
                                </td>
                                <td><?= number_format($test['price'] ?? 0, 2) ?></td>
                                <td>1</td>
                                <td><?= number_format($test['price'] ?? 0, 2) ?></td>
                            </tr>
                            <?php endforeach; ?>
                            <tr class="table-info">
                                <td colspan="3" style="text-align:right;"><strong>Subtotal (Tests)</strong></td>
                                <td><strong><?= number_format($total_tests, 2) ?></strong></td>
                            </tr>
                            <?php endif; ?>

                            <!-- ===== GRAND TOTAL ===== -->
                            <tr class="table-success">
                                <td colspan="3" style="text-align:right; font-size:16px;"><strong>GRAND TOTAL</strong></td>
                                <td style="font-size:16px;"><strong><?= number_format($grand_total, 2) ?></strong></td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>