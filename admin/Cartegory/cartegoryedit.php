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
<!-- Sửa name -->
 <?php
 if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $cartegory_name = $_POST['cartegory_name']; // lấy giá trị từ form
    $update_cartegory = $cartegory -> update_cartegory($cartegory_id,$cartegory_name);
 }
 ?>
 <div class="admin-content-right">
            <div class="admin-content-right-cartegory-add">
                <h1>Sửa danh mục</h1>
                <form action="" method="post">
                    <input required type="text" name="cartegory_name" value="<?php echo $result['cartegory_name']?>">
                    <button type="submit">
                     Sửa
                    </button>
                </form>
            </div>
        </div>
    </section>
</body>
</html>