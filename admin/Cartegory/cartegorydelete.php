 <?php
 include "../route/header.php";
 include "../route/slider.php";
 include "../class/cartegory_class.php"
 ?>
 <!-- Lấy id  -->
<?php
 $cartegory = new cartegory;
 if(!isset($_GET['cartegory_id']) || $_GET['cartegory_id'] == NULL )
 {
    echo "<script> window.location = 'cartegorylist.php' </script>";
 }
 else{
    $cartegory_id = $_GET['cartegory_id'];
 }
    $get_cartegory = $cartegory ->getcartegory($cartegory_id);
    if($get_cartegory)
    {
        $result = $get_cartegory -> fetch_assoc();
    }
?>
<!-- Xóa name -->
 <?php
 if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $cartegory_name = $_POST['cartegory_name']; // lấy giá trị từ form
    $delete_cartegory = $cartegory -> delete_cartegory($cartegory_name);
 }
 ?>

 <div class="admin-content-right">
            <div class="admin-content-right-cartegory-add">
                <h1>Xóa danh mục</h1>
                <form action="" method="post">
                    <input required type="text" name="cartegory_name" value="<?php echo $result['cartegory_name']?>">
                    <button type="submit">
                     Xóa
                    </button>
                </form>
            </div>
        </div>
    </section>
</body>
</html>