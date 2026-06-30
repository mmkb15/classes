<?php
require_once 'models/prescription.class.php';

$id = isset($_GET['id']) ? $_GET['id'] : 0;
$prescription = Prescription::readByID($id);
$medicines = Prescription::getMedicines($id);
$tests = Prescription::getTests($id);

if(!$prescription) {
    echo "<div class='alert alert-danger'>Prescription not found!</div>";
    exit;
}
?>

<div class="main-content-container overflow-hidden">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
        <h3 class="mb-0">Prescription Details</h3>
        <div>
            <a href="?page=prescriptions/print&id=<?= $id ?>" class="btn btn-primary" target="_blank">Print</a>
            <a href="?page=prescriptions/manage" class="btn btn-secondary">Back</a>
        </div>
    </div>

    <div class="card bg-white border-0 rounded-3 mb-4">
        <div class="card-body p-4">
            <div class="row mb-4">
                <div class="col-md-6">
                    <p><strong>Prescription #:</strong> <?= $prescription['id'] ?></p>
                    <p><strong>Patient:</strong> <?= htmlspecialchars($prescription['patient_name']) ?></p>
                    <p><strong>Doctor:</strong> <?= htmlspecialchars($prescription['doctor_name']) ?></p>
                </div>
                <div class="col-md-6 text-md-end">
                    <p><strong>Date:</strong> <?= $prescription['prescription_date'] ?></p>
                    <p><strong>Follow-up:</strong> <?= $prescription['follow_up_date'] ?? 'N/A' ?></p>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-12">
                    <h5>Diagnosis</h5>
                    <p><?= nl2br(htmlspecialchars($prescription['diagnosis'])) ?></p>
                </div>
            </div>

            <?php if(count($medicines) > 0): ?>
            <div class="row mb-4 default-table-area all-products">
                <div class="col-12 table-responsive">
                    <h5>Medicines</h5>
                    <table class="table table-bordered align-middle">
                        <thead>
                            <tr>
                                <th>Medicine</th>
                                <th>Dosage</th>
                                <th>Duration</th>
                                <th>Instructions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($medicines as $med): ?>
                            <tr>
                                <td><?= htmlspecialchars($med['name']) ?> (<?= $med['strength'] ?>)</td>
                                <td><?= $med['dosage'] ?></td>
                                <td><?= $med['duration'] ?></td>
                                <td><?= $med['instructions'] ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php endif; ?>

            <?php if(count($tests) > 0): ?>
            <div class="row mb-4 default-table-area all-products">
                <div class="col-12 table-responsive">
                    <h5>Tests</h5>
                    <table class="table table-bordered align-middle">
                        <thead>
                            <tr>
                                <th>Test</th>
                                <th>Instructions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($tests as $test): ?>
                            <tr>
                                <td><?= htmlspecialchars($test['name']) ?></td>
                                <td><?= $test['instructions'] ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php endif; ?>

            <?php if($prescription['notes']): ?>
            <div class="row">
                <div class="col-12">
                    <h5>Notes</h5>
                    <p><?= nl2br(htmlspecialchars($prescription['notes'])) ?></p>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>