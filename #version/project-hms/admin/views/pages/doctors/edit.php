
<?php
require_once 'models/doctor.class.php';
require_once 'models/department.class.php';


/* 
  *-------------------------------------------------------------------------
  * Form Submit After Submit
  *-------------------------------------------------------------------------
*/
if(isset($_POST['btn-submit'])){
  $id = $_POST['id'];
  $name = $_POST['name'];
  $dept_id = $_POST['dept_id'];
  $specialization = $_POST['specialization'];
  $phone = $_POST['phone'];
  $email = $_POST['email'];


/* 
  *-------------------------------------------------------------------------
  * From doctor Class
  *-------------------------------------------------------------------------
*/
  $doctor = new doctor($id, $dept_id, $name, $specialization, $phone, $email);
  $res = $doctor->update();
      if($res === true){
      $msg = "Doctor Update Successfully";
      
    }else{
      $msg = $res;
    }  
}

/* 
  *-------------------------------------------------------------------------
  * From department Class
  *-------------------------------------------------------------------------
*/
  $departments = department::readAll();
      // echo '<pre>';
      // print_r($departments);
      // echo '</pre>';

/* 
  *-------------------------------------------------------------------------
  * From doctor Class
  *-------------------------------------------------------------------------
*/
  if(isset($_GET['id'])){
    $row = doctor::readById($_GET['id']); 
      // echo '<pre>';
      // print_r($row);
      // echo '</pre>';

        if(!$row){  // if data not found
        $not_found = true;
    }
  }

?>


    <div class="main-content-container overflow-hidden">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
            <h3 class="mb-0">Edit doctor</h3>
        </div>

        <!-- Message -->
        <?php if(isset($msg)): ?>
        <div class="alert alert-dark alert-dismissible fade show" role="alert">
            <?php echo $msg ?? "" ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php endif; ?>
       
        <!--Prev Button  -->
        <a href="doctors"><button class="btn btn-secondary py-2 px-4 fw-medium fs-16 mb-3" type="submit" name="btn-submit"> <i class="ri-arrow-left-long-line"></i> Back</button></a>

        <div class="card bg-white border-0 rounded-3 mb-4">
            <div class="card-body p-4">

              <?php if(isset($not_found)): ?>
               <h5>Data not found.</h5>
              <?php else: ?>
                <form method="POST">
                    <input type="hidden" name="id" value="<?= $row['id'] ?>">
                    <div class="row">
                        <div class="col-lg-12 col-sm-12">
                            <div class="form-group mb-4">
                                <label class="label text-secondary">Doctor Name</label>
                                <input type="text" name="name"  class="form-control h-60 border-border-color" value="<?= $row['name']; ?>"  >
                            </div>
                        </div>
                        <div class="col-lg-12 col-sm-12">
                            <div class="form-group mb-4">
                                <label class="label text-secondary">Specialty</label>
                                <input type="text" name="specialization" class="form-control h-60 border-border-color" value="<?= $row['specialization']; ?>"  >
                            </div>
                        </div>
                        <div class="col-lg-12 col-sm-12">
                            <div class="form-group mb-4">
                                <label class="label text-secondary">Depertment</label>
                                <select class="form-control h-60 border-border-color" name="dept_id">

                                <!-- Department List(Dropdown) -->
                                <?php foreach($departments as $department) : 
                                  $selected = $department['id'] == $row['department_id'] ? 'selected' : '';  
                                ?>
                                  
                                  <option value="<?= $department['id'] ?>"> <?= $department['name'] ?></option>
                                <?php endforeach; ?>
                              </select>
                            </div>
                        </div>
                        <div class="col-lg-12 col-sm-12">
                            <div class="form-group mb-4">
                                <label class="label text-secondary">Phone</label>
                                <input type="number" name="phone" class="form-control h-60 border-border-color" value="<?= $row['phone']; ?>"  >
                            </div>
                        </div>

                        <div class="col-lg-12 col-sm-12">
                            <div class="form-group mb-4">
                                <label class="label text-secondary">Email</label>
                                <input type="email" name="email" class="form-control h-60 border-border-color" value="<?= $row['email'];?>">
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="d-flex flex-wrap gap-3">
                                <!-- <button class="btn btn-danger py-2 px-4 fw-medium fs-16 text-white">Cancel</button> -->
                                <button class="btn btn-primary py-2 px-4 fw-medium fs-16" type="submit" name="btn-submit"> <i class="ri-add-line text-white fw-medium"></i> Add doctor</button>
                            </div>
                        </div>
                    </div>
                </form>
                <?php endif; ?>
            </div>
        </div>
    </div>


