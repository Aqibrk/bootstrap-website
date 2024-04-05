<?php
session_start();
session_start();
if (!isset($_SESSION['user_id']) || !isset($_SESSION['email'])) {
    header("location:index.php");
    exit; // Added to stop script execution after redirection
}
$cart = $_SESSION['cart'];
   if(isset($_GET['id']))
   {
    $id = $_GET['id'];
    unset($_SESSION['cart'][$id]);
    header("location:cart.php");
   }

?>