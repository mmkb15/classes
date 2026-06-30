
<?php
require_once 'models/patient.class.php';
require_once 'models/gender.class.php';

/* 
  *-------------------------------------------------------------------------
  * Form Submit After Submit
  *-------------------------------------------------------------------------
*/
if(isset($_POST['btn-submit'])){
  $id = $_POST['id'];
  $name = $_POST['name'];
  $age = $_POST['age'];
  $gender = $_POST['gender'];
  $phone = $_POST['phone'];
  $address = $_POST['address'];
  // echo  $name . $age . $gender . $phone . $address;


/* 
  *-------------------------------------------------------------------------
  * From Patient Class
  *-------------------------------------------------------------------------
*/
  $patient = new Patient($id, $name, $age, $gender, $phone, $address);
  $res = $patient->update();
      if($res === true){
      $msg = "Patient Update Successfully";
      
    }else{
      $msg = $res;
    }  
}

/* 
  *-------------------------------------------------------------------------
  * From Gender Class
  *-------------------------------------------------------------------------
*/
  $genders = Gender::readAll();
      // echo '<pre>';
      // print_r($genders);
      // echo '</pre>';

/* 
  *-------------------------------------------------------------------------
  * From Patient Class
  *-------------------------------------------------------------------------
*/
  if(isset($_GET['id'])){
    $row = Patient::readById($_GET['id']); 
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
            <h3 class="mb-0">Edit Patient</h3>
        </div>

        <!-- Message -->
        <?php if(isset($msg)): ?>
        <div class="alert alert-dark alert-dismissible fade show" role="alert">
            <?php echo $msg ?? "" ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php endif; ?>
       
        <!--Prev Button  -->
        <a href="patients"><button class="btn btn-secondary py-2 px-4 fw-medium fs-16 mb-3" type="submit" name="btn-submit"> <i class="ri-arrow-left-long-line"></i> Back</button></a>

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
                                <label class="label text-secondary">Patient Name</label>
                                <input type="text" name="name"  class="form-control h-60 border-border-color" value="<?= $row['name']; ?>"  >
                            </div>
                        </div>
                        <div class="col-lg-12 col-sm-12">
                            <div class="form-group mb-4">
                                <label class="label text-secondary">Age</label>
                                <input type="number" name="age" class="form-control h-60 border-border-color" value="<?= $row['age']; ?>"  >
                            </div>
                        </div>
                        <div class="col-lg-12 col-sm-12">
                            <div class="form-group mb-4">
                                <label class="label text-secondary">Gender</label>
                                <select class="form-control h-60 border-border-color" name="gender">

                                // Gender List(Dropdown)
                                <?php foreach($genders as $gender) : 
                                  $selected = $gender['id'] == $row['gender_id'] ? 'selected' : '';  
                                ?>
                                  
                                  <option value="<?= $gender['id'] ?>" <?= $selected ?>>  
                                  <?= $gender['name'] ?>
                                  </option>

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

                        <div class="col-lg-12">
                          <div class="form-group mb-4">
                              <label class="label text-secondary">Address</label>
                              <textarea name="address" rows="3" class="form-control"><?= htmlspecialchars($row['address']) ?></textarea>
                          </div>
                      </div>

                        <div class="col-lg-12">
                            <div class="d-flex flex-wrap gap-3">
                                <!-- <button class="btn btn-danger py-2 px-4 fw-medium fs-16 text-white">Cancel</button> -->
                                <button class="btn btn-primary py-2 px-4 fw-medium fs-16" type="submit" name="btn-submit"> <i class="ri-edit-2-line"></i> Update Patient</button>
                            </div>
                        </div>
                    </div>
                </form>
                <?php endif; ?>
            </div>
        </div>
    </div>


