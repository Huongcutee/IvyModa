<?php
include("../route/header.php");  
include("../route/slider.php");
include("../class/product_img_desc_class.php");
?>
 <!-- Lấy id  -->
<?php
 $product_img_desc = new product_img_desc;
 if(!isset($_GET['product_img_desc']) || $_GET['product_img_desc'] == NULL )
 {
    echo "<script> window.location = 'productlist.php' </script>";
 }
 else{
    $product_img_desc_get = $_GET['product_img_desc'];
    $get_product_img_desc = $product_img_desc -> delete_product_img_desc($product_img_desc_get);
    if($get_product_img_desc)
    {
        $result = $get_product_img_desc -> fetch_assoc();
        if($result)
        {
          $product_img_desc = $result['product_img_desc'];
          unlink('../uploads/'.$product_img_desc); 
        }
    }
 }
?>
<?php
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $product_id = $_GET['product_id'];
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
