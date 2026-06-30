
<?php
require_once 'models/patient.class.php';
require_once 'models/gender.class.php';

/* 
  *-------------------------------------------------------------------------
  * Gender List(Dropdown)
  *-------------------------------------------------------------------------
*/
$genders = Gender::readAll();

// echo '<pre>';
// print_r($genders);
// echo '</pre>';


/* 
  *-------------------------------------------------------------------------
  * Form Submit After Submit
  *-------------------------------------------------------------------------
*/

if(isset($_POST['btn-submit'])){
  $name = $_POST['name'];
  $age = $_POST['age'];
  $gender = $_POST['gender'];
  $phone = $_POST['phone'];
  $address = $_POST['address'];

  // echo $name . $age . $gender . $phone . $address;


/* 
  *-------------------------------------------------------------------------
  * Patient Registration
  *-------------------------------------------------------------------------
*/
  $patient = new Patient(null, $name, $age, $gender, $phone, $address);
  $res = $patient->create();  
    if($res === true){
      $msg = "Paitent Created Successfully";
      
    }else{
      $msg = $res;
    }
}

?>


    <div class="main-content-container overflow-hidden">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
            <h3 class="mb-0">Add New Patient</h3>
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
                <form method="POST">
                    <div class="row">
                        <div class="col-lg-12 col-sm-12">
                            <div class="form-group mb-4">
                                <label class="label text-secondary">Patient Name</label>
                                <input type="text" name="name" class="form-control h-60 border-border-color" placeholder="Enter Name">
                            </div>
                        </div>
                        <div class="col-lg-12 col-sm-12">
                            <div class="form-group mb-4">
                                <label class="label text-secondary">Age</label>
                                <input type="number" name="age" class="form-control h-60 border-border-color" placeholder="Your Age">
                            </div>
                        </div>
                        <div class="col-lg-12 col-sm-12">
                            <div class="form-group mb-4">
                                <label class="label text-secondary">Gender</label>
                                <select class="form-control h-60 border-border-color" name="gender">

                                 <!-- Gender List(Dropdown) -->
                                <?php foreach($genders as $gender) : 
                                  $selected = $gender['id'] == $row['gender_id'] ? 'selected' : '';  
                                ?>
                                  
                                  <option value="<?= $gender['id'] ?>"> <?= $gender['name'] ?></option>
                                <?php endforeach; ?>
                              </select>
                            </div>
                        </div>
                        <div class="col-lg-12 col-sm-12">
                            <div class="form-group mb-4">
                                <label class="label text-secondary">Phone</label>
                                <input type="number" name="phone" class="form-control h-60 border-border-color" placeholder="Your Contact Number">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group mb-4">
                                <label class="label text-secondary">Address</label>
                                <textarea  name="address" rows="3" class="form-control" placeholder="Enter Your Address"></textarea>
                            </div>
                        </div>
                        <!-- <div class="col-lg-12">
                            <div class="mb-4">
                                <label class="label text-secondary">Add Avatar</label>
                                <div class="d-fslex align-items-center">
                                    <div class="avatar-upload mw-100">
                                        <div class="mb-2">
                                            <input type="file" id="imageUpload" class="form-control h-60" accept=".png, .jpg, .jpeg" style="padding-top: 18px;">
                                        </div>
                                        <span class="fs-12 mb-4 d-block">Please upload your image with a size of 135 x 135</span>
                                        <div class="avatar-preview rounded-circle border-0">
                                            <div id="imagePreview" class="rounded-circle" style="background-image: url(assets/images/user-144.png);"></div>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div> -->
                        <div class="col-lg-12">
                            <div class="d-flex flex-wrap gap-3">
                                <!-- <button class="btn btn-danger py-2 px-4 fw-medium fs-16 text-white">Cancel</button> -->
                                <button class="btn btn-primary py-2 px-4 fw-medium fs-16" type="submit" name="btn-submit"> <i class="ri-add-line text-white fw-medium"></i> Add Patient</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


