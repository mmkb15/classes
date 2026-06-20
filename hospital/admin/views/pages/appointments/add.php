<?php
require_once __DIR__ . '/../../../config/base.php';
require_once __DIR__ . '/../../../config/db.php';
require_once __DIR__ . '/../../../config/auth.php';

$pageTitle   = 'Book Appointment';
$currentPage = 'appointments';
$error       = '';

$patients = $pdo->query("SELECT id, name FROM patients ORDER BY name")->fetchAll();
$doctors  = $pdo->query("SELECT id, name, specialty FROM doctors WHERE status='Active' ORDER BY name")->fetchAll();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $patient_id = (int)($_POST['patient_id'] ?? 0);
    $doctor_id  = (int)($_POST['doctor_id'] ?? 0);
    $date       = $_POST['appointment_date'] ?? '';
    $time       = $_POST['appointment_time'] ?? '';
    $notes      = trim($_POST['notes'] ?? '');

    if ($patient_id && $doctor_id && $date) {
        $stmt = $pdo->prepare("INSERT INTO appointments (patient_id, doctor_id, appointment_date, appointment_time, notes) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$patient_id, $doctor_id, $date, $time ?: null, $notes]);
        $newId = $pdo->lastInsertId();
        header('Location: slip.php?id=' . $newId . '&new=1');
        exit;
    } else {
        $error = 'Patient, Doctor এবং Date অবশ্যই দিতে হবে।';
    }
}

include __DIR__ . '/../../../views/layouts/header.php';
include __DIR__ . '/../../../views/layouts/sidebar.php';
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h5 class="mb-0">Book New Appointment</h5>
    <a href="index.php" class="btn btn-outline-secondary"><i class="fas fa-arrow-left me-1"></i> Back</a>
</div>

<?php if ($error): ?>
    <div class="alert-danger"><?= $error ?></div>
<?php endif; ?>

<div class="card">
    <div class="card-body">
        <form method="POST">
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Select Patient *</label>
                    <select name="patient_id" class="form-select" required>
                        <option value="">-- Patient বেছে নাও --</option>
                        <?php foreach ($patients as $p): ?>
                            <option value="<?= $p['id'] ?>" <?= ($_POST['patient_id'] ?? '') == $p['id'] ? 'selected' : '' ?>>
                                <?= htmlspecialchars($p['name']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <small class="text-muted">Patient নেই? <a href="../patients/add.php">এখানে add করো</a></small>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Select Doctor *</label>
                    <select name="doctor_id" class="form-select" required>
                        <option value="">-- Doctor বেছে নাও --</option>
                        <?php foreach ($doctors as $d): ?>
                            <option value="<?= $d['id'] ?>" <?= ($_POST['doctor_id'] ?? '') == $d['id'] ? 'selected' : '' ?>>
                                <?= htmlspecialchars($d['name']) ?> (<?= $d['specialty'] ?>)
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Appointment Date *</label>
                    <input type="date" name="appointment_date" class="form-control" 
                           value="<?= $_POST['appointment_date'] ?? date('Y-m-d') ?>" 
                           min="<?= date('Y-m-d') ?>" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Appointment Time</label>
                    <input type="time" name="appointment_time" class="form-control" value="<?= $_POST['appointment_time'] ?? '' ?>">
                </div>
                <div class="col-12">
                    <label class="form-label fw-semibold">Notes (Optional)</label>
                    <textarea name="notes" class="form-control" rows="2" placeholder="কোনো বিশেষ তথ্য থাকলে লিখো..."><?= htmlspecialchars($_POST['notes'] ?? '') ?></textarea>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="fas fa-calendar-check me-1"></i> Book & Print Slip
                    </button>
                    <a href="index.php" class="btn btn-outline-secondary ms-2">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>

<?php include __DIR__ . '/../../../views/layouts/footer.php'; ?>
