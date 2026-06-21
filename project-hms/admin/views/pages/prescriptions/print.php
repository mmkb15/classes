<?php
require_once 'models/prescription.class.php';
require_once 'models/doctor.class.php';
require_once 'models/patient.class.php';
require_once 'models/appointment.class.php';

$id = isset($_GET['id']) ? $_GET['id'] : 0;
$prescription = Prescription::readByID($id);
$medicines = Prescription::getMedicines($id);
$tests = Prescription::getTests($id);

if(!$prescription) {
    die("Prescription not found!");
}

// Get all related data dynamically
$doctor = Doctor::readByID($prescription['doctor_id']);
$patient = Patient::readByID($prescription['patient_id']);
$appointment = Appointment::readByID($prescription['appointment_id']);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Prescription #<?= $id ?></title>
    <style>
        /* ============================================
           PRESCRIPTION PRINT STYLES
           ============================================ */
        body {
            font-family: 'Arial', sans-serif;
            background: #f0f2f5;
            padding: 30px;
            margin: 0;
        }
        .print-container {
            max-width: 900px;
            margin: 0 auto;
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 8px 30px rgba(0,0,0,0.12);
            overflow: hidden;
        }
        .main-content-container {
            padding: 20px 25px;
        }
        .d-flex { display: flex; }
        .justify-content-between { justify-content: space-between; }
        .align-items-center { align-items: center; }
        .flex-wrap { flex-wrap: wrap; }
        .gap-2 { gap: 8px; }
        .mb-0 { margin-bottom: 0; }
        .mb-1 { margin-bottom: 4px; }
        .mb-2 { margin-bottom: 8px; }
        .mb-4 { margin-bottom: 16px; }
        .mb-20 { margin-bottom: 20px; }
        .mt-3 { margin-top: 12px; }
        .mt-4 { margin-top: 16px; }
        .ms-10 { margin-left: 10px; }
        .ms-auto { margin-left: auto; }
        .pe-5 { padding-right: 48px; }
        .pt-4 { padding-top: 16px; }
        .pb-0 { padding-bottom: 0; }
        .border-bottom { border-bottom: 1px solid #e0e0e0; }
        .border-border-color-50 { border-color: #e0e0e0 !important; }
        .rounded-3 { border-radius: 6px; }
        .text-secondary { color: #2c3e50; }
        .text-body-color-50 { color: #7f8c8d; }
        .text-body-color-60 { color: #95a5a6; }
        .fs-12 { font-size: 12px; }
        .fs-14 { font-size: 14px; }
        .fs-16 { font-size: 16px; }
        .fs-20 { font-size: 20px; }
        .fw-medium { font-weight: 500; }
        .fw-semibold { font-weight: 600; }
        .fw-bold { font-weight: 700; }
        .d-block { display: block; }
        .list-unstyled { list-style: none; padding-left: 0; }
        .ps-0 { padding-left: 0; }
        .bg-body-bg { background-color: #f8f9fa; }
        .text-body { color: #2c3e50; }
        .rounded-circle { border-radius: 50%; }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            font-weight: 600;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            text-decoration: none;
        }
        .btn-primary { background: #1a5276; color: #fff; }
        .btn-primary:hover { background: #0e3b54; }
        .custom-padding-30 { padding: 30px; }
        .doctor-filter-img { max-width: 100%; height: auto; }
        .table { width: 100%; border-collapse: collapse; }
        .table th, .table td { padding: 12px 16px; text-align: left; border-bottom: 1px solid #e0e0e0; }
        .table thead th { background: #f8f9fa; font-weight: 600; font-size: 14px; color: #2c3e50; }
        .table tbody tr:last-child td { border-bottom: none; }
        .bg-white { background: #fff; }
        .border-0 { border: 0; }
        .type-prescription .table td { padding-top: 16px; padding-bottom: 16px; }

        /* ============================================
           PRINT BUTTONS
           ============================================ */
        .print-btn {
            text-align: center;
            padding: 20px 0 30px;
            background: #f8f9fa;
            border-radius: 0 0 12px 12px;
        }
        .print-btn button {
            padding: 12px 36px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            background: #1a5276;
            color: #fff;
            border: none;
            border-radius: 6px;
            margin: 0 8px;
            transition: background 0.3s;
        }
        .print-btn button:hover { background: #0e3b54; }
        .print-btn button.btn-pdf { background: #c0392b; }
        .print-btn button.btn-pdf:hover { background: #922b21; }
        .print-btn button.btn-close { background: #95a5a6; }
        .print-btn button.btn-close:hover { background: #7f8c8d; }

        @media print {
            body { background: #fff !important; padding: 0; margin: 0; }
            .print-container { box-shadow: none; border-radius: 0; max-width: 100%; }
            .main-content-container { padding: 15px 20px; }
            .print-btn { display: none !important; }
            .bg-body-bg { background: #f5f5f5 !important; -webkit-print-color-adjust: exact; print-color-adjust: exact; }
            .table thead th { background: #f5f5f5 !important; -webkit-print-color-adjust: exact; print-color-adjust: exact; }
        }
    </style>
</head>
<body>

<div class="print-container">
    <div class="main-content-container">

        <!-- ==========================================
        HEADER WITH DOWNLOAD PDF BUTTON
        ========================================== -->
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
            <h3 class="mb-0">Prescription</h3>
            <button class="btn btn-primary fs-16 fw-medium px-3" onclick="window.print()">
                Download PDF
            </button>
        </div>

        <!-- ==========================================
        PRESCRIPTION CARD
        ========================================== -->
        <div class="card bg-white border-0 rounded-3 mb-4">

            <!-- ==========================================
            DOCTOR INFO - DYNAMIC
            ========================================== -->
            <div class="card-body custom-padding-30" style="padding-top: 35px; padding-bottom: 26px;">
                <div class="d-flex flex-wrap gap-2 justify-content-between">
                    <div>
                        <h3 class="fs-20 fw-semibold"><?= htmlspecialchars($prescription['doctor_name']) ?></h3>
                        <span class="fs-16 text-secondary">Phone: <?= htmlspecialchars($doctor['phone'] ?? 'N/A') ?></span>
                    </div>
                    <div>
                        <img src="assets/images/logo-icon.png" class="mb-2" alt="HMS" style="max-width:150px;">
                        <span class="fs-16 d-block text-body-color-50 mb-1"><b>City Hospital</b></span>
                        <span class="fs-16 d-block text-body-color-50 mb-1">123, Main Road, Dhaka</span>
                        <span class="fs-16 text-body-color-50">+880 1234 567890</span>
                    </div>
                </div>
            </div>

            <div class="border-bottom"></div>



            <!-- ==========================================
            PATIENT INFO - DYNAMIC (with phone)
            ========================================== -->
            <div class="card-body custom-padding-30 pt-4 pb-0">
                <div class="d-flex flex-wrap gap-2 justify-content-between" style="margin-bottom: 50px;">
                    <ul class="ps-0 mb-0 list-unstyled last-child-none">
                    <?php if($appointment): ?>
                        <li><p>Appointment #: <span class="text-secondary"><?= $appointment['id'] ?></span></p></li>
                    <?php endif; ?>
                        <li><p>Name: <span class="text-secondary"><?= htmlspecialchars($prescription['patient_name']) ?></span></p></li>
                        <li><p>Phone: <span class="text-secondary"><?= htmlspecialchars($patient['phone'] ?? 'N/A') ?></span></p></li>
                        <li><p>Address: <span class="text-secondary"><?= htmlspecialchars($patient['address'] ?? 'N/A') ?></span></p></li>
                    </ul>
                    <div class="text-end">
                        <p class="mb-1 fs-14 fw-semibold text-secondary">
                            Prescription Date: <?= date('d M, Y', strtotime($prescription['prescription_date'])) ?>
                        </p>
                        <p class="mb-0 fs-14 fw-semibold text-secondary">
                            Follow-up Date: <?= !empty($prescription['follow_up_date']) ? date('d M, Y', strtotime($prescription['follow_up_date'])) : 'N/A' ?>
                        </p>
                    </div>
                </div>
            </div>

 

            <!-- ==========================================
            MEDICINES TABLE - DYNAMIC
            ========================================== -->
            <div class="default-table-area style-three style-two type-prescription" style="margin: 50px 0; ">
                <div class="table-responsive">
                    <table class="table border-0">
                        <thead>
                            <tr>
                                <th scope="col" class="bg-body-bg" style="padding-top: 10px; padding-bottom: 10px;">
                                    <span class="fs-14 fw-medium text-body">Medicine Name</span>
                                </th>
                                <th scope="col" class="bg-body-bg" style="padding-top: 10px; padding-bottom: 10px;">
                                    <span class="fs-14 fw-medium text-body">Dosage</span>
                                </th>
                                <th scope="col" class="bg-body-bg" style="padding-top: 10px; padding-bottom: 10px;">
                                    <span class="fs-14 fw-medium text-body">Duration</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(count($medicines) > 0): ?>
                                <?php $serial = 1; foreach($medicines as $med): ?>
                                <tr>
                                    <td>
                                        <span class="fs-14 fw-semibold text-secondary">
                                            <?= $serial++ ?>. <?= htmlspecialchars($med['name']) ?> (<?= $med['strength'] ?>)
                                        </span>
                                    </td>
                                    <td>
                                        <span class="fs-14 fw-semibold text-secondary d-block"><?= htmlspecialchars($med['dosage']) ?></span>
                                        <?php if(!empty($med['instructions'])): ?>
                                        <span class="fs-12 text-secondary">(<?= htmlspecialchars($med['instructions']) ?>)</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <span class="fs-14 fw-semibold text-secondary d-block"><?= htmlspecialchars($med['duration']) ?></span>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="3" class="text-center text-secondary">No medicines prescribed.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- ==========================================
            TESTS TABLE - DYNAMIC (if any)
            ========================================== -->
            <?php if(count($tests) > 0): ?>
            <div class="default-table-area style-three style-two type-prescription">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col" class="bg-body-bg" style="padding-top: 10px; padding-bottom: 10px;">
                                    <span class="fs-14 fw-medium text-body">Test Name</span>
                                </th>
                                <th scope="col" class="bg-body-bg" style="padding-top: 10px; padding-bottom: 10px;">
                                    <span class="fs-14 fw-medium text-body">Instructions</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $serial = 1; foreach($tests as $test): ?>
                            <tr>
                                <td>
                                    <span class="fs-14 fw-semibold text-secondary">
                                        <?= $serial++ ?>. <?= htmlspecialchars($test['name']) ?>
                                    </span>
                                </td>
                                <td>
                                    <span class="fs-14 text-secondary"><?= htmlspecialchars($test['instructions']) ?></span>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php endif; ?>

            <div class="border-bottom"></div>

            <!-- ==========================================
            ADVICE & SIGNATURE - DYNAMIC (Diagnosis & Notes)
            ========================================== -->
            <div class="card-body custom-padding-30 pt-4" >
                <div>
                    <h3 class="fs-14 text-secondary fw-normal">Advice Given:</h3>
                    <ul class="ps-0 mb-0 list-unstyled last-child-none">
                        <?php if(!empty($prescription['diagnosis'])): ?>
                        <li class="d-flex">
                            <div class="flex-shrink-0">
                                <span style="width: 5px; height: 5px; background-color: #B1BBC8;" class="rounded-circle d-inline-block"></span>
                            </div>
                            <div class="flex-grow-1 ms-10">
                                <p class="mb-0"><strong>Diagnosis:</strong> <?= nl2br(htmlspecialchars($prescription['diagnosis'])) ?></p>
                            </div>
                        </li>
                        <?php endif; ?>
                        <?php if(!empty($prescription['notes'])): ?>
                        <li class="d-flex">
                            <div class="flex-shrink-0">
                                <span style="width: 5px; height: 5px; background-color: #B1BBC8;" class="rounded-circle d-inline-block"></span>
                            </div>
                            <div class="flex-grow-1 ms-10">
                                <p class="mb-0"><?= nl2br(htmlspecialchars($prescription['notes'])) ?></p>
                            </div>
                        </li>
                        <?php endif; ?>
                        <?php if(empty($prescription['diagnosis']) && empty($prescription['notes'])): ?>
                        <li class="d-flex">
                            <div class="flex-shrink-0">
                                <span style="width: 5px; height: 5px; background-color: #B1BBC8;" class="rounded-circle d-inline-block"></span>
                            </div>
                            <div class="flex-grow-1 ms-10">
                                <p class="mb-0">No advice given.</p>
                            </div>
                        </li>
                        <?php endif; ?>
                    </ul>
                </div>

                <!-- Signature Section -->
                <div class="ms-auto mt-3 mt-sm-0" style="max-width: 227px; margin-top:80px;">
                    <div class="border-bottom mb-4 pb-1 text-center border-border-color-50">
                    </div>
                    <h3 class="fs-14 fw-semibold"><?= htmlspecialchars($prescription['doctor_name']) ?></h3>
                </div>
            </div>
        </div>

        <!-- ==========================================
        FOOTER - DYNAMIC YEAR & NAME
        ========================================== -->
        <div class="text-center mt-4 pt-3 border-top" style="font-size: 12px; color: #999; text-align:center">
            <p>&copy; <?= date('Y') ?> | All Rights Reserved. Developed by 
            <strong>Mustafa Mursalin Khan (1295365)</strong> 
            (WDPF Round-70) as an assignment of 
            <strong>ISDB-BISEW IT Scholarship Programme</strong>.</p>
        </div>
    </div>
</div>

<!-- ==========================================
PRINT BUTTONS
========================================== -->
<div class="print-btn">
    <button onclick="window.print()">🖶 Print Prescription</button>
    <button class="btn-close" onclick="window.close()">✖ Close</button>
    
    
</div>

</body>
</html>