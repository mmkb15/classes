<?php
require_once 'models/billing.class.php';
require_once 'models/patient.class.php';

$id = isset($_GET['id']) ? $_GET['id'] : 0;
$bill = Billing::readByID($id);

if(!$bill) {
    echo "<div class='alert alert-danger'>Bill not found! <a href='?page=billings/manage'>Go Back</a></div>";
    exit;
}
?>

<div class="main-content-container overflow-hidden">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
        <h3 class="mb-0">Bill Details</h3>
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb align-items-center mb-0 lh-1">
                <li class="breadcrumb-item">
                    <a href="?page=dashboard" class="d-flex align-items-center text-decoration-none">
                        <i class="ri-home-4-line fs-18 text-primary me-1"></i>
                        <span class="text-secondary fw-medium hover">Dashboard</span>
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    <span class="fw-medium">Billings</span>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    <span class="fw-medium">View Bill #<?= $id ?></span>
                </li>
            </ol>
        </nav>
    </div>

    <div class="card bg-white border-0 rounded-3 mb-4">
        <div class="card-body custom-padding-30">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
                <h4 class="fs-18 fw-semibold mb-0">Invoice #<?= $id ?></h4>
                <div class="d-flex gap-2">
                    <a href="?page=billings/print&id=<?= $id ?>" target="_blank" class="btn btn-success py-2 px-4 fw-medium fs-14">
                        <i class="material-symbols-outlined fs-18 me-1">print</i> Print
                    </a>
                    <a href="?page=billings/manage" class="btn btn-secondary py-2 px-4 fw-medium fs-14">
                        <i class="material-symbols-outlined fs-18 me-1">arrow_back</i> Back
                    </a>
                </div>
            </div>

            <div class="border-bottom mb-4"></div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label class="label text-secondary fs-14 fw-semibold">Bill ID</label>
                        <p class="fs-14 text-secondary">#<?= $bill['id'] ?></p>
                    </div>
                    <div class="form-group mb-3">
                        <label class="label text-secondary fs-14 fw-semibold">Patient</label>
                        <p class="fs-14 text-secondary"><?= htmlspecialchars($bill['patient_name']) ?></p>
                    </div>
                    <div class="form-group mb-3">
                        <label class="label text-secondary fs-14 fw-semibold">Amount</label>
                        <p class="fs-14 text-secondary fw-bold"><?= number_format($bill['amount'], 2) ?> BDT</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label class="label text-secondary fs-14 fw-semibold">Bill Date</label>
                        <p class="fs-14 text-secondary"><?= date('d M, Y', strtotime($bill['bill_date'])) ?></p>
                    </div>
                    <div class="form-group mb-3">
                        <label class="label text-secondary fs-14 fw-semibold">Admission ID</label>
                        <p class="fs-14 text-secondary"><?= $bill['admission_id'] ?? 'N/A' ?></p>
                    </div>
                    <div class="form-group mb-3">
                        <label class="label text-secondary fs-14 fw-semibold">Description</label>
                        <p class="fs-14 text-secondary"><?= htmlspecialchars($bill['description'] ?? 'N/A') ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>