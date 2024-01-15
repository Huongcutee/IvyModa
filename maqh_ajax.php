<?php
include "class/cart_class.php";
$cart = new cart();

$maqh = $_GET['maqh'];
?> 
 <?php
    $show_xaid_ajax = $cart -> show_xaid_ajax($maqh);
    if($show_xaid_ajax){
        while($result = $show_xaid_ajax->fetch_assoc()){
    ?>
        <option value="<?php echo $result['xaid']?>"><?php echo $result['name']?></option>
    <?php
        }
    }
?>
                    