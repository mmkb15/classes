
<?php
require_once 'models/patient.class.php';
require_once 'models/gender.class.php';

/* 
  *-------------------------------------------------------------------------
  * Delete From Patient list
  *-------------------------------------------------------------------------
*/
if(isset($_POST['delete_id'])){
  $id = $_POST['delete_id'];
  $res = Patient::delete($id);

  if($res === true){
      $msg = "Patient Deleted Successfully";
    }else{
      $msg = $res;
    }
}

/* 
  *-------------------------------------------------------------------------
  * Patient Registration
  *-------------------------------------------------------------------------
*/
$rows = Patient::readAll();
// echo '<pre>';
// print_r($rows);
// echo '</pre>';

?>



<!-- Start Main Content Area -->
<div class="main-content-container overflow-hidden">
<div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
    <h3 class="mb-0">Patients List</h3>

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
            <a href="create-patient" class="btn btn-outline-primary fs-14 fw-medium rounded-3 hover-bg" style="padding: 1.5px 13px;">
                <span class="py-sm-1 d-block">
                    <i class="ri-add-line d-none d-sm-inline-block fs-18 position-relative top-1"></i>
                    <span>Add New Patient</span>
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
                                        <!-- <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault1"> -->
                                        <label class="position-relative top-2 ms-2" for="flexCheckDefault1">ID</label>
                                    </div>
                                </span>
                            </th>
                            <th scope="col" style="padding-top: 9.5px; padding-bottom: 9.5px;">
                                <span class="text-body-color-50 fs-14 fw-medium">Patient Name</span>
                            </th>
                            <th scope="col" style="padding-top: 9.5px; padding-bottom: 9.5px;">
                                <span class="text-body-color-50 fs-14 fw-medium">Age</span>
                            </th>
                            <th scope="col" style="padding-top: 9.5px; padding-bottom: 9.5px;">
                                <span class="text-body-color-50 fs-14 fw-medium">Gender</span>
                            </th>
                            <th scope="col" style="padding-top: 9.5px; padding-bottom: 9.5px;">
                                <span class="text-body-color-50 fs-14 fw-medium">Phone</span>
                            </th>
                            <th scope="col" style="padding-top: 9.5px; padding-bottom: 9.5px;">
                                <span class="text-body-color-50 fs-14 fw-medium">Address</span>
                            </th>
                            <th scope="col" style="padding-top: 9.5px; padding-bottom: 9.5px;">
                                <span class="text-body-color-50 fs-14 fw-medium">Create Date</span>
                            </th>
                            <th scope="col" style="padding-top: 9.5px; padding-bottom: 9.5px;">
                                <span class="text-body-color-50 fs-14 fw-medium">Action</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        <?php foreach($rows as $item) : ?>
                        <tr>
                            <td style="padding-top: 17px; padding-bottom: 17px;">
                                <div class="form-check d-flex align-items-center">
                                    <!-- <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault2"> -->
                                    <label class="position-relative top-2 ms-2 fw-semibold fs-12" for="flexCheckDefault2"><?= $item['id'] ?></label>
                                </div>
                            </td>
                            <td style="padding-top: 17px; padding-bottom: 17px;">
                                <a href="patient-history?id=<?= $item['id'] ?>" class="d-flex align-items-center">
                                    <!-- <img src="assets/images/user-134.png" class="wh-30 rounded-3" alt="user"> -->
                                    <div class="ms-2 ps-1">
                                        <h6 class="fw-semibold fs-14 mb-0 text-secondary"><?= $item['name'] ?></h6>
                                    </div>
                                </a>
                            </td>
                            <td class="text-primary fs-12 fw-normal" style="padding-top: 17px; padding-bottom: 17px;"><?= $item['age'] ?></td>
                            <td class="text-body-color-50 fs-12 fw-semibold" style="padding-top: 17px; padding-bottom: 17px;"><?= $item['gender_name'] ?></td>
                            <td class="text-body-color-50 fs-12 fw-semibold" style="padding-top: 17px; padding-bottom: 17px;"><?= $item['phone'] ?></td>
                            <td class="text-body-color-50 fs-12 fw-semibold" style="padding-top: 17px; padding-bottom: 17px;"><?= $item['address'] ?></td>
                            <td class="text-body-color-50 fs-12 fw-semibold" style="padding-top: 17px; padding-bottom: 17px;"><?= $item['created_at'] ?></td>
                            <td style="padding-top: 17px; padding-bottom: 17px;">
                                <div class="d-flex align-items-center gap-1">

                                    <!-- Patient Edit Button -->
                                    <a href="edit-patient?id=<?= $item['id'] ?>"><button class="ps-0 border-0 bg-transparent lh-1 position-relative top-2">
                                        <i class="material-symbols-outlined fs-18 text-body">edit</i>
                                    </button></a>

                                    <!-- Patient Delete Button -->
                                    <form method="POST">
                                    <input type="hidden" name="delete_id" value="<?= $item['id'] ?>">
                                    <button type="submit" class="ps-0 border-0 bg-transparent lh-1 position-relative top-2">
                                        <i class="material-symbols-outlined fs-18 text-danger">delete</i>
                                    </button>
                                    </form>
                                    
                                    <!-- History Button  -->       
                                    <a href="patient-history?id=<?= $item['id'] ?>">
                                        <button class="ps-0 border-0 bg-transparent lh-1 position-relative top-2" title="View History">
                                            <i class="material-symbols-outlined fs-18 text-info">history</i>
                                        </button>
                                    </a>
                                    
                                </div>
                            </td> 
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center justify-content-sm-between align-items-center text-center flex-wrap gap-2 showing-wrap">
                <span class="fs-12 fw-medium">Showing 10 of 30 Results</span>

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





