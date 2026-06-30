<?php
require_once 'models/billing.class.php';
require_once 'models/patient.class.php';

/**
 * Get bill ID from URL
 */
$id = isset($_GET['id']) ? $_GET['id'] : 0;
$row = Billing::readByID($id);

if(!$row) {
    echo "<div class='alert alert-danger'>Bill not found! <a href='?page=billings/manage'>Go Back</a></div>";
    exit;
}

/**
 * Get all patients for dropdown
 */
$patients = Patient::readAll();

/**
 * Handle Form Submission
 */
if(isset($_POST['btn-submit'])){
    $patient_id = $_POST['patient_id'];
    $admission_id = $_POST['admission_id'] ?? null;
    $amount = $_POST['amount'];
    $bill_date = $_POST['bill_date'];
    $description = $_POST['description'];

    $billing = new Billing($id, $patient_id, $admission_id, $amount, $bill_date, $description);
    $res = $billing->update();

    if($res === true){
        $msg = "Bill updated successfully!";
        $row = Billing::readByID($id); // Reload data
    } else {
        $msg = $res;
    }
}
?>

<div class="main-content-container overflow-hidden">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
        <h3 class="mb-0">Edit Bill</h3>
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
            <form method="POST">
                <div class="row">
                    <div class="col-lg-6 col-sm-12">
                        <div class="form-group mb-4">
                            <label class="label text-secondary">Patient</label>
                            <select class="form-control h-60 border-border-color" name="patient_id" required>
                                <option value="">Select Patient</option>
                                <?php foreach($patients as $patient): ?>
                                    <option value="<?= $patient['id'] ?>" <?= ($patient['id'] == $row['patient_id']) ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($patient['name']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <div class="form-group mb-4">
                            <label class="label text-secondary">Admission ID (Optional)</label>
                            <input type="number" name="admission_id" class="form-control h-60 border-border-color" value="<?= $row['admission_id'] ?>" placeholder="Leave empty if OPD">
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <div class="form-group mb-4">
                            <label class="label text-secondary">Amount (BDT)</label>
                            <input type="number" step="0.01" name="amount" class="form-control h-60 border-border-color" value="<?= $row['amount'] ?>" required>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <div class="form-group mb-4">
                            <label class="label text-secondary">Bill Date</label>
                            <input type="date" name="bill_date" class="form-control h-60 border-border-color" value="<?= $row['bill_date'] ?>" required>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group mb-4">
                            <label class="label text-secondary">Description</label>
                            <textarea name="description" rows="3" class="form-control"><?= htmlspecialchars($row['description']) ?></textarea>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="d-flex flex-wrap gap-3">
                            <button class="btn btn-primary py-2 px-4 fw-medium fs-16" type="submit" name="btn-submit">
                                <i class="ri-add-line text-white fw-medium"></i> Update Bill
                            </button>
                            <a href="?page=billings/manage" class="btn btn-secondary py-2 px-4 fw-medium fs-16">Cancel</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>