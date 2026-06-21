<?php
require_once 'models/appointment.class.php';

$appointments = Appointment::readAll();

if(isset($_GET['delete_id'])){
    $res = Appointment::delete($_GET['delete_id']);
    if($res === true){
        echo "<script>window.location='?page=appointments/manage';</script>";
    }
}
?>

<div class="main-content-container overflow-hidden">



    <div class="card bg-white border-0 rounded-3 mb-4">
        <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-20">
                <a href="?page=appointments/create" class="btn btn-outline-primary fs-14 fw-medium rounded-3 hover-bg" style="padding: 1.5px 13px;">
                    <span class="py-sm-1 d-block">
                        <i class="ri-add-line d-none d-sm-inline-block fs-18 position-relative top-1"></i>
                        <span>Add New Appointment</span>
                    </span>
                </a>
            </div> 
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Patient</th>
                        <th>Doctor</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($appointments as $row): ?>
                    <tr>
                        <td><?= $row['id'] ?></td>
                        <td><?= htmlspecialchars($row['patient_name']) ?></td>
                        <td><?= htmlspecialchars($row['doctor_name']) ?></td>
                        <td><?= $row['appointment_date'] ?></td>
                        <td>
                            <span class="badge <?= ($row['status'] == 'Scheduled') ? 'bg-primary' : (($row['status'] == 'Completed') ? 'bg-success' : 'bg-danger') ?>">
                                <?= $row['status'] ?>
                            </span>
                        </td>
                        <td>
                            <a href="?page=appointments/edit&id=<?= $row['id'] ?>" class="btn btn-sm btn-primary">Edit</a>
                            <a href="?page=appointments/manage&delete_id=<?= $row['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>