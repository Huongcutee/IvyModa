<?php
include("../route/header.php");  
include("../route/slider.php");
include("../class/product_class.php");
?>
 <!-- Lấy id  -->
<?php
 $product = new product;
 if(!isset($_GET['product_id']) || $_GET['product_id'] == NULL )
 {
    echo "<script> window.location = 'productlist.php' </script>";
 }
 else{
    $product_id = $_GET['product_id'];
    $get_product = $product -> get_product_id($product_id);
    if($get_product)
    {
        $result = $get_product -> fetch_assoc();
         if($result)
        {
          $product_img = $result['product_img'];
          unlink('../uploads/'.$product_img); 
        }
       
    }
 }
?>
<?php
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $delete_product = $product -> delete_product($product_id);
    
}
?>
 <div class="admin-content-right">
            <div class="admin-content-right-cartegory-add">
                <h1>Xóa sản phẩm</h1>
                <form action="" method="post">
                    <button type="submit">
                     Xóa
                    </button>
                </form>
            </div>
        </div>
    </section>
</body>
</html>
