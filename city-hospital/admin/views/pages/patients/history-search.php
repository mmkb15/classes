<!-- <?php
require_once 'models/patient.class.php';
$patients = Patient::readAll();

?>

<div class="main-content-container overflow-hidden">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
        <h3 class="mb-0">Search Patient History</h3>
    </div>

    <div class="card bg-white border-0 rounded-3 mb-4">
        <div class="card-body p-20">
            <form method="GET" action="patient-history">
                <div class="row">
                    <div class="col-lg-8 col-sm-12">
                        <div class="form-group mb-4">
                            <label class="label text-secondary">Select Patient</label>
                            <select class="form-control h-60 border-border-color" name="id" required>
                                <option value="">-- Select Patient --</option>
                                <?php foreach($patients as $patient): ?>
                                    <option value="<?= $patient['id'] ?>"><?= htmlspecialchars($patient['name']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-12">
                        <div class="form-group mb-4">
                            <label class="label text-secondary" style="visibility:hidden;">.</label>
                            <button type="submit" class="btn btn-primary h-60 w-100">View History</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div> -->