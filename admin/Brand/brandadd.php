 <?php
 include "../route/header.php";
 include "../route/slider.php";
 include "../class/brand_class.php"
 ?>
 <?php
 $brand = new brand;
 if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $cartegory_id = $_POST['cartegory_id'];
    $brand_name = $_POST['brand_name']; // lấy giá trị từ form
    $insert_brand = $brand -> insert_brand($cartegory_id,$brand_name);
 }
 ?>
 <div class="admin-content-right">
            <div class="admin-content-right-brand-add">
                <h1>Thêm loại sản phẩm</h1>
                <form action="" method="post">
                    <select required name="cartegory_id" id="">
                        <option value="">
                            Chọn Danh Mục
                        </option>
                        <?php
                        $show_cartegory = $brand -> show_cartegory();
                        if($show_cartegory){    
                            while($result = $show_cartegory->fetch_assoc()){
                      ?>
                        <option value="<?php echo $result['cartegory_id']?>">
                            <?php echo $result['cartegory_name']?>
                        </option>
                        <?php
                            }
                        }
                         ?>
                    </select>
                    <input required name="brand_name" type="text" placeholder="Nhập tên loại sản phẩm...">
                    <button type="submit">Thêm</button>
                </form>
            </div>
        </div>
    </section>
</body>
</html>