<footer style=" background-color: #343a40;  background-color: #343a40; /* Dark background color */
        color: #fff; /* Light text color */
        padding: 20px 0; /* Reduced padding for smaller footer */
        position: relative;
        margin-top: auto;">
          <div class="container">
              <div class="row">
                  <div class="col-md-6 col-sm-12">
                      <h5>SUPER MARKET</h5>
                      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequuntur, perspiciatis quia repudiandae sapiente sed sunt.</p>
                      <a href="admin/all-product.php" class="btn btn-info mb-3">Admin</a>
                  </div>
                  <div class="col-md-2 col-sm-4 ">
                      <h5>CATEGORIES</h5>
                      <ul>
                      <?php       
              $conn = mysqli_connect("localhost", "root","","aqibkhan");
                  $sql = "SELECT * FROM Category";
                  $result = mysqli_query($conn, $sql);
                 while($row = mysqli_fetch_assoc($result)) {
                   ?> 
                    <li>
                    <a class="nav-link" href="catagory.php?id=<?php echo $row["cat_id"] ?>" onclick="changeColor(this)"><?php echo  $row["cat_name"] ?></a>
                     </li>
               <?php
                      }                  
                  ?>     
                          
                      </ul>
                  </div>
                  <div class="col-md-2 col-sm-4">
                      <h5>USEFUL LINKS</h5>
                      <ul>
                          <li><a href="index.php" class="nav-link">HOME</a></li>
                          <li><a href="#" class="nav-link">ALL PRODUCTS</a></li>
                          <li><a href="#" class="nav-link">LATEST PRODUCTS</a></li>
                          <li><a href="#"class="nav-link">POPULAR PRODUCTS</a></li>
                          <li><a href="#"class="nav-link">CONTACT US</a></li>
                      </ul>
                  </div>
                  <div class="col-md-2 col-sm-4">
                      <h5>CONTACT US</h5>
                      <ul>
                          <li><i class="fas fa-map-marker-alt"></i> #123, Lorem Ipsum</li>
                          <li><i class="fas fa-phone"></i> 9876541230</li>
                          <li><i class="fas fa-envelope"></i> Email@Email1.Com</li>
                      </ul>
                  </div>
              </div>
              <div class="row">
                  <div class="col-md-12 text-center">
                      <p>Copyright 2024 | Created by Aqib Khan</p>
                  </div>
              </div>
          </div>
      </footer>
  
      <button id="back-to-top" title="Back to Top"> <i class="fas fa-arrow-up"></i></button>
  
      <!-- Bootstrap JS and jQuery -->
      <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  
      <script>
          // Toggle modal function
          function toggleModal() {
              $('#userModal').modal('toggle');
          }
  
          // Automate carousel
          $('.carousel').carousel({
              interval: 3000, // Change slide interval here (in milliseconds)
              pause: 'hover' // Pause slide on hover
          });
  
          // Function to change button color on click
          function changeColor(element) {
              // Remove active class from all nav items
              var navItems = document.querySelectorAll('.nav-link');
              navItems.forEach(function(item) {
                  item.classList.remove('active');
              });
  
              // Add active class to the clicked nav item
              element.classList.add('active');
          }
  
          // Back to top button functionality
          var backToTopBtn = document.getElementById("back-to-top");
  
          window.addEventListener("scroll", function() {
              if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                  backToTopBtn.style.display = "block";
              } else {
                  backToTopBtn.style.display = "none";
              }
          });
  
          backToTopBtn.addEventListener("click", function() {
              document.body.scrollTop = 0; // For Safari
              document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
          });
      </script>
       <!-- jQuery -->
       <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
       <!-- Bootstrap JS and Popper.js -->
       <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
       <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
   
       <script>
           // Function to toggle the modal
           function toggleModal() {
               $('#userModal').modal('toggle');
           }
   
           // Function to change button color on click
           function changeColor(element) {
               // Remove active class from all nav items
               var navItems = document.querySelectorAll('.nav-link');
               navItems.forEach(function (item) {
                   item.classList.remove('active');
               });
   
               // Add active class to the clicked nav item
               element.classList.add('active');
           }
   
           // Back to top button functionality
           var backToTopBtn = document.getElementById("back-to-top");
   
           window.addEventListener("scroll", function () {
               if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                   backToTopBtn.style.display = "block";
               } else {
                   backToTopBtn.style.display = "none";
               }
           });
   
           backToTopBtn.addEventListener("click", function () {
               document.body.scrollTop = 0; // For Safari
               document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
           });
   
       
            // Navbar toggler functionality
    $('.navbar-toggler').click(function () {
        $('.navbar-collapse').toggleClass('show');
    });

    // Close navbar toggle when a link is clicked
    $('.navbar-nav>li>a').on('click', function(){
        $('.navbar-collapse').removeClass('show'); // Change 'hide' to 'show'
    });
        </script>
    
     
   </body>
   
   </html>