<?php
require_once 'models/patient.class.php';
require_once 'models/gender.class.php';

// ১. সব জেন্ডার লিস্ট (ড্রপডাউনের জন্য)
$genders = Gender::readAll();

// ২. URL থেকে ID নিন
$id = isset($_GET['id']) ? $_GET['id'] : 0;

// ৩. ওই ID-এর রোগীর ডেটা আনুন (পেজ লোড হওয়ার সময়ই)
$row = Patient::readByID($id);

// ৪. যদি রোগী না পাওয়া যায়
if(!$row) {
    echo "<div class='alert alert-danger'>Patient not found! <a href='?page=patients/manage'>Go Back</a></div>";
    exit;
}

// ৫. ফর্ম সাবমিট হলে আপডেট করুন
if(isset($_POST['btn-submit'])){
    $name = $_POST['name'];
    $age = $_POST['age'];
    $gender_id = $_POST['gender_id'];  // নাম পরিবর্তন করে gender_id করলাম
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    // সঠিকভাবে Patient অবজেক্ট বানান (ID সহ)
    $patient = new Patient($id, $name, $age, $gender_id, $phone, $address);
    $result = $patient->update();

    if($result === true) {
        echo "<div class='alert alert-success'>Patient updated successfully! <a href='?page=patients/manage'>Go to List</a></div>";
        // আপডেটের পর নতুন ডেটা রিলোড
        $row = Patient::readByID($id);
    } else {
        echo "<div class='alert alert-danger'>Error: $result</div>";
    }
}
?>

<div class="main-content-container overflow-hidden">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
        <h3 class="mb-0">Edit Patient</h3>
    </div>

    <div class="card bg-white border-0 rounded-3 mb-4">
        <div class="card-body p-4">
            <form method="POST">
                <input type="hidden" name="id" value="<?= $row['id'] ?>">
                <div class="row">
                    <div class="col-lg-12 col-sm-12">
                        <div class="form-group mb-4">
                            <label class="label text-secondary">Patient Name</label>
                            <input type="text" name="name" class="form-control h-60 border-border-color" 
                                   value="<?= htmlspecialchars($row['name']) ?>" required>
                        </div>
                    </div>
                    <div class="col-lg-12 col-sm-12">
                        <div class="form-group mb-4">
                            <label class="label text-secondary">Age</label>
                            <input type="number" name="age" class="form-control h-60 border-border-color" 
                                   value="<?= $row['age'] ?>">
                        </div>
                    </div>
                    <div class="col-lg-12 col-sm-12">
                        <div class="form-group mb-4">
                            <label class="label text-secondary">Gender</label>
                            <select class="form-control h-60 border-border-color" name="gender_id" required>
                                <option value="">Select Gender</option>
                                <?php foreach($genders as $gender) : 
                                    $selected = ($gender['id'] == $row['gender_id']) ? 'selected' : '';
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
                            <input type="text" name="phone" class="form-control h-60 border-border-color" 
                                   value="<?= $row['phone'] ?>">
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
                            <button class="btn btn-primary py-2 px-4 fw-medium fs-16" type="submit" name="btn-submit">
                                <i class="ri-add-line text-white fw-medium"></i> Update Patient
                            </button>
                            <a href="?page=patients/manage" class="btn btn-secondary py-2 px-4 fw-medium fs-16">Cancel</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>