<?php
require_once 'models/admission.class.php';

$admissions = Admission::readAll();

/**
 * Handle Delete Request
 */
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

    </div>

    <?php if(isset($msg)): ?>
    <div class="alert alert-dark alert-dismissible fade show" role="alert">
        <?php echo $msg ?? "" ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php endif; ?>

    <div class="card bg-white border-0 rounded-3 mb-4">
        <div class="card-body p-20">
            
            <!-- Add Button -->
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-20">
                <a href="create-admission" class="btn btn-outline-primary fs-14 fw-medium rounded-3 hover-bg" mb-4 style="padding: 1.5px 13px;">
                    <span class="py-sm-1 d-block">
                        <i class="ri-add-line d-none d-sm-inline-block fs-18 position-relative top-1"></i>
                        <span>New Admission</span>
                    </span>
                </a>
            </div>

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
                                <td style="padding-top: 17px; padding-bottom: 17px;">
                                    <div class="d-flex align-items-center">

                                        <!-- Patient Image -->
                                        <?php if (!empty($row['patient_image'])): ?>
                                            <img src="assets/uploads/patients/<?= $row['patient_image'] ?>" 
                                                style="width:40px; height:40px; object-fit:cover; border-radius:50%;" 
                                                alt="Patient">
                                        <?php else: ?>
                                            <img src="assets/images/patients-icon.svg" 
                                                style="width:40px; height:40px; object-fit:cover; border-radius:50%;" 
                                                alt="Default">
                                        <?php endif; ?>

                                        <div class="ms-2 ps-1">
                                            <h6 class="fw-semibold fs-14 mb-0 text-secondary"><?= htmlspecialchars($row['patient_name']) ?></h6>
                                        </div>
                                        
                                    </div>
                                </td>
                                <td><?= $row['room_no'] ?></td>
                                <td><?= date('d M, Y', strtotime($row['admit_date'])) ?></td>
                                <td><?= $row['discharge_date'] ? date('d M, Y', strtotime($row['discharge_date'])) : 'N/A' ?></td>
                                <td>
                                    <span class="badge <?= ($row['status'] == 'Admitted') ? 'bg-success' : 'bg-secondary' ?>">
                                        <?= $row['status'] ?>
                                    </span>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center gap-1">
                                        <!-- Discharge Button (if status is Admitted) -->
                                        <?php if($row['status'] == 'Admitted'): ?>
                                        <a href="?page=admissions/discharge&id=<?= $row['id'] ?>" 
                                           class="ps-0 border-0 bg-transparent lh-1 position-relative top-2" 
                                           title="Discharge Patient"
                                           onclick="return confirm('Are you sure you want to discharge this patient?')">
                                            <i class="material-symbols-outlined fs-18 text-warning">logout</i>
                                        </a>
                                        <?php else: ?>
                                        <span class="ps-0 lh-1 position-relative top-2 opacity-50" title="Already discharged">
                                            <i class="material-symbols-outlined fs-18 text-secondary">logout</i>
                                        </span>
                                        <?php endif; ?>

                                        <!-- Delete Button -->
                                        <a href="?page=admissions/manage&delete_id=<?= $row['id'] ?>" 
                                           class="ps-0 border-0 bg-transparent lh-1 position-relative top-2" 
                                           title="Delete Admission"
                                           onclick="return confirm('Are you sure you want to delete this admission record?')">
                                            <i class="material-symbols-outlined fs-18 text-danger">delete</i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-center justify-content-sm-between align-items-center text-center flex-wrap gap-2 showing-wrap">
                    <span class="fs-12 fw-medium">Showing <?= count($admissions) ?> of <?= count($admissions) ?> Results</span>
                    <nav aria-label="Page navigation example">
                        <ul class="pagination mb-0 justify-content-center">
                            <li class="page-item"><button class="page-link active">1</button></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>