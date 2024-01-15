<?php
include "class/cart_class.php";
$cart = new cart();

$matp = $_GET['matp'];
?> 
 <?php
    $show_maqh_ajax = $cart -> show_maqh_ajax($matp);
    if($show_maqh_ajax){
        while($result = $show_maqh_ajax->fetch_assoc()){
    ?>
        <option value="<?php echo $result['maqh']?>"><?php echo $result['name']?></option>
    <?php
        }
    }
?>
                    