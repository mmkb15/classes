<?php
require_once 'models/billing.class.php';

/**
 * Handle Delete Request
 */
if(isset($_POST['delete_id'])){
    $id = $_POST['delete_id'];
    $res = Billing::delete($id);

    if($res === true){
        $msg = "Bill deleted successfully!";
    } else {
        $msg = $res;
    }
}

/**
 * Get all bills
 */
$billings = Billing::readAll();
?>

<div class="main-content-container overflow-hidden">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
        <h3 class="mb-0">Billing List</h3>
        <a href="?page=billings/create" class="btn btn-primary py-2 px-4 fw-medium fs-16">+ Generate New Bill</a>
    </div>

    <!-- Display Message -->
    <?php if(isset($msg)): ?>
    <div class="alert alert-dark alert-dismissible fade show" role="alert">
        <?php echo $msg ?? "" ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php endif; ?>

    <div class="card bg-white border-0 rounded-3 mb-4">
        <div class="card-body p-20">
            <div class="default-table-area all-products">
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead>
                            <tr>
                                <th scope="col">Bill ID</th>
                                <th scope="col">Patient</th>
                                <th scope="col">Admission ID</th>
                                <th scope="col">Amount (BDT)</th>
                                <th scope="col">Bill Date</th>
                                <th scope="col">Description</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($billings as $row): ?>
                            <tr>
                                <td><?= $row['id'] ?></td>
                                <td><?= htmlspecialchars($row['patient_name']) ?></td>
                                <td><?= $row['admission_id'] ?? 'N/A' ?></td>
                                <td><?= $row['amount'] ?></td>
                                <td><?= date('d M, Y', strtotime($row['bill_date'])) ?></td>
                                <td><?= htmlspecialchars($row['description']) ?></td>
                                <td>
                                    <div class="d-flex align-items-center gap-1">
                                        <!-- Edit Button -->
                                        <a href="?page=billings/edit&id=<?= $row['id'] ?>">
                                            <button class="ps-0 border-0 bg-transparent lh-1 position-relative top-2">
                                                <i class="material-symbols-outlined fs-18 text-body">edit</i>
                                            </button>
                                        </a>

                                        <!-- Delete Button -->
                                        <form method="POST">
                                            <input type="hidden" name="delete_id" value="<?= $row['id'] ?>">
                                            <button type="submit" class="ps-0 border-0 bg-transparent lh-1 position-relative top-2" onclick="return confirm('Are you sure you want to delete this bill?')">
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
            </div>
        </div>
    </div>
</div>