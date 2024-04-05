<?php 
include "config.php";
session_start();
if (!isset($_SESSION['user_id']) || !isset($_SESSION['email'])) {
    header("location:admin/index.php");
    exit; // Added to stop script execution after redirection
}

include "admin/config.php";
include "header.php";
include "nav.php";
include "modal.php";
?>

<style>
    .pagination-container {
        margin-top: 20px;
        display: flex;
        justify-content: center;
    }

    .pagination {
        display: inline-block;
    }

    .pagination li {
        display: inline;
        margin: 0 5px;
    }

    .pagination li a {
        color: #007bff;
        border: 1px solid #007bff;
        padding: 5px 10px;
        text-decoration: none;
        border-radius: 5px;
    }

    .pagination li.active a {
        background-color: #007bff;
        color: #fff;
    }
</style>

<?php
// Define variables for pagination
$limit = 10; // Number of products per page
$page = isset($_GET['page']) ? $_GET['page'] : 1; // Current page, default is 1
$start = ($page - 1) * $limit; // Offset for SQL query

if (isset($_GET['id'])) {
    $category_id = $_GET['id'];
    include "serach.php";
    // Fetch category name
    $sql_category = "SELECT * FROM category WHERE cat_id = '$category_id'";
    $result_category = mysqli_query($conn, $sql_category);

    if (mysqli_num_rows($result_category) > 0) {
        $category_row = mysqli_fetch_assoc($result_category);
        $category_name = $category_row['cat_name'];

        // Fetch total number of products for pagination
        $sql_count = "SELECT COUNT(*) AS total FROM product WHERE cat_id = '$category_id'";
        $result_count = mysqli_query($conn, $sql_count);
        $row_count = mysqli_fetch_assoc($result_count);
        $total_pages = ceil($row_count['total'] / $limit); // Calculate total pages

        // Fetch products for the specified category with pagination
        $sql_products = "SELECT * FROM product WHERE cat_id = '$category_id' LIMIT $start, $limit";
        $result_products = mysqli_query($conn, $sql_products);

        if (mysqli_num_rows($result_products) > 0) {
            echo '<div class="content mt-5">';
            echo '<ul class="rig columns-4">';
            echo "<h2 class='text-center'>$category_name</h2>";
            echo"<hr class=''>";
            while ($product_row = mysqli_fetch_assoc($result_products)) {
                echo '<li>';
                echo '<a href="single-product.php?id=' . $product_row['product_id'] . '"><img class="product-image" src="admin/' . $product_row["product_img"] . '"></a>';
                echo '<h6>' . substr($product_row["product_name"], 0, 20) . '...</h6>';
                echo '<p>' . substr($product_row["product_dec"], 0, 20) . '...</p>';
                echo '<div class="price">Rs:' . $product_row["product_price"] . '</div>';
                echo '<hr>';
                echo '<a href="single-product.php?id=' . $product_row['product_id'] . '"  class="text-info">Buy Now</a>';
                echo '<button class="btn btn-default btn-xs pull-left" type="button" >';
                echo '<a href="single-product.php?id=' . $product_row['product_id'] . '"><i class="fa fa-eye text-warning"></i> Details</a>';
                echo '</button>';
                echo '</li>';
            }
            echo '</ul>';

            // Pagination links with colorful styling
            echo '<div class="text-center mt-4 pagination-container">';
            echo '<ul class="pagination">';
            for ($i = 1; $i <= $total_pages; $i++) {
                $active_class = ($page == $i) ? 'active' : '';
                echo '<li class="page-item ' . $active_class . '"><a class="page-link" href="?id=' . $category_id . '&page=' . $i . '">' . $i . '</a></li>';
            }
            echo '</ul>';
            echo '</div>';

            echo '</div>';
        } else {
            echo '<p class="text-center text-info m-5">No products found for this category.</p>';
        }
    } else {
        echo '<p>Invalid category ID.</p>';
    }
} else {
    echo '<p>No category ID specified.</p>';
}

include "footer.php";
?>
