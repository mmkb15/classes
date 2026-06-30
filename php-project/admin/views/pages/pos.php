<?php
if($_SESSION['role_id'] == 3 || $_SESSION['role_id'] == 4){
    header("location: access-deny");
}


require_once 'models/product.class.php';
require_once 'models/order.class.php';
require_once 'models/category.class.php';

$categories = Category::readAll();
$rows = Product::readAll();
// echo '<pre>';
// print_r($categories);
// echo '</pre>';

if (isset($_POST['checkout'])) {
    $cart = json_decode($_POST['checkout']);
    // echo "<pre>";
    // print_r($cart);
    // echo "</pre>";

    $order = new Order();
    $order->create($cart);
    echo "
        <script>
            window.addEventListener('afterprint', () => {
                localStorage.removeItem('cart');
            });
            window.print();
        </script>
    ";
}
?>

<style>
    .main-sidebar,
    .main-header,
    .main-footer {
        display: none;
    }

    .content-wrapper {
        margin-left: 0px !important;
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
                        <li class="breadcrumb-item active"><a href="products" class="btn btn-sm btn-dark">&larr; Back to Products</a></li>
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
                    <div>
                        <select class="form-control mb-3" id="categoryFilter" style="width: 200px">
                            <option value="0">All</option>
                            <?php foreach ($categories as $category): ?>
                                <option value="<?= $category['id']; ?>"><?= $category['name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="row" id="productList">
                        <?php
                        foreach ($rows as $item):
                            // if ($item['active'] == 0) {
                            //     continue;
                            // }
                        ?>
                            <div class="col-lg-3 col-sm-6">
                                <div class="card" style="cursor: pointer"
                                    onclick="addToCart(<?= $item['id']; ?>,'<?= $item['name']; ?>',<?= $item['price']; ?>)">
                                    <img src="<?= BASE_URL_ADMIN . $item['image']; ?>" alt="" height="200" class="card-img p-3">
                                    <div class="card-body text-center">
                                        <h6><?= $item['name']; ?></h6>
                                        <h5 class="card-text">BDT <?= $item['price']; ?></h5>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <!-- /.card -->
                </div>
                <div class="col-4">
                    <table class="table table-border">
                        <tr class="table-secondary">
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
                        <tr class="table-secondary">
                            <th colspan="2">Total</th>
                            <th id="cartTotal">0</th>
                            <th></th>
                        </tr>
                    </table>
                    <form action="" method="POST" class="text-right">
                        <input type="hidden" name="checkout" id="cartInput">
                        <button type="submit" class="btn btn-success">Checkout</button>
                    </form>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<style>
    @media screen {
        .receipt{
            display: none !important;
        }
    }
    @media print {
        .receipt{
            display: block !important;
        }
        .content-wrapper{
            display: none !important;
        }
    }
</style>
<div class="receipt" style="width: 300px; margin: 0 auto;">
    <style>
        #printCartTbody .btn-delete {
            display: none;
        }
    </style>
    <div class="text-center">
        <h5>E-COM</h5>
        <p>Date: 2026-05-12</p>
    </div>
    <table class="table table-border">
        <tr class="table-secondary">
            <th>Items</th>
            <th>QTY</th>
            <th>Amount</th>
        </tr>
        <tbody id="printCartTbody">
        </tbody>
        <tr class="table-secondary">
            <th colspan="2">Total</th>
            <th id="printCartTotal">0</th>
        </tr>
    </table>
</div>

<script src="<?= BASE_URL_ADMIN; ?>assets/js/jquery-4.0.0.min.js"></script>
<script>
    $("#categoryFilter").on("change", function() {
        // console.log($(this).val());
        // let categoryId = $("#categoryFilter").val();
        let categoryId = $(this).val();
        // console.log(categoryId);
        $.ajax({
            // url: "api/get-products?id=" + categoryId,
            url: `api/get-products?category_id=${categoryId}`,
            type: "get",
            success: function(response) {
                let products = JSON.parse(response);
                // console.log(products);
                let html = "";
                products.forEach(item => {
                    html += `
                    <div class="col-lg-3 col-sm-6">
                        <div class="card" style="cursor: pointer"
                            onclick="addToCart(${item['id']},'${item['name']}',${item['price']})">
                            <img src="<?= BASE_URL_ADMIN; ?>${item['image']}" alt="" height="200" class="card-img p-3">
                            <div class="card-body text-center">
                                <h6>${item['name']}</h6>
                                <h5 class="card-text">BDT ${item['price']}</h5>
                            </div>
                        </div>
                    </div>
                    `;
                });
                // console.log(html);
                $("#productList").html(html);
            },
            error: function(error) {
                console.log(error);
            }
        });
    });
</script>

<script src="<?= BASE_URL_ADMIN; ?>helpers/cart-helper.js"></script>
<script>
    var cart = new CartHelper("cart");
    // console.log(cart);
    function printCart() {
        var items = cart.getCart();
        document.querySelector("#cartInput").value = JSON.stringify(items);
        var html = "";
        var total = 0;
        items.forEach(item => {
            html += `
            <tr>
                <td>${item.name}</td>
                <td>${item.quantity}</td>
                <td>${item.quantity * item.price}</td>
                <td class="btn-delete"><a href="javascript:;" onclick="removeFromCart(${item.id})"><i class="fa fa-trash text-danger"></i></a></td>
            </tr>
            `;
            total += (item.quantity * item.price);
        });
        document.querySelector("#cartTbody").innerHTML = html;
        document.querySelector("#cartTotal").innerHTML = total;
        document.querySelector("#printCartTbody").innerHTML = html;
        document.querySelector("#printCartTotal").innerHTML = total;
    }
    printCart();

    function removeFromCart(id) {
        cart.removeItem(id);
        printCart();
    }

    function addToCart(id, name, price) {
        cart.addItem(id, name, price);
        printCart();
    }
</script>