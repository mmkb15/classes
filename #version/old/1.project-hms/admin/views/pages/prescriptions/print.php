<?php
require_once 'models/prescription.class.php';

$id = isset($_GET['id']) ? $_GET['id'] : 0;
$prescription = Prescription::readByID($id);
$medicines = Prescription::getMedicines($id);
$tests = Prescription::getTests($id);

if(!$prescription) {
    die("Prescription not found!");
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Prescription #<?= $id ?></title>
    <style>
        /* ========== RESET ========== */
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: Arial, sans-serif;
            background: #fff;
            padding: 30px;
            margin: 0;
        }
        .print-container {
            max-width: 850px;
            margin: 0 auto;
            background: #fff;
            padding: 30px 35px;
            border: 1px solid #ddd;
            border-radius: 6px;
        }

        /* ========== HEADER ========== */
        .header {
            text-align: center;
            border-bottom: 2px solid #1a5276;
            padding-bottom: 12px;
            margin-bottom: 18px;
        }
        .header h1 {
            font-size: 28px;
            color: #1a5276;
            margin: 0;
        }
        .header p {
            font-size: 14px;
            color: #555;
            margin: 5px 0 0;
        }

        /* ========== TITLE ========== */
        .prescription-title {
            text-align: center;
            font-size: 20px;
            font-weight: bold;
            color: #1a5276;
            margin: 10px 0 5px;
        }
        .prescription-meta {
            text-align: center;
            font-size: 14px;
            color: #555;
            margin-bottom: 18px;
        }

        /* ========== INFO TABLE ========== */
        .info-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 18px;
            font-size: 14px;
        }
        .info-table td {
            padding: 6px 10px;
            border-bottom: 1px dashed #ccc;
        }
        .info-table .label {
            font-weight: bold;
            width: 22%;
        }

        /* ========== SECTION TITLES ========== */
        .section-title {
            font-weight: bold;
            font-size: 16px;
            color: #1a5276;
            border-bottom: 1px solid #ccc;
            padding-bottom: 4px;
            margin-top: 22px;
            margin-bottom: 10px;
        }
        .diagnosis-text, .notes-text {
            background: #f8f9fa;
            padding: 12px 14px;
            border-radius: 4px;
            font-size: 14px;
            line-height: 1.7;
            white-space: pre-wrap;
            margin-bottom: 12px;
        }
        .notes-text {
            background: #fef9e7;
        }

        /* ========== TABLES ========== */
        .med-table, .test-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 18px;
            font-size: 14px;
        }
        .med-table th, .test-table th {
            background: #2c3e50;
            color: #fff;
            padding: 8px 12px;
            text-align: left;
        }
        .med-table td, .test-table td {
            padding: 8px 12px;
            border-bottom: 1px solid #e0e0e0;
        }
        .med-table tr:nth-child(even), .test-table tr:nth-child(even) {
            background: #f5f6f7;
        }
        .no-data {
            color: #999;
            font-style: italic;
            padding: 8px 12px;
        }

        /* ========== SIGNATURE ========== */
        .signature {
            display: flex;
            justify-content: space-between;
            margin-top: 40px;
            padding-top: 10px;
        }
        .signature div {
            text-align: center;
            width: 45%;
        }
        .signature hr {
            border: 1px solid #333;
            width: 80%;
            margin: 0 auto 5px;
        }
        .signature span {
            font-size: 12px;
            color: #555;
        }

        /* ========== FOOTER ========== */
        .footer {
            text-align: center;
            margin-top: 30px;
            border-top: 1px solid #ddd;
            padding-top: 14px;
            font-size: 12px;
            color: #777;
        }

        /* ========== PRINT BUTTONS ========== */
        .print-btn {
            text-align: center;
            margin: 25px 0 10px;
        }
        .print-btn button {
            padding: 10px 32px;
            font-size: 16px;
            cursor: pointer;
            background: #1a5276;
            color: #fff;
            border: none;
            border-radius: 4px;
            margin: 0 6px;
        }
        .print-btn button:hover {
            background: #0e3b54;
        }

        /* ========== PRINT STYLES ========== */
        @media print {
            body {
                padding: 10px;
                background: #fff;
            }
            .print-container {
                border: none;
                padding: 15px 20px;
                border-radius: 0;
            }
            .header h1 {
                font-size: 22px;
            }
            .med-table th, .test-table th {
                background: #333 !important;
                color: #fff !important;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
            .med-table tr:nth-child(even), .test-table tr:nth-child(even) {
                background: #f0f0f0 !important;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
            .print-btn {
                display: none !important;
            }
            .signature hr {
                border: 1px solid #000 !important;
            }
        }
    </style>
</head>
<body>

<div class="print-container">
    <!-- ===== HEADER ===== -->
    <div class="header">
        <h1>🏥 City Hospital</h1>
        <p>123, Main Road, Dhaka | Phone: 02-1234567</p>
    </div>

    <!-- ===== TITLE ===== -->
    <div class="prescription-title">MEDICAL PRESCRIPTION</div>
    <div class="prescription-meta">
        Prescription #: <?= $id ?> &nbsp;|&nbsp; Date: <?= $prescription['prescription_date'] ?>
    </div>

    <!-- ===== PATIENT & DOCTOR INFO ===== -->
    <table class="info-table">
        <tr>
            <td class="label">Patient Name:</td>
            <td><?= htmlspecialchars($prescription['patient_name']) ?></td>
            <td class="label">Doctor:</td>
            <td><?= htmlspecialchars($prescription['doctor_name']) ?></td>
        </tr>
        <tr>
            <td class="label">Follow-up Date:</td>
            <td><?= $prescription['follow_up_date'] ?? 'N/A' ?></td>
            <td class="label">Prescription Date:</td>
            <td><?= $prescription['prescription_date'] ?></td>
        </tr>
    </table>

    <!-- ===== DIAGNOSIS ===== -->
    <div class="section-title">📋 Diagnosis</div>
    <div class="diagnosis-text"><?= nl2br(htmlspecialchars($prescription['diagnosis'])) ?></div>

    <!-- ===== MEDICINES ===== -->
    <div class="section-title">💊 Medicines</div>
    <?php if(count($medicines) > 0): ?>
    <table class="med-table">
        <thead>
            <tr><th>Medicine</th><th>Dosage</th><th>Duration</th><th>Instructions</th></tr>
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
    <?php else: ?>
    <p class="no-data">No medicines prescribed.</p>
    <?php endif; ?>

    <!-- ===== TESTS ===== -->
    <div class="section-title">🔬 Tests</div>
    <?php if(count($tests) > 0): ?>
    <table class="test-table">
        <thead>
            <tr><th>Test Name</th><th>Instructions</th></tr>
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
    <?php else: ?>
    <p class="no-data">No tests advised.</p>
    <?php endif; ?>

    <!-- ===== NOTES ===== -->
    <?php if(!empty($prescription['notes'])): ?>
    <div class="section-title">📝 Notes</div>
    <div class="notes-text"><?= nl2br(htmlspecialchars($prescription['notes'])) ?></div>
    <?php endif; ?>

    <!-- ===== SIGNATURE ===== -->
    <div class="signature">
        <div><hr><span>Doctor's Signature</span></div>
        <div><hr><span>Patient's Signature</span></div>
    </div>

    <!-- ===== FOOTER ===== -->
    <div class="footer">
        <p>This is a computer-generated prescription. Valid without signature.</p>
        <br>
        <p &copy; <?= date('Y') ?> | All Rights Reserved. Developed by 
        <strong class="text-primary">Mustafa Mursalin Khan (1295365)</strong> 
        (WDPF Round-70) as an assignment of 
        <strong>ISDB-BISEW IT Scholarship Programme</strong>.</p>
    </div>
</div>

<!-- ===== PRINT BUTTONS ===== -->
<div class="print-btn">
    <button onclick="window.print()">🖨️ Print Prescription</button>
    <button onclick="window.close()">Close</button>
</div>

</body>
</html>