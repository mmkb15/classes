<?php
require_once 'models/billing.class.php';
require_once 'models/patient.class.php';

$id = isset($_GET['id']) ? $_GET['id'] : 0;
$bill = Billing::readByID($id);

if(!$bill) {
    die("Bill not found!");
}

$patient = Patient::readByID($bill['patient_id']);

// =============================================
// FETCH ITEMIZED DATA
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

if($admission) {
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
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice #<?= $id ?></title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: #f0f2f5;
            padding: 30px;
            margin: 0;
            color: #2c3e50;
        }
        .print-container {
            max-width: 900px;
            margin: 0 auto;
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 8px 30px rgba(0,0,0,0.12);
            overflow: hidden;
            padding: 40px 45px;
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #605DFF;
            padding-bottom: 15px;
            margin-bottom: 25px;
        }
        .header h1 {
            font-size: 28px;
            color: #605DFF;
            margin: 0;
            font-weight: 700;
        }
        .header h1 img {
            vertical-align: middle;
            max-width: 40px;
            margin-right: 8px;
        }
        .header p {
            font-size: 14px;
            color: #777;
            margin: 5px 0 0;
        }
        .bill-title {
            text-align: center;
            font-size: 20px;
            font-weight: 600;
            color: #605DFF;
            margin-bottom: 20px;
        }
        .info-section {
            margin-bottom: 25px;
        }
        .info-section .row {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
        }
        .info-section .col {
            flex: 1;
            min-width: 200px;
        }
        .info-section p {
            font-size: 14px;
            margin-bottom: 6px;
        }
        .info-section strong {
            color: #333;
        }
        .amount-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
            margin: 15px 0 20px;
        }
        .amount-table th {
            background: #605DFF;
            color: #fff;
            padding: 10px 14px;
            text-align: left;
            font-weight: 600;
        }
        .amount-table th:last-child {
            text-align: right;
        }
        .amount-table td {
            padding: 10px 14px;
            border-bottom: 1px solid #e0e0e0;
        }
        .amount-table td:last-child {
            text-align: right;
        }
        .amount-table .section-header td {
            background: #f0f4f85c;
            font-weight: 600;
            color: #605DFF;
            text-align: left;
        }
        .amount-table .section-header td:last-child {
            text-align: right;
        }
        .amount-table .sub-total td {
            font-weight: 600;
            border-top: 1px solid #ccc;
        }
        .amount-table .sub-total td:last-child {
            font-weight: 700;
        }
        .amount-table .total-row td {
            border-top: 2px solid rgb(169 169 169 / 89%);
            font-weight: 700;
            font-size: 16px;
            padding-top: 12px;
        }
        .amount-table .total-row td:last-child {
            font-size: 18px;
        }
        .signature {
            display: flex;
            justify-content: space-between;
            margin: 40px 0 20px;
        }
        .signature div {
            text-align: center;
            width: 45%;
        }
        .signature hr {
            width: 80%;
            margin: 0 auto 6px;
        }
        .signature span {
            font-size: 12px;
            color: #555;
        }
        .footer {
            text-align: center;
            border-top: 1px solid #ddd;
            padding-top: 15px;
            font-size: 12px;
            color: #999;
            margin-top: 10px;
        }
        .print-btn {
            text-align: center;
            padding: 20px 0 10px;
        }
        .print-btn button {
            padding: 12px 36px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            background: #605DFF;
            color: #fff;
            border: none;
            border-radius: 6px;
            margin: 0 8px;
            transition: background 0.3s;
        }
        .print-btn button:hover {
            background: #0e3b54;
        }
        .print-btn button.btn-close {
            background: #95a5a6;
        }
        .print-btn button.btn-close:hover {
            background: #7f8c8d;
        }

        @media print {
            body { background: #fff; padding: 0; }
            .print-container { box-shadow: none; border-radius: 0; padding: 30px; }
            .print-btn { display: none !important; }
            .amount-table th { background: #333 !important; color: #fff !important; -webkit-print-color-adjust: exact; print-color-adjust: exact; }
            .amount-table .section-header td { background: #e9ecef !important; -webkit-print-color-adjust: exact; print-color-adjust: exact; }
        }
    </style>
</head>
<body>

<div class="print-container">

    <!-- HEADER -->
    <div class="header">
        <h1>
            <img src="assets/images/logo-icon.png" alt="HMS"> City Hospital
        </h1>
        <p>123, Main Road, Dhaka | Phone: +880 1234 567890</p>
    </div>

    <!-- TITLE -->
    <div class="bill-title">INVOICE / BILL</div>

    <!-- PATIENT INFO -->
    <div class="info-section">
        <div class="row">
            <div class="col">
                <p><strong>Invoice #:</strong> <?= $id ?></p>
                <p><strong>Patient:</strong> <?= htmlspecialchars($bill['patient_name']) ?></p>
                <p><strong>Phone:</strong> <?= htmlspecialchars($patient['phone'] ?? 'N/A') ?></p>
                <p><strong>Address:</strong> <?= htmlspecialchars($patient['address'] ?? 'N/A') ?></p>
            </div>
            <div class="col" style="text-align: right;">
                <p><strong>Bill Date:</strong> <?= date('d M, Y', strtotime($bill['bill_date'])) ?></p>
                <p><strong>Admission ID:</strong> <?= $bill['admission_id'] ?? 'N/A' ?></p>
            </div>
        </div>
    </div>

    <!-- ITEMIZED TABLE -->
    <table class="amount-table">
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
            <?php if($admission_data): ?>
            <tr class="section-header">
                <td colspan="4"><strong>Bed / Admission Charges</strong></td>
            </tr>
            <tr>
                <td><?= $admission_data['description'] ?></td>
                <td><?= number_format($admission_data['unit_price'], 2) ?></td>
                <td><?= $admission_data['qty'] ?> day(s)</td>
                <td><?= number_format($admission_data['total'], 2) ?></td>
            </tr>
            <?php endif; ?>

            <!-- ===== MEDICINES ===== -->
            <?php if(count($medicines) > 0): ?>
            <tr class="section-header">
                <td colspan="4"><strong>Medicines</strong></td>
            </tr>
            <?php foreach($medicines as $med): ?>
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
            <tr class="sub-total">
                <td colspan="3" style="text-align:right;"><strong>Subtotal (Medicines)</strong></td>
                <td><strong><?= number_format($total_medicines, 2) ?></strong></td>
            </tr>
            <?php endif; ?>

            <!-- ===== TESTS ===== -->
            <?php if(count($tests) > 0): ?>
            <tr class="section-header">
                <td colspan="4"><strong>Tests</strong></td>
            </tr>
            <?php foreach($tests as $test): ?>
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
            <tr class="sub-total">
                <td colspan="3" style="text-align:right;"><strong>Subtotal (Tests)</strong></td>
                <td><strong><?= number_format($total_tests, 2) ?></strong></td>
            </tr>
            <?php endif; ?>

            <!-- ===== GRAND TOTAL ===== -->
            <tr class="total-row">
                <td colspan="3" style="text-align:right; font-size:18px;">GRAND TOTAL</td>
                <td style="font-size:18px;"><strong><?= number_format($grand_total, 2) ?></strong></td>
            </tr>

        </tbody>
    </table>

    <!-- SIGNATURE -->
    <div class="signature">
        <div>
            <hr>
            <span>Authorized Signature</span>
        </div>
        <div>
            <hr>
            <span>Patient Signature</span>
        </div>
    </div>

    <!-- FOOTER -->
    <div class="footer">
        <p>This is a computer-generated invoice. Valid without signature.</p>
        <p>© <?= date('Y') ?> | All Rights Reserved. Developed by 
        <strong>Mustafa Mursalin Khan (1295365)</strong> 
        (WDPF Round-70) as an assignment of 
        <strong>ISDB-BISEW IT Scholarship Programme</strong>.</p>
    </div>

</div>

<!-- PRINT BUTTONS -->
<div class="print-btn">
    <button onclick="window.print()">🖶 Print Bill</button>
    <button class="btn-close" onclick="window.close()">✖ Close</button>
</div>

</body>
</html>