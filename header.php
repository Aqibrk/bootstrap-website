
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aqib Shop Store</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
   <link rel="stylesheet" href="style1.css">
      </head>
  <body>
  <body>
      <header>
          <div class="container">
              <div class="row justify-content-center align-items-center">
                  <div class="col-md-4 text-center">
                      <a href="index.php"> <img src="img/logo.png" alt="Logo" class="img-fluid"     document.addEventListener('contextmenu', function (e) {
            e.preventDefault();
        });></a>
                  </div>
                  <div class="col-md-4">
                  <form class="search-form d-flex" method="POST" action="">
                        <input type="text" class="form-control" id="searchInput" name="search" placeholder="Search...">
                        <button type="submit" class="btn search-button">Search</button>
                    </form>
                    
                  </div>
                  <div class="col-md-4 text-right mt-2">
                  <i class="fas fa-user user-icon" data-toggle="modal" data-target="#userModal"></i>
                      <button class="wishlist-button"><i class="fas fa-heart text-danger"></i></button>
                      <?php
session_start(); // Make sure session_start() is called at the beginning

// Check if 'cart' key is set in the session
if (isset($_SESSION['cart'])) {
    $cart = $_SESSION['cart']; 
    $count = count($cart);
} else {
    // Handle the case where 'cart' key is not set
    $count = 0;
}

?>

<!-- HTML code for the cart button with notification badge -->
<a href="cart.php" class="cart-link">
    <button class="cart-button">
        <i class="fas fa-shopping-cart text-info"></i> Cart
        <span id="cart-notification" class="notification-badge"><?php echo $count; ?></span>
    </button>
</a>

<style>
  .cart-link {
    text-decoration: none;
  }

  .cart-button {
    position: relative;
    background-color: transparent;
    color: #000;
    border: 1px solid #000;
    /* padding: 0.5em 1em; */
    border-radius: 0.25rem;
    transition: background-color 0.3s, color 0.3s;
  }

  .cart-button:hover {
    background-color: #000;
    color: #fff;
  }

  .notification-badge {
    position: absolute;
    top: -8px;
    right: -8px;
    display: inline-block;
    background-color: #dc3545;
    color: #fff;
    padding: 0.25em 0.5em;
    border-radius: 50%;
    font-size: 0.6em;
    font-weight: bold;
  }
</style>



                  </div>
              </div>
          </div>
      </header>  <!-- Add your JavaScript code here to disable right-click -->
    <script>
        document.addEventListener('contextmenu', function (e) {
            e.preventDefault();
        });
    </script>