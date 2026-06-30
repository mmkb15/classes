<?php
require_once 'models/appointment.class.php';
require_once 'models/patient.class.php';
require_once 'models/doctor.class.php';

// Patient and Doctor (Dropdown)
$patients = Patient::readAll();
$doctors = Doctor::readAll();

// get ID
$id = isset($_GET['id']) ? $_GET['id'] : 0;
$row = Appointment::readByID($id);

if(!$row) {
    echo "<div class='alert alert-danger'>Appointment not found! <a href='?page=appointments/manage'>Go Back</a></div>";
    exit;
}

// Form Submit
if(isset($_POST['btn-submit'])){
    $id = $_POST['id'];
    $patient_id = $_POST['patient_id'];
    $doctor_id = $_POST['doctor_id'];
    $appointment_date = $_POST['appointment_date'];
    $status = $_POST['status'];

    $appointment = new Appointment($id, $patient_id, $doctor_id, $appointment_date, $status);
    $res = $appointment->update();

    if($res === true){
        $msg = "Appointment Updated Successfully";
        $row = Appointment::readByID($id);
    } else {
        $msg = $res;
    }
}
?>

<div class="main-content-container overflow-hidden">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
        <h3 class="mb-0">Edit Appointment</h3>
    </div>

    <?php if(isset($msg)): ?>
    <div class="alert alert-dark alert-dismissible fade show" role="alert">
        <?= $msg ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php endif; ?>

    <a href="?page=appointments/manage"><button class="btn btn-secondary py-2 px-4 fw-medium fs-16 mb-3"> <i class="ri-arrow-left-long-line"></i> Back</button></a>

    <div class="card bg-white border-0 rounded-3 mb-4">
        <div class="card-body p-4">
            <form method="POST">
                <input type="hidden" name="id" value="<?= $row['id'] ?>">
                
                <div class="row">
                    <div class="col-lg-12 col-sm-12">
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
                    <div class="col-lg-12 col-sm-12">
                        <div class="form-group mb-4">
                            <label class="label text-secondary">Doctor</label>
                            <select class="form-control h-60 border-border-color" name="doctor_id" required>
                                <option value="">Select Doctor</option>
                                <?php foreach($doctors as $doctor): ?>
                                    <option value="<?= $doctor['id'] ?>" <?= ($doctor['id'] == $row['doctor_id']) ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($doctor['name']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-12 col-sm-12">
                        <div class="form-group mb-4">
                            <label class="label text-secondary">Appointment Date</label>
                            <input type="date" name="appointment_date" class="form-control h-60 border-border-color" 
                                   value="<?= $row['appointment_date'] ?>" required>
                        </div>
                    </div>
                    <div class="col-lg-12 col-sm-12">
                        <div class="form-group mb-4">
                            <label class="label text-secondary">Status</label>
                            <select class="form-control h-60 border-border-color" name="status">
                                <option value="Scheduled" <?= ($row['status'] == 'Scheduled') ? 'selected' : '' ?>>Scheduled</option>
                                <option value="Completed" <?= ($row['status'] == 'Completed') ? 'selected' : '' ?>>Completed</option>
                                <option value="Cancelled" <?= ($row['status'] == 'Cancelled') ? 'selected' : '' ?>>Cancelled</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="d-flex flex-wrap gap-3">
                            <button class="btn btn-primary py-2 px-4 fw-medium fs-16" type="submit" name="btn-submit">
                                <i class="ri-add-line text-white fw-medium"></i> Update Appointment
                            </button>
                            <a href="?page=appointments/manage" class="btn btn-secondary py-2 px-4 fw-medium fs-16">Cancel</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>