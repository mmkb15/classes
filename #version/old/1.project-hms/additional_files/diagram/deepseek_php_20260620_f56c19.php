<?php
require_once 'models/appointment.class.php';
require_once 'models/patient.class.php';
require_once 'models/doctor.class.php';

// সব পেশেন্ট ও ডাক্তার লিস্ট (ড্রপডাউনের জন্য)
$patients = Patient::readAll();
$doctors = Doctor::readAll();

if(isset($_POST['btn-submit'])){
    $patient_id = $_POST['patient_id'];
    $doctor_id = $_POST['doctor_id'];
    $appointment_date = $_POST['appointment_date'];
    $status = $_POST['status'];

    $appointment = new Appointment(null, $patient_id, $doctor_id, $appointment_date, $status);
    $res = $appointment->create();

    if($res === true){
        $msg = "Appointment Created Successfully";
    } else {
        $msg = $res;
    }
}
?>

<div class="main-content-container overflow-hidden">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
        <h3 class="mb-0">Add New Appointment</h3>
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
                <div class="row">
                    <div class="col-lg-12 col-sm-12">
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
                    <div class="col-lg-12 col-sm-12">
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
                    <div class="col-lg-12 col-sm-12">
                        <div class="form-group mb-4">
                            <label class="label text-secondary">Appointment Date</label>
                            <input type="date" name="appointment_date" class="form-control h-60 border-border-color" required>
                        </div>
                    </div>
                    <div class="col-lg-12 col-sm-12">
                        <div class="form-group mb-4">
                            <label class="label text-secondary">Status</label>
                            <select class="form-control h-60 border-border-color" name="status">
                                <option value="Scheduled">Scheduled</option>
                                <option value="Completed">Completed</option>
                                <option value="Cancelled">Cancelled</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="d-flex flex-wrap gap-3">
                            <button class="btn btn-primary py-2 px-4 fw-medium fs-16" type="submit" name="btn-submit">
                                <i class="ri-add-line text-white fw-medium"></i> Add Appointment
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>