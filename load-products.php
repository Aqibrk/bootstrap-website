
<?php

include "config.php";
session_start();
if(!isset($_SESSION['user_id']) || !isset($_SESSION['email'])){
    echo "<script> alert('Please login');
window.location.href='admin/index.php';
  </script>";

}
error_reporting('0');


// Pagination
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$records_per_page = 4;
$offset = ($page - 1) * $records_per_page;

$sql1 = "SELECT * FROM product LIMIT $offset, $records_per_page";
$result1 = mysqli_query($conn, $sql1);

if (isset($_POST['search'])) {
    $search = $_POST['search'];
    $sql_search = "SELECT * FROM product WHERE product_name LIKE '%$search%'";
    $result_search = mysqli_query($conn, $sql_search);
    // Process search results
}
if (isset($result_search)) {
    if (mysqli_num_rows($result_search) > 0) {
       echo ' <h4 class="alert alert-info text-center">Search Results</h4>';
        while ($row_search = mysqli_fetch_assoc($result_search)) {
            ?>
        
        <div class="container mt-3">
                <div class="alert alert-info text-center">
                  <a href="single-product.php?id=<?php echo $row_search['product_id']; ?>" class="alert-link text-warning-emphasis"><?php echo $row_search['product_name']; ?></a>
                </div>
            </div>
 
         
          
            <?php
        }
    } else {
        echo "<div class='container mt-3'><p class='alert alert-info'>No results found.</p></div>";
    }
}

if (mysqli_num_rows($result1) > 0) {
    ?>
    
  <h3 class="text-center text-warning">Popular Products</h3>
  <hr class="fs-4" style="background-color:red; height: 2px; width:14%;">

    <ul class="rig columns-4">
        <?php while ($row = mysqli_fetch_assoc($result1)) { ?>
            <li>
                <a href="single-product.php?id=<?php echo $row['product_id'] ?>" ><img class="product-image" src="admin/<?php echo $row["product_img"] ?>" oncontextmenu="return false;"></a>
                <h4><?php echo substr($row["product_name"], 0, 20) . '...'; ?></h4>
                <p><?php echo substr($row["product_dec"], 0, 20) . '...'; ?></p>
                <div class="price">Rs:<?php echo $row["product_price"] ?></div>
                <hr>
                <?php if(isset($_SESSION["username"])){ ?>
                    <!-- <button class="btn btn-default btn-xs pull-right" type="button">
                    <a href="card-product.php?id=<?php echo $row['product_id'] ?>" class="text-info"><i
                                class="fa fa-cart-arrow-down text-warning"></i> Add To Cart</a> -->
                </button>
        <?php } ?>
               
                <button class="btn btn-default btn-xs pull-left" type="button">
                    <a href="single-product.php?id=<?php echo $row['product_id'] ?>" class="text-info"><i
                                class="fa fa-eye text-warning" ></i> Details</a>
                </button>
            </li>
        <?php } ?>
    </ul>
    <?php
}
?>
  <!-- Add your JavaScript code here to disable right-click -->
  <script>
        document.addEventListener('contextmenu', function (e) {
            e.preventDefault();
        });
    </script>