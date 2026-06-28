<?php
require_once 'models/test.class.php';

/**
 * Handle Form Submission
 */
if(isset($_POST['btn-submit'])){
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    $test = new Test(null, $name, $description, $price);
    $res = $test->create();

    if($res === true){
        $msg = "Test created successfully!";
    } else {
        $msg = $res;
    }
}
?>

<div class="main-content-container overflow-hidden">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
        <h3 class="mb-0">Add New Test</h3>
    </div>

    <!-- Display Message -->
    <?php if(isset($msg)): ?>
    <div class="alert <?= (strpos($msg, 'success') !== false) ? 'alert-success' : 'alert-danger' ?> alert-dismissible fade show" role="alert">
        <?= $msg ?>
        <a href="?page=tests/manage" class="alert-link">Go to List</a>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    <?php endif; ?>

    <div class="card bg-white border-0 rounded-3 mb-4">
        <div class="card-body p-20">
            <form method="POST">
                <div class="row">
                    <div class="col-lg-6 col-sm-12">
                        <div class="form-group mb-4">
                            <label class="label text-secondary">Test Name</label>
                            <input type="text" name="name" class="form-control h-60 border-border-color" placeholder="Enter test name" required>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <div class="form-group mb-4">
                            <label class="label text-secondary">Price (BDT)</label>
                            <input type="number" step="0.01" name="price" class="form-control h-60 border-border-color" placeholder="Enter price" required>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group mb-4">
                            <label class="label text-secondary">Description</label>
                            <textarea name="description" rows="3" class="form-control" placeholder="Enter test description"></textarea>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="d-flex flex-wrap gap-3">
                            <button class="btn btn-primary py-2 px-4 fw-medium fs-16" type="submit" name="btn-submit">
                                <i class="ri-add-line text-white fw-medium"></i> Save Test
                            </button>
                            <a href="?page=tests/manage" class="btn btn-secondary py-2 px-4 fw-medium fs-16">Cancel</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>