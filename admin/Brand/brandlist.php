 <?php
 include "../route/header.php";
 include "../route/slider.php";
 include "../class/brand_class.php"
?>
 <?php
 $brand = new brand;
 $show_brand = $brand -> show_brand();
 ?>
 <div class="admin-content-right">
               <div class="admin-content-right-cartegory-list">
                <h1>Danh sách loại sản phẩm</h1>
                <table>
                    <tr>
                        <th>STT</th>
                        <th>Mã loại sản phẩm</th>
                        <th>Tên danh mục</th>
                        <th>Tên loại sản phẩm</th>
                        <th>Cập nhật</th>
                    </tr>
                    <?php
                       if($show_brand){ 
                        $i = 0;
                        while($result = $show_brand -> fetch_assoc())
                        {
                            $i++;
                     ?>
                   <tr>
                        <td><?php echo $i ?></td>
                        <td><?php echo $result["brand_id"] ?></td>
                        <td><?php echo $result["cartegory_name"] ?></td>
                        <td><?php echo $result["brand_name"] ?></td>
                        <td><a href="brandedit.php?brand_id=<?php echo $result["brand_id"] ?>">Sửa</a><a href="branddelete.php?brand_id=<?php echo $result["brand_id"] ?>">Xóa</a></td>
                    </tr>
                    <?php
                        }
                    }
                    ?>
                </table>
            </div>
        </div>
    </section>
</body>
</html>