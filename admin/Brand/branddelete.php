<?php
 include "../route/header.php";
 include "../route/slider.php";
 include "../class/brand_class.php"
?>
 <!-- Lấy id  -->
<?php
 $brand = new brand;
 if(!isset($_GET['brand_id']) || $_GET['brand_id'] == NULL )
 {
    echo "<script> window.location = 'brandlist.php' </script>";
 }
 else{
    $brand_id = $_GET['brand_id'];
    $get_brand = $brand ->getbrand($brand_id);
    if($get_brand)
    {
        $result = $get_brand -> fetch_assoc();
    }
 }
   
?>
<!-- Xóa name -->
 <?php
 if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $brand_id = $_POST['brand_id']; // lấy giá trị từ form
    $delete_brand = $brand -> delete_brand($brand_id);
 }
 ?>

 <div class="admin-content-right">
            <div class="admin-content-right-cartegory-add">
                <h1>Xóa loại sản phẩm</h1>
                <form action="" method="post">
                  <input name="brand_id" value="<?php echo $result['brand_id']?>" ></input>
                    <button type="submit">
                     Xóa
                    </button>
                </form>
            </div>
        </div>
    </section>
</body>
</html>