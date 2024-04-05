<?php

include "config.php";
include "header.php";
include "nav.php";
include "modal.php";
include "serach.php";
include "hero.php";

?>

<div id="product-list" class="content mt-5" style="margin-right: 20px !important;"></div>

<!-- Pagination links -->
<div class="container mt-3">
    <ul id="pagination" class="pagination justify-content-center">
        <?php
        // Fetch total number of products for pagination
        $sql_count = "SELECT COUNT(*) AS total FROM product";
        $result_count = mysqli_query($conn, $sql_count);
        $row_count = mysqli_fetch_assoc($result_count);
        $total_pages = ceil($row_count['total'] / 4); // Assuming 4 products per page

        // Display pagination links
        for ($i = 1; $i <= $total_pages; $i++) {
            echo '<li class="page-item"><a class="page-link" href="javascript:void(0);" onclick="loadPage(' . $i . ')">' . $i . '</a></li>';
        }
        ?>
    </ul>
</div>

<script>
    function loadPage(page) {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("product-list").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", "load-products.php?page=" + page, true);
        xmlhttp.send();
    }

    // Load first page initially
    loadPage(1);
</script>

<?php include "footer.php"; ?>
