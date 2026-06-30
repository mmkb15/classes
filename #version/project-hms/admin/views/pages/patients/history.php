<?php
require_once 'models/patient.class.php';

$id = isset($_GET['id']) ? $_GET['id'] : 0;
$history = Patient::getFullHistory($id);

if(!$history['patient']) {
    echo "<div class='alert alert-danger'>Patient not found! <a href='?page=patients/manage'>Go Back</a></div>";
    exit;
}

$patient = $history['patient'];
?>

<div class="main-content-container overflow-hidden">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
        <h3 class="mb-0">Patient History</h3>
        <a href="?page=patients/manage" class="btn btn-secondary">← Back to List</a>
    </div>

    <!-- ==========================================
    PATIENT BASIC INFO
    ========================================== -->
    <div class="card bg-white border-0 rounded-3 mb-4">
        <div class="card-body p-20">
            <div class="row">
                <div class="col-md-6">
                    <h4><?= htmlspecialchars($patient['name']) ?></h4>
                    <p><strong>ID:</strong> <?= $patient['id'] ?></p>
                    <p><strong>Age:</strong> <?= $patient['age'] ?></p>
                    <p><strong>Gender:</strong> <?= ($patient['gender_id'] == 1) ? 'Male' : (($patient['gender_id'] == 2) ? 'Female' : 'Other') ?></p>
                </div>
                <div class="col-md-6">
                    <p><strong>Phone:</strong> <?= $patient['phone'] ?></p>
                    <p><strong>Address:</strong> <?= htmlspecialchars($patient['address']) ?></p>
                    <p><strong>Registered:</strong> <?= date('d M, Y', strtotime($patient['created_at'])) ?></p>
                </div>
            </div>
        </div>
    </div>

    <!-- ==========================================
    ADMISSIONS
    ========================================== -->
    <div class="card bg-white border-0 rounded-3 mb-4">
        <div class="card-body p-20">
            <h4>Admissions (<?= count($history['admissions']) ?>)</h4>
            <?php if(count($history['admissions']) > 0): ?>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Room</th>
                            <th>Admit Date</th>
                            <th>Discharge Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($history['admissions'] as $adm): ?>
                        <tr>
                            <td><?= $adm['id'] ?></td>
                            <td><?= $adm['room_no'] ?? 'N/A' ?> (<?= $adm['room_type'] ?? 'N/A' ?>)</td>
                            <td><?= date('d M, Y', strtotime($adm['admit_date'])) ?></td>
                            <td><?= $adm['discharge_date'] ? date('d M, Y', strtotime($adm['discharge_date'])) : 'N/A' ?></td>
                            <td>
                                <span class="badge <?= ($adm['status'] == 'Admitted') ? 'bg-success' : 'bg-secondary' ?>">
                                    <?= $adm['status'] ?>
                                </span>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <?php else: ?>
            <p class="text-muted">No admissions found.</p>
            <?php endif; ?>
        </div>
    </div>

    <!-- ==========================================
    PRESCRIPTIONS
    ========================================== -->
    <div class="card bg-white border-0 rounded-3 mb-4">
        <div class="card-body p-20">
            <h4>Prescriptions (<?= count($history['prescriptions']) ?>)</h4>
            <?php if(count($history['prescriptions']) > 0): ?>
            <?php foreach($history['prescriptions'] as $presc): ?>
            <div class="border-bottom pb-3 mb-3">
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Prescription #<?= $presc['id'] ?></strong></p>
                        <p><strong>Doctor:</strong> <?= htmlspecialchars($presc['doctor_name'] ?? 'N/A') ?></p>
                        <p><strong>Date:</strong> <?= date('d M, Y', strtotime($presc['prescription_date'])) ?></p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Follow-up:</strong> <?= $presc['follow_up_date'] ? date('d M, Y', strtotime($presc['follow_up_date'])) : 'N/A' ?></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <p><strong>Diagnosis:</strong> <?= nl2br(htmlspecialchars($presc['diagnosis'] ?? '')) ?></p>
                    </div>
                </div>
                <?php if(isset($presc['medicines']) && count($presc['medicines']) > 0): ?>
                <div class="row">
                    <div class="col-12">
                        <p><strong>Medicines:</strong></p>
                        <ul>
                            <?php foreach($presc['medicines'] as $med): ?>
                            <li><?= htmlspecialchars($med['medicine_name'] ?? 'N/A') ?> (<?= $med['strength'] ?? '' ?>) - <?= $med['dosage'] ?? '' ?> - <?= $med['duration'] ?? '' ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
                <?php endif; ?>
                <?php if(isset($presc['tests']) && count($presc['tests']) > 0): ?>
                <div class="row">
                    <div class="col-12">
                        <p><strong>Tests:</strong></p>
                        <ul>
                            <?php foreach($presc['tests'] as $test): ?>
                            <li><?= htmlspecialchars($test['test_name'] ?? 'N/A') ?> (<?= $test['instructions'] ?? '' ?>)</li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
                <?php endif; ?>
                <?php if($presc['notes']): ?>
                <div class="row">
                    <div class="col-12">
                        <p><strong>Notes:</strong> <?= htmlspecialchars($presc['notes']) ?></p>
                    </div>
                </div>
                <?php endif; ?>
            </div>
            <?php endforeach; ?>
            <?php else: ?>
            <p class="text-muted">No prescriptions found.</p>
            <?php endif; ?>
        </div>
    </div>

    <!-- ==========================================
    BILLS
    ========================================== -->
    <div class="card bg-white border-0 rounded-3 mb-4">
        <div class="card-body p-20">
            <h4>Bills (<?= count($history['bills']) ?>)</h4>
            <?php if(count($history['bills']) > 0): ?>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Bill ID</th>
                            <th>Amount</th>
                            <th>Date</th>
                            <th>Description</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($history['bills'] as $bill): ?>
                        <tr>
                            <td><?= $bill['id'] ?></td>
                            <td><?= $bill['amount'] ?></td>
                            <td><?= date('d M, Y', strtotime($bill['bill_date'])) ?></td>
                            <td><?= htmlspecialchars($bill['description'] ?? '') ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <?php else: ?>
            <p class="text-muted">No bills found.</p>
            <?php endif; ?>
        </div>
    </div>
</div>