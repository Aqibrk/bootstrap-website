  <!-- Navbar with Slider -->  <center></center>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">     
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mr-auto navbar-center text-center"> 
            <?php       
              $conn = mysqli_connect("localhost", "root","","aqibkhan");
                  $sql = "SELECT * FROM Category";
                  $result = mysqli_query($conn, $sql);
                 while($row = mysqli_fetch_assoc($result)) {
                   ?>           
                  <h5> <a class="nav-link text-dark fw-bolder" href="catagory.php?id=<?php echo $row["cat_id"] ?>" onclick="changeColor(this)"><?php echo  $row["cat_name"] ?></a>
                  </h5>
               <?php
                      }                  
                  ?>              
            </ul>
        </div>
    </div>
</nav>