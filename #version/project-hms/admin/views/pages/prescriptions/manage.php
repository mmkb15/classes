<?php
require_once 'models/prescription.class.php';
$prescriptions = Prescription::readAll();
?>

<div class="main-content-container overflow-hidden">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
        <h3 class="mb-0">Prescription List</h3>
        <a href="?page=prescriptions/create" class="btn btn-primary">+ New Prescription</a>
    </div>

    <div class="card bg-white border-0 rounded-3 mb-4">
        <div class="card-body p-4">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Patient</th>
                        <th>Doctor</th>
                        <th>Date</th>
                        <th>Follow-up</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($prescriptions as $row): ?>
                    <tr>
                        <td><?= $row['id'] ?></td>
                        <td><?= htmlspecialchars($row['patient_name']) ?></td>
                        <td><?= htmlspecialchars($row['doctor_name']) ?></td>
                        <td><?= $row['prescription_date'] ?></td>
                        <td><?= $row['follow_up_date'] ?? 'N/A' ?></td>
                        <td>
                            <a href="?page=prescriptions/view&id=<?= $row['id'] ?>" class="btn btn-sm btn-info">View</a>
                            <a href="?page=prescriptions/print&id=<?= $row['id'] ?>" class="btn btn-sm btn-success" target="_blank">Print</a>
                            <a href="?page=prescriptions/manage&delete_id=<?= $row['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
if(isset($_GET['delete_id'])){
    $res = Prescription::delete($_GET['delete_id']);
    if($res === true){
        echo "<script>window.location='?page=prescriptions/manage';</script>";
    }
}
?>