<?php
require_once 'models/medicine.class.php';

/**
 * Get medicine ID from URL
 */
$id = isset($_GET['id']) ? $_GET['id'] : 0;
$row = Medicine::readByID($id);

if(!$row) {
    echo "<div class='alert alert-danger'>Medicine not found! <a href='?page=medicines/manage'>Go Back</a></div>";
    exit;
}

/**
 * Handle Form Submission
 */
if(isset($_POST['btn-submit'])){
    $name = $_POST['name'];
    $strength = $_POST['strength'];
    $price = $_POST['price'];

    $medicine = new Medicine($id, $name, $strength, $price);
    $res = $medicine->update();

    if($res === true){
        $msg = "Medicine updated successfully!";
        // Reload data
        $row = Medicine::readByID($id);
    } else {
        $msg = $res;
    }
}
?>

<div class="main-content-container overflow-hidden">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
        <h3 class="mb-0">Edit Medicine</h3>
    </div>

    <?php if(isset($msg)): ?>
    <div class="alert <?= (strpos($msg, 'success') !== false) ? 'alert-success' : 'alert-danger' ?> alert-dismissible fade show" role="alert">
        <?= $msg ?>
        <a href="?page=medicines/manage" class="alert-link">Go to List</a>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    <?php endif; ?>

    <div class="card bg-white border-0 rounded-3 mb-4">
        <div class="card-body p-20">
            <form method="POST">
                <div class="row">
                    <div class="col-lg-6 col-sm-12">
                        <div class="form-group mb-4">
                            <label class="label text-secondary">Medicine Name</label>
                            <input type="text" name="name" class="form-control h-60 border-border-color" value="<?= htmlspecialchars($row['name']) ?>" required>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <div class="form-group mb-4">
                            <label class="label text-secondary">Strength</label>
                            <input type="text" name="strength" class="form-control h-60 border-border-color" value="<?= htmlspecialchars($row['strength']) ?>" required>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <div class="form-group mb-4">
                            <label class="label text-secondary">Price (BDT)</label>
                            <input type="number" step="0.01" name="price" class="form-control h-60 border-border-color" value="<?= $row['price'] ?>" required>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="d-flex flex-wrap gap-3">
                            <button class="btn btn-primary py-2 px-4 fw-medium fs-16" type="submit" name="btn-submit">
                                <i class="ri-add-line text-white fw-medium"></i> Update Medicine
                            </button>
                            <a href="?page=medicines/manage" class="btn btn-secondary py-2 px-4 fw-medium fs-16">Cancel</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>