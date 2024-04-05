<?php
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
                <div class="alert-info text-center">
                  <a href="single-product.php?id=<?php echo $row_search['product_id']; ?>" class="alert-link text-warning-emphasis"><?php echo $row_search['product_name']; ?></a>
                </div>
            </div>
 
         
          
            <?php
        }
    } else {
        echo "<div class='container mt-3'><p class='alert alert-info text-center'>No results found.</p></div>";
    }
}

?>