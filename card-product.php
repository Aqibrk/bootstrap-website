<?php 
include "config.php";
session_start();
if (!isset($_SESSION['user_id']) || !isset($_SESSION['email'])) {
    header("location:admin/index.php");
    exit; // Added to stop script execution after redirection
}
if (isset($_POST['id']) && isset($_POST['quantity'])) {
    $id = $_POST['id'];
    $quantity = $_POST['quantity'];
    $_SESSION['cart'][$id] = array('quantity' => $quantity);
    // echo "<pre>";
    // print_r($_SESSION['cart']);
    // echo "</pre>";
    header("location:cart.php");
}

?>
<?php include('header.php');  ?>
