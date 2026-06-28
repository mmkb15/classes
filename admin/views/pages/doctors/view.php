<?php
require_once 'models/doctor.class.php';
require_once 'models/department.class.php';

$id = isset($_GET['id']) ? $_GET['id'] : 0;
$doctor = Doctor::readByID($id);




if(!$doctor) {
    echo "<div class='alert alert-danger'>Doctor not found! <a href='?page=doctors/manage'>Go Back</a></div>";
    exit;
}
?>

<div class="main-content-container overflow-hidden">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
        <h3 class="mb-0">Doctor Details</h3>
        <div>
            <a href="?page=doctors/edit&id=<?= $id ?>" class="btn btn-primary">Edit</a>
            <a href="?page=doctors/manage" class="btn btn-secondary">Back to List</a>
        </div>
    </div>

    <div class="card bg-white border-0 rounded-3 mb-4">
        <div class="card-body p-20">
            <div class="row">
                <div class="col-md-6">
                    <p><strong>ID:</strong> <?= $doctor['id'] ?></p>
                    <p><strong>Name:</strong> <?= htmlspecialchars($doctor['name']) ?></p>
                    <p><strong>Specialization:</strong> <?= htmlspecialchars($doctor['specialization']) ?></p>
                    <p><strong>Department:</strong> <?= htmlspecialchars($doctor['department'] ?? 'N/A') ?></p>
                </div>
                <div class="col-md-6">
                    <p><strong>Phone:</strong> <?= $doctor['phone'] ?></p>
                    <p><strong>Email:</strong> <?= $doctor['email'] ?></p>
                    <p><strong>Created:</strong> <?= date('d M, Y', strtotime($doctor['created_at'])) ?></p>
                </div>
            </div>
        </div>
    </div>
</div>