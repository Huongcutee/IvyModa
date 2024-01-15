<?php
include("../route/header.php");  
include("../route/slider.php");
include("../class/cart_class.php");
?>
 <!-- Lấy id  -->
<?php
 $cart = new cart;
 if(!isset($_GET['id_cart']) || $_GET['id_cart'] == NULL )
 {
    echo "<script> window.location = 'orderlist.php' </script>";
 }
 else{
    $id_cart = $_GET['id_cart'];
    $result = $cart -> get_cart($id_cart );
    $value = $result -> fetch_assoc();
    $delete_cart = $cart -> delete_cart($id_cart);
    $delete_detail_product = $cart -> delete_cart_detail_product($value['code_order']);
    $delete_detail_address = $cart -> delete_cart_detail_address($value['code_order']);
    $delete_ncb            = $cart -> delete_ncb($value['code_order']);
 }
?>
