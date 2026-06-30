<?php
require_once 'models/admission.class.php';
require_once 'models/patient.class.php';
require_once 'models/room.class.php';

$patients = Patient::readAll();
$rooms = Room::readAvailable();

if(isset($_POST['btn-submit'])){
    $patient_id = $_POST['patient_id'];
    $room_id = $_POST['room_id'];
    $admit_date = $_POST['admit_date'];

    $admission = new Admission(null, $patient_id, $room_id, $admit_date);
    $res = $admission->create();

    if(is_numeric($res)){
        $msg = "Patient admitted successfully!";
    } else {
        $msg = $res;
    }
}
?>

<div class="main-content-container overflow-hidden">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
        <h3 class="mb-0">Admit Patient</h3>
    </div>

    <?php if(isset($msg)): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= $msg ?>
        <a href="?page=admissions/manage" class="alert-link">Go to List</a>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    <?php endif; ?>

    <div class="card bg-white border-0 rounded-3 mb-4">
        <div class="card-body p-20">
            <form method="POST">
                <div class="row">
                    <div class="col-lg-6 col-sm-12">
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
                    <div class="col-lg-6 col-sm-12">
                        <div class="form-group mb-4">
                            <label class="label text-secondary">Room</label>
                            <select class="form-control h-60 border-border-color" name="room_id" required>
                                <option value="">Select Available Room</option>
                                <?php foreach($rooms as $room): ?>
                                    <option value="<?= $room['id'] ?>"><?= $room['room_no'] ?> (<?= $room['room_type'] ?>)</option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <div class="form-group mb-4">
                            <label class="label text-secondary">Admit Date</label>
                            <input type="date" name="admit_date" class="form-control h-60 border-border-color" value="<?= date('Y-m-d') ?>" required>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="d-flex flex-wrap gap-3">
                            <button class="btn btn-primary py-2 px-4 fw-medium fs-16" type="submit" name="btn-submit">
                                <i class="ri-add-line text-white fw-medium"></i> Admit Patient
                            </button>
                            <a href="?page=admissions/manage" class="btn btn-secondary py-2 px-4 fw-medium fs-16">Cancel</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>