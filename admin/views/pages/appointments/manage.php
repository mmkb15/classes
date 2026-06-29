<?php
require_once 'models/appointment.class.php';

/* 
  *-------------------------------------------------------------------------
  * Delete From appointment list
  *-------------------------------------------------------------------------
*/
if(isset($_POST['delete_id'])){
    $id = $_POST['delete_id'];
    $res = Appointment::delete($id);

    if($res === true){
        $msg = "Appointment Deleted Successfully";
    } else {
        $msg = $res;
    }
}

/* 
  *-------------------------------------------------------------------------
  * Get all appointments
  *-------------------------------------------------------------------------
*/
$appointments = Appointment::readAll();

// Debug (optional)
// echo '<pre>';
// print_r($appointments);
// echo '</pre>';
?>

<!-- Start Main Content Area -->
<div class="main-content-container overflow-hidden">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
        <h3 class="mb-0">Appointments List</h3>
    </div>

    <!-- Message -->
    <?php if(isset($msg)): ?>
    <div class="alert alert-dark alert-dismissible fade show" role="alert">
        <?php echo $msg ?? "" ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php endif; ?>

    <div class="card bg-white border-0 rounded-3 mb-4">
        <div class="card-body p-20">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-20">
                <a href="?page=appointments/create" class="btn btn-outline-primary fs-14 fw-medium rounded-3 hover-bg" style="padding: 1.5px 13px;">
                    <span class="py-sm-1 d-block">
                        <i class="ri-add-line d-none d-sm-inline-block fs-18 position-relative top-1"></i>
                        <span>Add New Appointment</span>
                    </span>
                </a>
            </div> 

            <div class="default-table-area all-products">
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead>
                            <tr>
                                <th scope="col" style="padding-top: 9.5px; padding-bottom: 9.5px;">
                                    <span class="text-body-color-50 fs-14 fw-medium">
                                        <div class="form-check d-flex align-items-center">
                                            <label class="position-relative top-2 ms-2" for="flexCheckDefault1">ID</label>
                                        </div>
                                    </span>
                                </th>
                                <th scope="col" style="padding-top: 9.5px; padding-bottom: 9.5px;">
                                    <span class="text-body-color-50 fs-14 fw-medium">Patient</span>
                                </th>
                                <th scope="col" style="padding-top: 9.5px; padding-bottom: 9.5px;">
                                    <span class="text-body-color-50 fs-14 fw-medium">Doctor</span>
                                </th>
                                <th scope="col" style="padding-top: 9.5px; padding-bottom: 9.5px;">
                                    <span class="text-body-color-50 fs-14 fw-medium">Date</span>
                                </th>
                                <th scope="col" style="padding-top: 9.5px; padding-bottom: 9.5px;">
                                    <span class="text-body-color-50 fs-14 fw-medium">Status</span>
                                </th>
                                <th scope="col" style="padding-top: 9.5px; padding-bottom: 9.5px;">
                                    <span class="text-body-color-50 fs-14 fw-medium">Action</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($appointments as $row): ?>
                            <tr>
                                <td style="padding-top: 17px; padding-bottom: 17px;">
                                    <div class="form-check d-flex align-items-center">
                                        <label class="position-relative top-2 ms-2 fw-semibold fs-12" for="flexCheckDefault2"><?= $row['id'] ?></label>
                                    </div>
                                </td>
                                <td style="padding-top: 17px; padding-bottom: 17px;">
                                    <a href="#" class="d-flex align-items-center">

                                        <!-- image -->
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
                                    </a>
                                </td>
                                <td class="text-primary fs-12 fw-normal" style="padding-top: 17px; padding-bottom: 17px;">
                                    <?= htmlspecialchars($row['doctor_name']) ?>
                                </td>
                                <td class="text-body-color-50 fs-12 fw-semibold" style="padding-top: 17px; padding-bottom: 17px;">
                                    <?= date('d M, Y', strtotime($row['appointment_date'])) ?>
                                </td>
                                <td style="padding-top: 17px; padding-bottom: 17px;">
                                    <?php 
                                    $status_class = '';
                                    if($row['status'] == 'Scheduled') {
                                        $status_class = 'bg-primary';
                                    } elseif($row['status'] == 'Completed') {
                                        $status_class = 'bg-success';
                                    } elseif($row['status'] == 'Cancelled') {
                                        $status_class = 'bg-danger';
                                    } else {
                                        $status_class = 'bg-secondary';
                                    }
                                    ?>
                                    <span class="badge <?= $status_class ?> fs-12 fw-semibold">
                                        <?= $row['status'] ?>
                                    </span>
                                </td>
                                <td style="padding-top: 17px; padding-bottom: 17px;">
                                    <div class="d-flex align-items-center gap-1">
                                        <!-- View Button (optional) -->
                                        <a href="?page=appointments/view&id=<?= $row['id'] ?>">
                                            <button class="ps-0 border-0 bg-transparent lh-1 position-relative top-2">
                                                <i class="material-symbols-outlined fs-18 text-primary">visibility</i>
                                            </button>
                                        </a>

                                        <!-- Edit Button -->
                                        <a href="?page=appointments/edit&id=<?= $row['id'] ?>">
                                            <button class="ps-0 border-0 bg-transparent lh-1 position-relative top-2">
                                                <i class="material-symbols-outlined fs-18 text-body">edit</i>
                                            </button>
                                        </a>

                                        <!-- Delete Button (POST Form) -->
                                        <form method="POST">
                                            <input type="hidden" name="delete_id" value="<?= $row['id'] ?>">
                                            <button type="submit" class="ps-0 border-0 bg-transparent lh-1 position-relative top-2" onclick="return confirm('Are you sure you want to delete this appointment?')">
                                                <i class="material-symbols-outlined fs-18 text-danger">delete</i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-center justify-content-sm-between align-items-center text-center flex-wrap gap-2 showing-wrap">
                    <span class="fs-12 fw-medium">Showing <?= count($appointments) ?> of <?= count($appointments) ?> Results</span>

                    <nav aria-label="Page navigation example">
                        <ul class="pagination mb-0 justify-content-center">
                            <li class="page-item">
                                <button class="page-link icon hover-bg" aria-label="Previous">
                                    <i class="material-symbols-outlined">keyboard_arrow_left</i>
                                </button>
                            </li>
                            <li class="page-item">
                                <button class="page-link active">1</button>
                            </li>
                            <li class="page-item">
                                <button class="page-link">2</button>
                            </li>
                            <li class="page-item">
                                <button class="page-link">3</button>
                            </li>
                            <li class="page-item">
                                <button class="page-link">4</button>
                            </li>
                            <li class="page-item">
                                <button class="page-link icon hover-bg" aria-label="Next">
                                    <i class="material-symbols-outlined">keyboard_arrow_right</i>
                                </button>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>