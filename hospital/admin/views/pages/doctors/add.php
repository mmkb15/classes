<?php
require_once __DIR__ . '/../../../config/base.php';
require_once __DIR__ . '/../../../config/db.php';
require_once __DIR__ . '/../../../config/auth.php';

$pageTitle   = 'Add Doctor';
$currentPage = 'doctors';
$error       = '';

$departments = $pdo->query("SELECT * FROM departments ORDER BY name")->fetchAll();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name      = trim($_POST['name'] ?? '');
    $specialty = trim($_POST['specialty'] ?? '');
    $dept_id   = (int)($_POST['department_id'] ?? 0);
    $phone     = trim($_POST['phone'] ?? '');
    $email     = trim($_POST['email'] ?? '');

    if ($name) {
        $stmt = $pdo->prepare("INSERT INTO doctors (name, specialty, department_id, phone, email) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$name, $specialty, $dept_id ?: null, $phone, $email]);
        header('Location: index.php?msg=added');
        exit;
    } else {
        $error = 'Doctor name দিতে হবে।';
    }
}

include __DIR__ . '/../../../views/layouts/header.php';
include __DIR__ . '/../../../views/layouts/sidebar.php';
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h5 class="mb-0">Add New Doctor</h5>
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
                    <label class="form-label fw-semibold">Doctor Name *</label>
                    <input type="text" name="name" class="form-control" placeholder="Dr. ..." required value="<?= htmlspecialchars($_POST['name'] ?? '') ?>">
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Specialty</label>
                    <input type="text" name="specialty" class="form-control" placeholder="Cardiologist, Neurologist..." value="<?= htmlspecialchars($_POST['specialty'] ?? '') ?>">
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Department</label>
                    <select name="department_id" class="form-select">
                        <option value="">-- Select Department --</option>
                        <?php foreach ($departments as $dept): ?>
                            <option value="<?= $dept['id'] ?>" <?= ($_POST['department_id'] ?? '') == $dept['id'] ? 'selected' : '' ?>>
                                <?= htmlspecialchars($dept['name']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Phone</label>
                    <input type="text" name="phone" class="form-control" placeholder="01XXXXXXXXX" value="<?= htmlspecialchars($_POST['phone'] ?? '') ?>">
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Email</label>
                    <input type="email" name="email" class="form-control" placeholder="doctor@hospital.com" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary px-4"><i class="fas fa-save me-1"></i> Save Doctor</button>
                    <a href="index.php" class="btn btn-outline-secondary ms-2">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>

<?php include __DIR__ . '/../../../views/layouts/footer.php'; ?>
