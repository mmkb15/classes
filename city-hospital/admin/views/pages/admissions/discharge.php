<?php
require_once 'models/admission.class.php';

$id = isset($_GET['id']) ? $_GET['id'] : 0;
$admission = Admission::readByID($id);

if(!$admission) {
    die("Admission not found!");
}

if(isset($_POST['btn-submit'])){
    $discharge_date = $_POST['discharge_date'];

    $adm = new Admission($id, $admission['patient_id'], $admission['room_id'], $admission['admit_date'], $discharge_date);
    $res = $adm->discharge();

    if($res === true){
        echo "<script>window.location='?page=admissions/manage&msg=discharged';</script>";
    } else {
        $msg = $res;
    }
}
?>

<div class="main-content-container overflow-hidden">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
        <h3 class="mb-0">Discharge Patient</h3>
    </div>

    <?php if(isset($msg)): ?>
    <div class="alert alert-danger"><?= $msg ?></div>
    <?php endif; ?>

    <div class="card bg-white border-0 rounded-3 mb-4">
        <div class="card-body p-20">
            <form method="POST">
                <div class="row">
                    <div class="col-lg-6 col-sm-12">
                        <div class="form-group mb-4">
                            <label class="label text-secondary">Patient</label>
                            <input type="text" class="form-control h-60 border-border-color" value="<?= htmlspecialchars($admission['patient_name']) ?>" disabled>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <div class="form-group mb-4">
                            <label class="label text-secondary">Room</label>
                            <input type="text" class="form-control h-60 border-border-color" value="<?= $admission['room_no'] ?>" disabled>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <div class="form-group mb-4">
                            <label class="label text-secondary">Discharge Date</label>
                            <input type="date" name="discharge_date" class="form-control h-60 border-border-color" value="<?= date('Y-m-d') ?>" required>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="d-flex flex-wrap gap-3">
                            <button class="btn btn-warning py-2 px-4 fw-medium fs-16" type="submit" name="btn-submit">
                                <i class="ri-logout-box-line text-white fw-medium"></i> Discharge Patient
                            </button>
                            <a href="?page=admissions/manage" class="btn btn-secondary py-2 px-4 fw-medium fs-16">Cancel</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>