<?php 
session_start();
if (!isset($_SESSION['user_id']) || !isset($_SESSION['email'])) {
    header("location:index.php");
    exit; // Added to stop script execution after redirection
}
include('config.php');
include('header.php');

include "serach.php";
include "modal.php";

$cart = $_SESSION['cart'];
?>
 
<div class="container">
    <h2 class="text-center text-white">Cart</h2>

    <div class="table-responsive">
        <table class="table table-bordered bg-white">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $total = 0;
                foreach($cart as $key => $value){
                    $sql1 = "SELECT * FROM product where product_id = $key";
                    $result1 = mysqli_query($conn, $sql1);
                    $row = mysqli_fetch_assoc($result1);
                ?>
                <tr>
                    <td class="text-center"><img src="admin/<?php echo $row["product_img"] ?>" height="50"></td>
                    <td><a class="text-info" href="single-product.php?id=<?php echo $row['product_id'] ?>"><?php echo substr($row["product_name"], 0, 20) . '...'; ?></a></td>
                    <td>Rs:<?php echo $row["product_price"] ?></td>
                    <td><?php echo $value['quantity']; ?></td>
                    <td><?php echo $row["product_price"] * $value['quantity']; ?></td>
                    <td><a href="remove_item.php?id=<?php echo $key; ?>" class="text-danger">Remove</a></td>
                </tr>
                <?php
                    $total += ($row["product_price"] * $value['quantity']);
                }   
                ?>
            </tbody>
        </table>
    </div>

    <div class="text-center" >
        <!-- <a href="update_cart.php" class="btn btn-info mr-3">Update Cart</a>
        <a href="checkout.php" class="btn btn-primary">Checkout</a> -->
        <div class="card mt-3"  style="height:80px;">
            <div class="card-body">
                Total Amount: Rs <?php echo number_format($total, 2); ?>
            </div>
        </div>
    </div>
</div>

<?php
include "footer.php";
?>
