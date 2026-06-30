<?php
require_once 'models/billing.class.php';
require_once 'models/patient.class.php';

$patients = Patient::readAll();
$breakdown = null;
$patient_name = '';

/**
 * If patient selected, calculate bill
 */
if(isset($_GET['patient_id']) && !empty($_GET['patient_id'])) {
    $patient_id = $_GET['patient_id'];
    $breakdown = Billing::calculatePatientBill($patient_id);
    $patient = Patient::readByID($patient_id);
    $patient_name = $patient['name'] ?? '';
}

/**
 * Handle form submission to save bill
 */
if(isset($_POST['btn-submit'])){
    $patient_id = $_POST['patient_id'];
    $amount = $_POST['amount'];
    $bill_date = $_POST['bill_date'];
    $description = $_POST['description'];
    $admission_id = $_POST['admission_id'] ?? null;

    $billing = new Billing(null, $patient_id, $admission_id, $amount, $bill_date, $description);
    $res = $billing->create();

    if($res === true){
        $msg = "Bill generated successfully!";
    } else {
        $msg = $res;
    }
}
?>

<div class="main-content-container overflow-hidden">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
        <h3 class="mb-0">Generate Bill</h3>
    </div>

    <?php if(isset($msg)): ?>
    <div class="alert <?= (strpos($msg, 'success') !== false) ? 'alert-success' : 'alert-danger' ?> alert-dismissible fade show" role="alert">
        <?= $msg ?>
        <a href="?page=billings/manage" class="alert-link">Go to List</a>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    <?php endif; ?>

    <div class="card bg-white border-0 rounded-3 mb-4">
        <div class="card-body p-20">
            <!-- Patient Selection Form -->
            <form method="GET" action="" id="patientSelectForm">
                <div class="row">
                    <div class="col-lg-8 col-sm-12">
                        <div class="form-group mb-4">
                            <label class="label text-secondary">Select Patient</label>
                            <select class="form-control h-60 border-border-color" name="patient_id" id="patientDropdown">
                                <option value="">-- Select Patient --</option>
                                <?php foreach($patients as $patient): ?>
                                    <option value="<?= $patient['id'] ?>" <?= (isset($_GET['patient_id']) && $_GET['patient_id'] == $patient['id']) ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($patient['name']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-12">
                        <div class="form-group mb-4">
                            <label class="label text-secondary" style="visibility:hidden;">.</label>
                            <button type="button" class="btn btn-primary h-60 w-100" id="calculateBtn">Calculate Bill</button>
                        </div>
                    </div>
                </div>
            </form>

            <!-- Bill Breakdown (if calculated) -->
            <?php if($breakdown !== null): ?>
            <div class="mt-4">
                <h4>Bill for <strong><?= htmlspecialchars($patient_name) ?></strong></h4>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Item</th>
                                <th>Details</th>
                                <th>Amount (BDT)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><strong>Admission</strong></td>
                                <td>
                                    <?php if(isset($breakdown['admission_details'])): ?>
                                        Room: <?= $breakdown['admission_details']['room'] ?? 'N/A' ?><br>
                                        Days: <?= $breakdown['admission_details']['days'] ?? 0 ?> x <?= $breakdown['admission_details']['rate_per_day'] ?? 0 ?>
                                    <?php else: ?>
                                        No active admission
                                    <?php endif; ?>
                                </td>
                                <td><?= $breakdown['admission'] ?? 0 ?></td>
                            </tr>
                            <tr>
                                <td><strong>Medicines</strong></td>
                                <td>From all prescriptions</td>
                                <td><?= $breakdown['medicines'] ?? 0 ?></td>
                            </tr>
                            <tr>
                                <td><strong>Tests</strong></td>
                                <td>From all prescriptions</td>
                                <td><?= $breakdown['tests'] ?? 0 ?></td>
                            </tr>
                            <tr class="table-success">
                                <th colspan="2" class="text-end">Total Amount</th>
                                <th><?= $breakdown['total'] ?? 0 ?></th>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Form to save bill -->
                <form method="POST" class="mt-3">
                    <input type="hidden" name="patient_id" value="<?= $_GET['patient_id'] ?? '' ?>">
                    <input type="hidden" name="amount" value="<?= $breakdown['total'] ?? 0 ?>">
                    <input type="hidden" name="admission_id" value="<?= $breakdown['admission_details']['admission_id'] ?? '' ?>">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group mb-3">
                                <label class="label text-secondary">Bill Date</label>
                                <input type="date" name="bill_date" class="form-control h-60" value="<?= date('Y-m-d') ?>" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-3">
                                <label class="label text-secondary">Description (Optional)</label>
                                <input type="text" name="description" class="form-control h-60" placeholder="e.g., Full treatment bill">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <button type="submit" name="btn-submit" class="btn btn-success py-2 px-4 fw-medium fs-16">
                                <i class="ri-check-line"></i> Confirm & Generate Bill
                            </button>
                            <a href="?page=billings/manage" class="btn btn-secondary py-2 px-4 fw-medium fs-16">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<script>
document.getElementById('calculateBtn').addEventListener('click', function() {
    var dropdown = document.getElementById('patientDropdown');
    var patientId = dropdown.value;
    if(patientId) {
        window.location.href = '?page=billings/create&patient_id=' + patientId;
    } else {
        alert('Please select a patient first!');
    }
});

// Auto-submit on dropdown change (optional)
document.getElementById('patientDropdown').addEventListener('change', function() {
    var patientId = this.value;
    if(patientId) {
        window.location.href = '?page=billings/create&patient_id=' + patientId;
    }
});
</script>