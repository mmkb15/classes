<?php
require_once 'models/admission.class.php';

$admissions = Admission::readAll();

if(isset($_GET['delete_id'])){
    $res = Admission::delete($_GET['delete_id']);
    if($res === true){
        echo "<script>window.location='?page=admissions/manage';</script>";
    }
}
?>

<div class="main-content-container overflow-hidden">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
        <h3 class="mb-0">Admissions List</h3>
        <a href="?page=admissions/create" class="btn btn-primary py-2 px-4 fw-medium fs-16">+ New Admission</a>
    </div>

    <div class="card bg-white border-0 rounded-3 mb-4">
        <div class="card-body p-20">
            <div class="default-table-area all-products">
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Patient</th>
                                <th scope="col">Room</th>
                                <th scope="col">Admit Date</th>
                                <th scope="col">Discharge Date</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($admissions as $row): ?>
                            <tr>
                                <td><?= $row['id'] ?></td>
                                <td><?= htmlspecialchars($row['patient_name']) ?></td>
                                <td><?= $row['room_no'] ?></td>
                                <td><?= date('d M, Y', strtotime($row['admit_date'])) ?></td>
                                <td><?= $row['discharge_date'] ? date('d M, Y', strtotime($row['discharge_date'])) : 'N/A' ?></td>
                                <td>
                                    <span class="badge <?= ($row['status'] == 'Admitted') ? 'bg-success' : 'bg-secondary' ?>">
                                        <?= $row['status'] ?>
                                    </span>
                                </td>
                                <td>
                                    <a href="?page=admissions/discharge&id=<?= $row['id'] ?>" class="btn btn-sm btn-warning" onclick="return confirm('Discharge this patient?')">Discharge</a>
                                    <a href="?page=admissions/manage&delete_id=<?= $row['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>