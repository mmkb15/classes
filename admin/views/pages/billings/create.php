<?php
require_once 'models/billing.class.php';
require_once 'models/patient.class.php';

$patients = Patient::readAll();
$breakdown = null;
$patient_name = '';

if(isset($_GET['patient_id']) && !empty($_GET['patient_id'])) {
    $patient_id = $_GET['patient_id'];
    $breakdown = Billing::calculatePatientBill($patient_id);
    $patient = Patient::readByID($patient_id);
    $patient_name = $patient['name'] ?? '';
}

if(isset($_POST['btn-submit'])){
    $patient_id = $_POST['patient_id'];
    $amount = $_POST['amount'];
    $bill_date = $_POST['bill_date'];
    $description = $_POST['description'];
    $admission_id = isset($_POST['admission_id']) && !empty($_POST['admission_id']) ? $_POST['admission_id'] : null;

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
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb align-items-center mb-0 lh-1">
                <li class="breadcrumb-item">
                    <a href="?page=dashboard" class="d-flex align-items-center text-decoration-none">
                        <i class="ri-home-4-line fs-18 text-primary me-1"></i>
                        <span class="text-secondary fw-medium hover">Dashboard</span>
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    <span class="fw-medium">Billing</span>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    <span class="fw-medium">Generate Bill</span>
                </li>
            </ol>
        </nav>
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


            <!-- ==========================================
            PATIENT SELECTION (No Button)
            ========================================== -->
            <div class="row">
                <div class="col-lg-12 col-sm-12">
                    <div class="form-group mb-4">
                        <label class="label text-secondary fw-semibold fs-14">Select Patient</label>
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
            </div>

            <!-- ==========================================
            BILL BREAKDOWN (if calculated)
            ========================================== -->
            <?php if($breakdown !== null): ?>
            <div class="mt-4 pt-2 border-top">
                <div class="d-flex align-items-center gap-2 mb-4">
                    <i class="material-symbols-outlined fs-24 text-primary">receipt_long</i>
                    <h4 class="mb-0 fs-18 fw-semibold">Bill for <span class="text-primary"><?= htmlspecialchars($patient_name) ?></span></h4>
                </div>

                <div class="row d-flex align-items-stretch">
                    <!-- ===== ADMISSION CARD ===== -->
                    <div class="col-md-4 col-sm-12">
                        <div class="card bg-white border-0 rounded-3 mb-4 shadow-sm">
                            <div class="card-body p-3">
                                <div class="d-flex align-items-center gap-2 mb-2">
                                    <i class="material-symbols-outlined fs-20 text-primary">bed</i>
                                    <h6 class="mb-0 fs-14 fw-semibold">Admission Charges</h6>
                                </div>
                                <?php if(isset($breakdown['admission_details'])): ?>
                                    <p class="mb-1 fs-14 text-secondary">Room: <strong><?= $breakdown['admission_details']['room'] ?? 'N/A' ?></strong></p>
                                    <p class="mb-2 fs-14 text-secondary"><?= $breakdown['admission_details']['days'] ?? 0 ?> days × <?= number_format($breakdown['admission_details']['rate_per_day'] ?? 0, 2) ?></p>
                                    <p class="mb-0 fw-bold fs-16 text-primary"><?= number_format($breakdown['admission'], 2) ?> BDT</p>
                                <?php else: ?>
                                    <p class="text-muted mb-0 fs-14">No active admission</p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <!-- ===== MEDICINES CARD ===== -->
                    <div class="col-md-4 col-sm-12">
                        <div class="card bg-white border-0 rounded-3 mb-4 shadow-sm">
                            <div class="card-body p-3">
                                <div class="d-flex align-items-center gap-2 mb-2">
                                    <i class="material-symbols-outlined fs-20 text-success">vaccines</i>
                                    <h6 class="mb-0 fs-14 fw-semibold">Medicines</h6>
                                </div>
                                <div id="medicinesList">
                                    <ul class="list-unstyled mb-2" id="medicinesShort">
                                        <?php if(count($breakdown['medicines_list'] ?? []) > 0): ?>
                                            <?php $i = 0; foreach($breakdown['medicines_list'] as $med): ?>
                                                <?php if($i < 3): ?>
                                                    <li class="fs-14 text-secondary">• <?= htmlspecialchars($med['name'] ?? '') ?> (<?= $med['strength'] ?? '' ?>)</li>
                                                <?php else: ?>
                                                    <li class="fs-14 text-secondary d-none medicine-item">• <?= htmlspecialchars($med['name'] ?? '') ?> (<?= $med['strength'] ?? '' ?>)</li>
                                                <?php endif; ?>
                                            <?php $i++; endforeach; ?>
                                            <?php if(count($breakdown['medicines_list']) > 3): ?>
                                                <li>
                                                    <button type="button" class="btn btn-link p-0 fs-14 fw-medium text-primary" id="toggleMedicinesBtn">
                                                        View All (<?= count($breakdown['medicines_list']) - 3 ?> more)
                                                    </button>
                                                </li>
                                            <?php endif; ?>
                                        <?php else: ?>
                                            <p class="text-muted mb-0 fs-14">No medicines prescribed</p>
                                        <?php endif; ?>
                                    </ul>
                                    <ul class="list-unstyled mb-2 d-none" id="medicinesFull">
                                        <?php if(count($breakdown['medicines_list'] ?? []) > 0): ?>
                                            <?php foreach($breakdown['medicines_list'] as $med): ?>
                                                <li class="fs-14 text-secondary">• <?= htmlspecialchars($med['name'] ?? '') ?> (<?= $med['strength'] ?? '' ?>)</li>
                                            <?php endforeach; ?>
                                            <li>
                                                <button type="button" class="btn btn-link p-0 fs-14 fw-medium text-primary" id="hideMedicinesBtn">
                                                    Show Less
                                                </button>
                                            </li>
                                        <?php endif; ?>
                                    </ul>
                                </div>
                                <p class="mb-0 fw-bold fs-16 text-success"><?= number_format($breakdown['medicines'], 2) ?> BDT</p>
                            </div>
                        </div>
                    </div>

                    <!-- ===== TESTS CARD ===== -->
                    <div class="col-md-4 col-sm-12">
                        <div class="card bg-white border-0 rounded-3 mb-4 shadow-sm">
                            <div class="card-body p-3">
                                <div class="d-flex align-items-center gap-2 mb-2">
                                    <i class="material-symbols-outlined fs-20 text-info">science</i>
                                    <h6 class="mb-0 fs-14 fw-semibold">Tests</h6>
                                </div>
                                <div id="testsList">
                                    <ul class="list-unstyled mb-2" id="testsShort">
                                        <?php if(count($breakdown['tests_list'] ?? []) > 0): ?>
                                            <?php $i = 0; foreach($breakdown['tests_list'] as $test): ?>
                                                <?php if($i < 3): ?>
                                                    <li class="fs-14 text-secondary">• <?= htmlspecialchars($test['name'] ?? '') ?></li>
                                                <?php else: ?>
                                                    <li class="fs-14 text-secondary d-none test-item">• <?= htmlspecialchars($test['name'] ?? '') ?></li>
                                                <?php endif; ?>
                                            <?php $i++; endforeach; ?>
                                            <?php if(count($breakdown['tests_list']) > 3): ?>
                                                <li>
                                                    <button type="button" class="btn btn-link p-0 fs-14 fw-medium text-primary" id="toggleTestsBtn">
                                                        View All (<?= count($breakdown['tests_list']) - 3 ?> more)
                                                    </button>
                                                </li>
                                            <?php endif; ?>
                                        <?php else: ?>
                                            <p class="text-muted mb-0 fs-14">No tests advised</p>
                                        <?php endif; ?>
                                    </ul>
                                    <ul class="list-unstyled mb-2 d-none" id="testsFull">
                                        <?php if(count($breakdown['tests_list'] ?? []) > 0): ?>
                                            <?php foreach($breakdown['tests_list'] as $test): ?>
                                                <li class="fs-14 text-secondary">• <?= htmlspecialchars($test['name'] ?? '') ?></li>
                                            <?php endforeach; ?>
                                            <li>
                                                <button type="button" class="btn btn-link p-0 fs-14 fw-medium text-primary" id="hideTestsBtn">
                                                    Show Less
                                                </button>
                                            </li>
                                        <?php endif; ?>
                                    </ul>
                                </div>
                                <p class="mb-0 fw-bold fs-16 text-info"><?= number_format($breakdown['tests'], 2) ?> BDT</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total -->
                <div class="alert alert-primary bg-primary bg-opacity-10 border-0 rounded-3 d-flex justify-content-between align-items-center mt-2">
                    <span class="fs-16 fw-semibold"> Total</span>
                    <span class="fs-20 fw-bold text-primary"><?= number_format($breakdown['total'] ?? 0, 2) ?> BDT</span>
                </div>

                <!-- ==========================================
                CONFIRM & GENERATE FORM
                ========================================== -->
                <form method="POST" class="mt-4 pt-2 border-top">
                    <input type="hidden" name="patient_id" value="<?= $_GET['patient_id'] ?? '' ?>">
                    <input type="hidden" name="amount" value="<?= $breakdown['total'] ?? 0 ?>">
                    <input type="hidden" name="admission_id" value="<?= isset($breakdown['admission_details']['admission_id']) ? $breakdown['admission_details']['admission_id'] : '' ?>">
                    
                    <div class="row">
                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group mb-3">
                                <label class="label text-secondary fw-semibold">Bill Date</label>
                                <input type="date" name="bill_date" class="form-control h-60 border-border-color" value="<?= date('Y-m-d') ?>" required>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group mb-3">
                                <label class="label text-secondary fw-semibold">Description (Optional)</label>
                                <input type="text" name="description" class="form-control h-60 border-border-color" placeholder="e.g., Full treatment bill">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="d-flex flex-wrap gap-3">
                                <button type="submit" name="btn-submit" class="btn btn-primary py-2 px-4 fw-medium fs-16">
                                    <i class="material-symbols-outlined fs-18 me-1" style="vertical-align: middle;">check</i> Confirm & Generate Bill
                                </button>
                                <a href="?page=billings/manage" class="btn btn-secondary py-2 px-4 fw-medium fs-16">
                                    <i class="material-symbols-outlined fs-18 me-1" style="vertical-align: middle;">close</i> Cancel
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<script>
// Patient selection dropdown
// Auto-submit on dropdown change
document.getElementById('patientDropdown').addEventListener('change', function() {
    var patientId = this.value;
    if (patientId) {
        window.location.href = '?page=billings/create&patient_id=' + patientId;
    }
});


// =============================================
// TOGGLE MEDICINES (View All / Show Less)
// =============================================
const toggleMedicinesBtn = document.getElementById('toggleMedicinesBtn');
const hideMedicinesBtn = document.getElementById('hideMedicinesBtn');
const medicinesShort = document.getElementById('medicinesShort');
const medicinesFull = document.getElementById('medicinesFull');

if (toggleMedicinesBtn) {
    toggleMedicinesBtn.addEventListener('click', function() {
        medicinesShort.classList.add('d-none');
        medicinesFull.classList.remove('d-none');
    });
}

if (hideMedicinesBtn) {
    hideMedicinesBtn.addEventListener('click', function() {
        medicinesFull.classList.add('d-none');
        medicinesShort.classList.remove('d-none');
    });
}

// =============================================
// TOGGLE TESTS (View All / Show Less)
// =============================================
const toggleTestsBtn = document.getElementById('toggleTestsBtn');
const hideTestsBtn = document.getElementById('hideTestsBtn');
const testsShort = document.getElementById('testsShort');
const testsFull = document.getElementById('testsFull');

if (toggleTestsBtn) {
    toggleTestsBtn.addEventListener('click', function() {
        testsShort.classList.add('d-none');
        testsFull.classList.remove('d-none');
    });
}

if (hideTestsBtn) {
    hideTestsBtn.addEventListener('click', function() {
        testsFull.classList.add('d-none');
        testsShort.classList.remove('d-none');
    });
}
</script>