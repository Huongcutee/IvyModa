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
 }
    $get_brand = $brand ->getbrand($brand_id);
    if($get_brand)
    {
        $result = $get_brand -> fetch_assoc();
    }
?>
<!-- Sửa name -->
 <?php
 if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $brand_name = $_POST['brand_name']; // lấy giá trị từ form
    $update_brand = $brand -> update_brand($brand_id,$brand_name);
 }
 ?>
 <div class="admin-content-right">
            <div class="admin-content-right-cartegory-add">
                <h1>Sửa loại sản phẩm</h1>
                <form action="" method="post">
                    <input required type="text" name="brand_name" value="<?php echo $result['brand_name']?>">
                    <button type="submit">
                     Sửa
                    </button>
                </form>
            </div>
        </div>
    </section>
</body>
</html>