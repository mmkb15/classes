<?php
require_once __DIR__ . '/../../../config/base.php';
require_once __DIR__ . '/../../../config/db.php';
require_once __DIR__ . '/../../../config/auth.php';

$pageTitle   = 'Edit Patient';
$currentPage = 'patients';

$id = (int)($_GET['id'] ?? 0);
if (!$id) { header('Location: index.php'); exit; }

$patient = $pdo->prepare("SELECT * FROM patients WHERE id = ?");
$patient->execute([$id]);
$patient = $patient->fetch();
if (!$patient) { header('Location: index.php'); exit; }

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name        = trim($_POST['name'] ?? '');
    $age         = (int)($_POST['age'] ?? 0);
    $gender      = $_POST['gender'] ?? '';
    $phone       = trim($_POST['phone'] ?? '');
    $address     = trim($_POST['address'] ?? '');
    $blood_group = trim($_POST['blood_group'] ?? '');

    if ($name && $gender) {
        $stmt = $pdo->prepare("UPDATE patients SET name=?, age=?, gender=?, phone=?, address=?, blood_group=? WHERE id=?");
        $stmt->execute([$name, $age, $gender, $phone, $address, $blood_group, $id]);
        header('Location: index.php?msg=updated');
        exit;
    } else {
        $error = 'Name ও Gender অবশ্যই দিতে হবে।';
    }
    // form এ entered values রাখো
    $patient = array_merge($patient, $_POST);
}

include __DIR__ . '/../../../views/layouts/header.php';
include __DIR__ . '/../../../views/layouts/sidebar.php';
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h5 class="mb-0">Edit Patient</h5>
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
                    <label class="form-label fw-semibold">Patient Name *</label>
                    <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($patient['name']) ?>" required>
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-semibold">Age</label>
                    <input type="number" name="age" class="form-control" value="<?= $patient['age'] ?>" min="0" max="150">
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-semibold">Gender *</label>
                    <select name="gender" class="form-select" required>
                        <option value="">-- Select --</option>
                        <?php foreach (['Male','Female','Other'] as $g): ?>
                            <option value="<?= $g ?>" <?= $patient['gender'] == $g ? 'selected' : '' ?>><?= $g ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Phone</label>
                    <input type="text" name="phone" class="form-control" value="<?= htmlspecialchars($patient['phone']) ?>">
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-semibold">Blood Group</label>
                    <select name="blood_group" class="form-select">
                        <option value="">-- Select --</option>
                        <?php foreach (['A+','A-','B+','B-','AB+','AB-','O+','O-'] as $bg): ?>
                            <option value="<?= $bg ?>" <?= $patient['blood_group'] == $bg ? 'selected' : '' ?>><?= $bg ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-12">
                    <label class="form-label fw-semibold">Address</label>
                    <textarea name="address" class="form-control" rows="2"><?= htmlspecialchars($patient['address']) ?></textarea>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-warning px-4">
                        <i class="fas fa-save me-1"></i> Update Patient
                    </button>
                    <a href="index.php" class="btn btn-outline-secondary ms-2">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>

<?php include __DIR__ . '/../../../views/layouts/footer.php'; ?>
