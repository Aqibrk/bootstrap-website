<?php 
include "config.php";
session_start();
if (!isset($_SESSION['user_id']) || !isset($_SESSION['email'])) {
    header("location:admin/index.php");
    exit; // Added to stop script execution after redirection
}

?>
      <?php
      include "header.php";
include "nav.php";
include "admin/config.php";

if (isset($_GET['id'])) {
    $product_id = $_GET['id'];
    $sql = "SELECT * FROM product  WHERE product_id = '$product_id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    // Check if product exists
    if ($row) {
        // Fetch additional data from another table (e.g., category table)
        $category_id = $row['cat_id'];
        $sql_category = "SELECT * FROM category WHERE cat_id = '$category_id'";
        $result_category = mysqli_query($conn, $sql_category);
        $category_row = mysqli_fetch_assoc($result_category);

       include "serach.php";
include "modal.php";

?>

<div class="container">
    <div class="product-details row">
        <div class="product-image col-md-6">
            <img src="admin/<?php echo $row["product_img"] ?>" alt="Product Image" class="mt-3">
        </div>
        <div class="product-info col-md-6">
            <h1 class="product-title mt-2"><?php echo $row["product_name"] ?></h1>
            <p class="product-price mt-2">
                <b>Price:</b> Rs. 4000
                <?php
                $discount_percentage = 10; // Example discount percentage
                $discounted_price = $row["product_price"] - ($row["product_price"] * ($discount_percentage / 100));
                echo '<span class="text-danger"> (Discounted Price: Rs. ' . $discounted_price . ')</span>';
                ?>
            </p>
            <p class="product-category mt-2"><b>Category:</b> <?php echo $category_row["cat_name"] ?></p>
            <p class="product-description mt-2"><b>Product Description:</b> <?php echo $row["product_dec"] ?></p>
            <p class="product-quantity"><b>Available Quantity:</b> <?php echo $row["product_qunty"] ?></p>
            <div class="ratings mt-3">
         <span class="fa fa-star" data-rating="1"></span>
        <span class="fa fa-star" data-rating="2"></span>
        <span class="fa fa-star" data-rating="3"></span>
        <span class="fa fa-star" data-rating="4"></span>
        <span class="fa fa-star" data-rating="5"></span>
        <input type="hidden" name="rating" id="rating" value="0">
        <span class="rating-text">(0.0)</span>
    </div><br>
            <!-- Quantity selection -->
            <form action="card-product.php" method="post">
    <div class="form-group">
        <label for="quantity">Quantity:</label>
        <input type="hidden" name="id" value="<?php echo $row["product_id"]; ?>">
        <input type="number" id="quantity" name="quantity" min="1" max='<?php echo $row["product_qunty"] ?>' required>
    </div>
    <button type="submit" class="btn btn-default btn-xs pull-right text-info">
        <i class="fa fa-cart-arrow-down text-warning"></i> Add To Cart
    </button>
</form>
        </div>
    </div>
</div>

<?php
    }
}      

$sql1 = "SELECT * FROM product where product_id != $product_id";
    $result1 = mysqli_query($conn, $sql1);
       if (mysqli_num_rows($result) > 0) {
      // echo "output data of each row";
        ?>
<div class="content mt-5 ">
    <ul class="rig columns-4">
        <?php   while($row = mysqli_fetch_assoc($result1)) {
              ?>
      <li>
            <a href="single-product.php?id=<?php echo $row['product_id'] ?>"><img class="product-image" src="admin/<?php echo $row["product_img"] ?>" oncontextmenu="return false;"></a>
            <h6><?php echo substr($row["product_name"] , 0, 20) . '...'; ?></h6>             
            <p><?php echo substr($row["product_dec"], 0, 20) . '...'; ?></p>
            <div class="price">Rs:<?php echo $row["product_price"] ?></div>
             <hr>
             <!-- <button class="btn btn-default btn-xs pull-right" type="button">
                    <a href="single-product.php?id=<?php echo $row['product_id'] ?>" class="text-info"><i
                                class="fa fa-cart-arrow-down text-warning"></i> Add To Cart</a>
                </button> -->
                <button class="btn btn-default btn-xs pull-left" type="button">
                    <a href="single-product.php?id=<?php echo $row['product_id'] ?>" class="text-info"><i
                                class="fa fa-eye text-warning" ></i> Details</a>
                </button>
        </li>    
        <?php } }?>
    </ul>
</div>

    
<div class="container mt-3">
    <ul class="pagination justify-content-center">
        <li class="page-item disabled">
            <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
        </li>
        <li class="page-item active" aria-current="page">
            <a class="page-link" href="#">1 <span class="sr-only">(current)</span></a>
        </li>
        <li class="page-item"><a class="page-link" href="#">2</a></li>
        <li class="page-item"><a class="page-link" href="#">3</a></li>
        <li class="page-item">
            <a class="page-link" href="#">Next</a>
        </li>
    </ul>
</div>

<br>
<?php

include "footer.php";
?>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
    $(document).ready(function() {
        $('.ratings .fa-star').on('click', function() {
            // Remove 'checked' class and color from all stars
            $('.ratings .fa-star').removeClass('checked');
            $('.ratings .fa-star').css('color', '');

            // Add 'checked' class and change color for clicked star and previous stars
            $(this).addClass('checked');
            $(this).css('color', 'gold');
            $(this).prevAll('.fa-star').addClass('checked');
            $(this).prevAll('.fa-star').css('color', 'gold');
            
            // Remove color from stars after the clicked star
            $(this).nextAll('.fa-star').css('color', '');
            
            var rating = $(this).prevAll('.fa-star').length + 1;
            $('.rating-text').text('(' + rating + '.0)');
            
            // Update the hidden input field value with the selected rating
            $('#rating').val(rating); // Update the hidden input field value
        });

        // Form submission using AJAX
        $('#productForm').submit(function(event) {
            event.preventDefault(); // Prevent the default form submission

            // Get the form data
            var formData = $(this).serialize();

            // AJAX POST request to handle form submission
            $.ajax({
                type: 'POST',
                url: $(this).attr('action'),
                data: formData,
                success: function(response) {
                    console.log('Form submitted successfully.');
                    // Process the response or perform any additional actions
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                }
            });
        });
    });
    document.addEventListener('contextmenu', function (e) {
            e.preventDefault();
        });
</script>

