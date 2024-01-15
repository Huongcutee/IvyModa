<?php
include "class/cart_class.php";
$cart = new Cart();
    session_start();
    unset($_SESSION['gio_hang']);
    $_SESSION['gio_hang'] = [];
    
   if (isset($_GET['vnp_Amount'])) 
    {
        $inser_ncb = $cart -> insert_ncb();
    }
    $code_order = $_GET['vnp_TxnRef'];
    $update_cart_payment_status = $cart -> update_payment_status($code_order);
?>
<?php
?>
    <h1>Thanh toán thành công!!</h1>
   <a href="index.php">Về trang chủ</a>
