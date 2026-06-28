<?php
require_once 'models/product.class.php';


if (isset($_POST["delete_id"])) {
    $id = $_POST['delete_id'];
    // echo $id;
    $res = User::delete($id);
    if ($res === true) {
        $msg = "User deleted successfully";
    } else {
        $msg = $res;
    }
}

$rows = Product::readAll();
// echo "<pre>";
// print_r($rows);
// echo "</pre>";

?>
<style>
    .main-sidebar,
    .main-header,
    .main-footer {
        display: none;
    }

    .content-wrapper {
        margin-left: 0 !important;
    }
</style>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>POS</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="products" class="btn btn-sm btn-dark">&leftarrow; Back to Products</a></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-8">
                    <!-- Products -->
                    <div class="row">
                        <?php foreach ($rows as $item) : 
                          if($item['active'] == 0) continue;
                          ?>
                        <div class="col-lg-4 col-sm-6">
                            <div class="card" style="cursor: pointer;" onclick="addToCart(<?= $item['id'] ?>,'<?= $item['name'] ?>',<?= $item['price'] ?>)">
                                <img height="300" style="object-fit: cover; object-position:top;" src="<?= BASE_URL_ADMIN . $item['image'] ?>" alt="">
                                <div class="card-body">
                                    <h5 class="mb-3"><?= $item['name'] ?></h5>
                                    <h4 class="card-text"><?= $item['price'] ?></h4>
                                </div>
                            </div>
                        </div>
                        <?php endforeach ?>
                    </div>

                </div>

                <!-- Cart -->
                <div class="col-4">
                    <table class="table table-bordered">
                        <tr>
                            <th>Items</th>
                            <th>QTY</th>
                            <th>Amount</th>
                            <th></th>
                        </tr>
                        <tbody id="cartTbody">
                        <tr>
                            <td>Product Name</td>
                            <td>4</td>
                            <td>1200</td>
                            <td><a href=""><i class="fa fa-trash text-danger"></i></a></td>
                        </tr>

                        </tbody>
                        <tr>
                            <th colspan="2">Total</th>
                            <th id="cartTotal">1200</th>
                            <th></th>
                        </tr>
                    </table>
                </div>

            </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>

<script src= "<?= BASE_URL_ADMIN ?>helpers/cart-helper.js"></script>
<script>
    var cart = new CartHelper("cart");
    // console.log(cart);
    function printCart(){
        console.log("My Items");
        console.log(cart.getCart());
        var items = cart.getCart();
        var html = "";
        var total = 0;
        items.forEach(item => {
            html += `
            <tr>
                <td>${item.name}</td>
                <td>${item.quantity}</td>
                <td>${item.quantity * item.price}</td>
                <td><a href="javascript:;" onclick="removeFromCart(${item.id});"><i class="fa fa-trash text-danger"></i></a></td>
            </tr>
            `;
            total +=(item.quantity * item.price);
        });
        document.querySelector("#cartTbody").innerHTML = html;  
        document.querySelector("#cartTotal").innerHTML = total;  
    }
    printCart();
    function addToCart(id,name,price){
        cart.addItem(id,name,price);
        printCart();
    }
    
    function removeFromCart(id){
      cart.removeItem(id);
      printCart();
    }
</script>