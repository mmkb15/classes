<?php
require_once __DIR__ . '/../../../config/base.php';
require_once __DIR__ . '/../../../config/db.php';
require_once __DIR__ . '/../../../config/auth.php';

$id = (int)($_GET['id'] ?? 0);
if (!$id) { header('Location: index.php'); exit; }

$stmt = $pdo->prepare("
    SELECT a.*,
           p.name AS patient_name, p.age, p.gender, p.phone AS patient_phone,
           p.address, p.blood_group,
           d.name AS doctor_name, d.specialty, d.phone AS doctor_phone,
           dep.name AS dept_name
    FROM appointments a
    JOIN patients p   ON a.patient_id = p.id
    JOIN doctors d    ON a.doctor_id  = d.id
    LEFT JOIN departments dep ON d.department_id = dep.id
    WHERE a.id = ?
");
$stmt->execute([$id]);
$appt = $stmt->fetch();

if (!$appt) { header('Location: index.php'); exit; }

$isNew = isset($_GET['new']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Appointment Slip - #<?= str_pad($appt['id'], 5, '0', STR_PAD_LEFT) ?></title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Arial, sans-serif; background: #f0f4f8; padding: 20px; }

        .slip-container { max-width: 700px; margin: 0 auto; background: #fff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 20px rgba(0,0,0,0.12); }

        /* Header */
        .slip-header { background: linear-gradient(135deg, #1a3c6e, #3584fc); color: #fff; padding: 28px 32px; display: flex; align-items: center; gap: 20px; }
        .slip-header .hospital-icon { font-size: 48px; opacity: 0.9; }
        .slip-header h1 { font-size: 22px; font-weight: 700; margin-bottom: 4px; }
        .slip-header p { font-size: 13px; opacity: 0.85; margin: 2px 0; }
        .slip-header .slip-id { margin-left: auto; text-align: right; }
        .slip-header .slip-id .id-number { font-size: 28px; font-weight: 800; }
        .slip-header .slip-id small { font-size: 12px; opacity: 0.8; }

        /* Status Banner */
        .status-banner { padding: 10px 32px; font-size: 13px; font-weight: 600; display: flex; align-items: center; gap: 8px; }
        .status-banner.Confirmed  { background: #d4edda; color: #155724; }
        .status-banner.Pending    { background: #fff3cd; color: #856404; }
        .status-banner.Cancelled  { background: #f8d7da; color: #721c24; }
        .status-banner.Completed  { background: #d1ecf1; color: #0c5460; }

        /* Body */
        .slip-body { padding: 28px 32px; }
        .section-title { font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; color: #3584fc; border-bottom: 2px solid #e8f0fe; padding-bottom: 6px; margin-bottom: 16px; margin-top: 24px; }
        .section-title:first-child { margin-top: 0; }

        .info-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 14px; }
        .info-item label { display: block; font-size: 11px; color: #999; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 3px; }
        .info-item span  { font-size: 15px; color: #1a1a2e; font-weight: 500; }

        .divider { border: none; border-top: 1px dashed #ddd; margin: 20px 0; }

        /* Appointment Box */
        .appt-box { background: #f8f9ff; border: 1.5px solid #c8d8ff; border-radius: 10px; padding: 20px; display: flex; justify-content: space-around; text-align: center; margin: 16px 0; }
        .appt-box .appt-item label { display: block; font-size: 11px; color: #888; text-transform: uppercase; font-weight: 600; margin-bottom: 6px; }
        .appt-box .appt-item span  { font-size: 18px; font-weight: 700; color: #1a3c6e; }

        /* Notes */
        .notes-box { background: #fffbf0; border: 1px solid #ffe8a0; border-radius: 8px; padding: 14px; font-size: 14px; color: #555; }

        /* Footer */
        .slip-footer { background: #f8f9ff; border-top: 1px solid #e8f0fe; padding: 16px 32px; display: flex; justify-content: space-between; align-items: center; font-size: 12px; color: #888; }
        .signature-area { text-align: right; }
        .signature-line { border-top: 1px solid #333; width: 160px; margin: 40px 0 6px auto; }

        /* Print Buttons */
        .print-actions { text-align: center; padding: 20px; background: #fff; }
        .btn { display: inline-block; padding: 10px 24px; border-radius: 8px; font-size: 14px; font-weight: 600; cursor: pointer; text-decoration: none; border: none; margin: 0 6px; }
        .btn-print { background: #3584fc; color: #fff; }
        .btn-back  { background: #f0f4f8; color: #333; }
        .btn:hover { opacity: 0.9; }

        /* Print Styles */
        @media print {
            body { background: white; padding: 0; }
            .print-actions { display: none; }
            .slip-container { box-shadow: none; border-radius: 0; }
        }
    </style>
</head>
<body>

<?php if ($isNew): ?>
<div style="background:#d4edda;color:#155724;padding:12px 20px;text-align:center;font-weight:600;font-size:14px;border-radius:8px;margin-bottom:16px;max-width:700px;margin-left:auto;margin-right:auto;">
    ✅ Appointment successfully booked! Slip টা print করে রাখো।
</div>
<?php endif; ?>

<div class="slip-container">

    <!-- Header -->
    <div class="slip-header">
        <div class="hospital-icon">🏥</div>
        <div>
            <h1>City General Hospital</h1>
            <p>📍 Dhaka, Bangladesh</p>
            <p>📞 +880 2-XXXXXXX</p>
        </div>
        <div class="slip-id">
            <small>Appointment No.</small>
            <div class="id-number">#<?= str_pad($appt['id'], 5, '0', STR_PAD_LEFT) ?></div>
            <small>Issued: <?= date('d M Y') ?></small>
        </div>
    </div>

    <!-- Status -->
    <div class="status-banner <?= $appt['status'] ?>">
        <?php
        $icons = ['Confirmed'=>'✅','Pending'=>'⏳','Cancelled'=>'❌','Completed'=>'✔️'];
        echo ($icons[$appt['status']] ?? '•') . ' Status: ' . $appt['status'];
        ?>
    </div>

    <!-- Body -->
    <div class="slip-body">

        <!-- Appointment Info -->
        <div class="section-title">📅 Appointment Details</div>
        <div class="appt-box">
            <div class="appt-item">
                <label>Date</label>
                <span><?= date('d M Y', strtotime($appt['appointment_date'])) ?></span>
            </div>
            <?php if ($appt['appointment_time']): ?>
            <div class="appt-item">
                <label>Time</label>
                <span><?= date('h:i A', strtotime($appt['appointment_time'])) ?></span>
            </div>
            <?php endif; ?>
            <div class="appt-item">
                <label>Day</label>
                <span><?= date('l', strtotime($appt['appointment_date'])) ?></span>
            </div>
        </div>

        <!-- Patient Info -->
        <div class="section-title">🧑 Patient Information</div>
        <div class="info-grid">
            <div class="info-item">
                <label>Full Name</label>
                <span><?= htmlspecialchars($appt['patient_name']) ?></span>
            </div>
            <div class="info-item">
                <label>Age / Gender</label>
                <span><?= $appt['age'] ?> yrs / <?= $appt['gender'] ?></span>
            </div>
            <div class="info-item">
                <label>Phone</label>
                <span><?= $appt['patient_phone'] ?: '-' ?></span>
            </div>
            <div class="info-item">
                <label>Blood Group</label>
                <span><?= $appt['blood_group'] ?: '-' ?></span>
            </div>
            <?php if ($appt['address']): ?>
            <div class="info-item" style="grid-column: span 2;">
                <label>Address</label>
                <span><?= htmlspecialchars($appt['address']) ?></span>
            </div>
            <?php endif; ?>
        </div>

        <hr class="divider">

        <!-- Doctor Info -->
        <div class="section-title">👨‍⚕️ Doctor Information</div>
        <div class="info-grid">
            <div class="info-item">
                <label>Doctor Name</label>
                <span><?= htmlspecialchars($appt['doctor_name']) ?></span>
            </div>
            <div class="info-item">
                <label>Specialty</label>
                <span><?= htmlspecialchars($appt['specialty']) ?></span>
            </div>
            <?php if ($appt['dept_name']): ?>
            <div class="info-item">
                <label>Department</label>
                <span><?= htmlspecialchars($appt['dept_name']) ?></span>
            </div>
            <?php endif; ?>
            <div class="info-item">
                <label>Contact</label>
                <span><?= $appt['doctor_phone'] ?: '-' ?></span>
            </div>
        </div>

        <?php if ($appt['notes']): ?>
        <hr class="divider">
        <div class="section-title">📝 Notes</div>
        <div class="notes-box"><?= nl2br(htmlspecialchars($appt['notes'])) ?></div>
        <?php endif; ?>

        <!-- Signature -->
        <div class="signature-area" style="margin-top: 32px;">
            <div class="signature-line"></div>
            <small style="color:#666;">Authorized Signature</small>
        </div>
    </div>

    <!-- Footer -->
    <div class="slip-footer">
        <div>
            <strong>Important:</strong> Please arrive 15 minutes before your appointment time.<br>
            Bring this slip and any previous medical records.
        </div>
        <div style="color:#3584fc;font-weight:600;">City General Hospital</div>
    </div>

</div>

<!-- Print Actions -->
<div class="print-actions">
    <button onclick="window.print()" class="btn btn-print">🖨️ Print Slip</button>
    <a href="index.php" class="btn btn-back">← Back to Appointments</a>
</div>

</body>
</html>
