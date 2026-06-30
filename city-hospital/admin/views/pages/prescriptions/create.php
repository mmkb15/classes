<?php
require_once 'models/prescription.class.php';
require_once 'models/appointment.class.php';
require_once 'models/patient.class.php';
require_once 'models/doctor.class.php';
require_once 'models/medicine.class.php';
require_once 'models/test.class.php';

// Get all data for dropdowns
$appointments = Appointment::readAll();
$patients = Patient::readAll();
$doctors = Doctor::readAll();
$medicines = Medicine::readAll();
$tests = Test::readAll();

// For dynamic medicine/test rows (JavaScript will handle)
$medicine_count = 0;
$test_count = 0;

if(isset($_POST['btn-submit'])){
    $appointment_id = $_POST['appointment_id'];
    $patient_id = $_POST['patient_id'];
    $doctor_id = $_POST['doctor_id'];
    $diagnosis = $_POST['diagnosis'];
    $prescription_date = $_POST['prescription_date'];
    $follow_up_date = $_POST['follow_up_date'] ?? null;
    $notes = $_POST['notes'] ?? null;

    // Create prescription
    $prescription = new Prescription(null, $appointment_id, $patient_id, $doctor_id, $diagnosis, $prescription_date, $follow_up_date, $notes);
    $prescription_id = $prescription->create();

    if(is_numeric($prescription_id) && $prescription_id > 0) {
        // Add medicines
        if(isset($_POST['medicine_id']) && is_array($_POST['medicine_id'])) {
            foreach($_POST['medicine_id'] as $key => $medicine_id) {
                if(!empty($medicine_id)) {
                    $dosage = $_POST['dosage'][$key] ?? '';
                    $duration = $_POST['duration'][$key] ?? '';
                    $instructions = $_POST['med_instructions'][$key] ?? '';
                    Prescription::addMedicine($prescription_id, $medicine_id, $dosage, $duration, $instructions);
                }
            }
        }

        // Add tests
        if(isset($_POST['test_id']) && is_array($_POST['test_id'])) {
            foreach($_POST['test_id'] as $key => $test_id) {
                if(!empty($test_id)) {
                    $test_instructions = $_POST['test_instructions'][$key] ?? '';
                    Prescription::addTest($prescription_id, $test_id, $test_instructions);
                }
            }
        }

        $msg = "Prescription created successfully!";
    } else {
        $msg = $prescription_id; // Error message
    }
}
?>

<div class="main-content-container overflow-hidden">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
        <h3 class="mb-0">Create Prescription</h3>
    </div>

    <?php if(isset($msg)): ?>
    <div class="alert <?= (strpos($msg, 'success') !== false) ? 'alert-success' : 'alert-danger' ?>">
        <?= $msg ?>
        <?php if(strpos($msg, 'success') !== false): ?>
        <a href="?page=prescriptions/manage">Go to List</a>
        <?php endif; ?>
    </div>
    <?php endif; ?>

    <div class="card bg-white border-0 rounded-3 mb-4">
        <div class="card-body p-4">
            <form method="POST" id="prescriptionForm">
                <div class="row">
                    <!-- Basic Info -->
                    <div class="col-lg-6">
                        <div class="form-group mb-4">
                            <label class="label text-secondary">Appointment</label>
                            <select class="form-control h-60 border-border-color" name="appointment_id" required>
                                <option value="">Select Appointment</option>
                                <?php foreach($appointments as $app): ?>
                                    <option value="<?= $app['id'] ?>">#<?= $app['id'] ?> - <?= htmlspecialchars($app['patient_name'] ?? 'N/A') ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group mb-4">
                            <label class="label text-secondary">Prescription Date</label>
                            <input type="date" name="prescription_date" class="form-control h-60 border-border-color" value="<?= date('Y-m-d') ?>" required>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group mb-4">
                            <label class="label text-secondary">Patient</label>
                            <select class="form-control h-60 border-border-color" name="patient_id" required>
                                <option value="">Select Patient</option>
                                <?php foreach($patients as $patient): ?>
                                    <option value="<?= $patient['id'] ?>"><?= htmlspecialchars($patient['name']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group mb-4">
                            <label class="label text-secondary">Doctor</label>
                            <select class="form-control h-60 border-border-color" name="doctor_id" required>
                                <option value="">Select Doctor</option>
                                <?php foreach($doctors as $doctor): ?>
                                    <option value="<?= $doctor['id'] ?>"><?= htmlspecialchars($doctor['name']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group mb-4">
                            <label class="label text-secondary">Diagnosis</label>
                            <textarea name="diagnosis" rows="3" class="form-control" placeholder="Enter diagnosis details" required></textarea>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group mb-4">
                            <label class="label text-secondary">Follow-up Date</label>
                            <input type="date" name="follow_up_date" class="form-control h-60 border-border-color">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group mb-4">
                            <label class="label text-secondary">Notes</label>
                            <input type="text" name="notes" class="form-control h-60 border-border-color" placeholder="Additional notes">
                        </div>
                    </div>
                </div>

                <!-- Medicines Section -->
                <h4 class="mt-4 mb-3">Medicines</h4>
                <div id="medicineContainer">
                    <div class="row medicine-row">
                        <div class="col-lg-3">
                            <div class="form-group mb-3">
                                <select class="form-control" name="medicine_id[]">
                                    <option value="">Select Medicine</option>
                                    <?php foreach($medicines as $med): ?>
                                        <option value="<?= $med['id'] ?>"><?= htmlspecialchars($med['name']) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group mb-3">
                                <input type="text" name="dosage[]" class="form-control" placeholder="Dosage">
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group mb-3">
                                <input type="text" name="duration[]" class="form-control" placeholder="Duration">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group mb-3">
                                <input type="text" name="med_instructions[]" class="form-control" placeholder="Instructions">
                            </div>
                        </div>
                        <div class="col-lg-1">
                            <button type="button" class="btn btn-danger remove-medicine">×</button>
                        </div>
                    </div>
                </div>
                <button type="button" class="btn btn-sm btn-primary" id="addMedicineBtn">+ Add Medicine</button>

                <!-- Tests Section -->
                <h4 class="mt-4 mb-3">Tests</h4>
                <div id="testContainer">
                    <div class="row test-row">
                        <div class="col-lg-5">
                            <div class="form-group mb-3">
                                <select class="form-control" name="test_id[]">
                                    <option value="">Select Test</option>
                                    <?php foreach($tests as $test): ?>
                                        <option value="<?= $test['id'] ?>"><?= htmlspecialchars($test['name']) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-3">
                                <input type="text" name="test_instructions[]" class="form-control" placeholder="Instructions">
                            </div>
                        </div>
                        <div class="col-lg-1">
                            <button type="button" class="btn btn-danger remove-test">×</button>
                        </div>
                    </div>
                </div>
                <button type="button" class="btn btn-sm btn-primary" id="addTestBtn">+ Add Test</button>

                <div class="col-lg-12 mt-4">
                    <div class="d-flex flex-wrap gap-3">
                        <button class="btn btn-primary py-2 px-4 fw-medium fs-16" type="submit" name="btn-submit">
                            <i class="ri-add-line text-white fw-medium"></i> Create Prescription
                        </button>
                        <a href="?page=prescriptions/manage" class="btn btn-secondary py-2 px-4 fw-medium fs-16">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
// Add medicine row dynamically
document.getElementById('addMedicineBtn').addEventListener('click', function() {
    let container = document.getElementById('medicineContainer');
    let firstRow = container.querySelector('.medicine-row');
    let newRow = firstRow.cloneNode(true);
    newRow.querySelectorAll('select, input').forEach(el => el.value = '');
    container.appendChild(newRow);
    
    // Add remove event
    newRow.querySelector('.remove-medicine').addEventListener('click', function() {
        if(container.querySelectorAll('.medicine-row').length > 1) {
            this.closest('.medicine-row').remove();
        }
    });
});

// Add test row dynamically
document.getElementById('addTestBtn').addEventListener('click', function() {
    let container = document.getElementById('testContainer');
    let firstRow = container.querySelector('.test-row');
    let newRow = firstRow.cloneNode(true);
    newRow.querySelectorAll('select, input').forEach(el => el.value = '');
    container.appendChild(newRow);
    
    // Add remove event
    newRow.querySelector('.remove-test').addEventListener('click', function() {
        if(container.querySelectorAll('.test-row').length > 1) {
            this.closest('.test-row').remove();
        }
    });
});

// Remove event for initial rows
document.querySelectorAll('.remove-medicine').forEach(btn => {
    btn.addEventListener('click', function() {
        let container = document.getElementById('medicineContainer');
        if(container.querySelectorAll('.medicine-row').length > 1) {
            this.closest('.medicine-row').remove();
        }
    });
});

document.querySelectorAll('.remove-test').forEach(btn => {
    btn.addEventListener('click', function() {
        let container = document.getElementById('testContainer');
        if(container.querySelectorAll('.test-row').length > 1) {
            this.closest('.test-row').remove();
        }
    });
});
</script>