<?php
include "../route/header.php";  
include "../route/slider.php";
include "../class/product_img_desc_class.php";
?>
 <?php
 $product_img_desc = new product_img_desc;
 $show_product_img_desc = $product_img_desc -> show_product_img_desc();
 ?>
    <div class="admin-content-right">
            <div class="admin-content-right-cartegory-list">
                <h1>Danh sách sản phẩm</h1>
                <table>
                    <tr>
                        <th>STT</th>
                        <th>Tên sản phẩm</th>
                        <th>Ảnh sản phẩm</th>
                        <th>Ảnh mô tả sản phẩm</th>
                        <th>Cập nhật</th>
                    </tr>
                    <?php
                       if($show_product_img_desc){ 
                        $i = 0;
                        while($result =  $show_product_img_desc -> fetch_assoc())
                        {
                            $i++;
                     ?>
                   <tr>
                    
                        <td><?php echo $i ?></td>
                        <td><?php echo $result["product_name"] ?> </td>
                        <td><img src="../uploads/<?php echo $result['product_img']?>" style="width: 100px; height: auto;"/></td>
                        <td>
                            <img src="../uploads/<?php echo $result['product_img_desc']?>" style="width: 100px; height: auto;"/>
                        </td>
                        <td><a href="product_img_desc_edit.php?product_img_desc=<?php echo $result["product_img_desc"] ?>">Sửa</a>
                        <a href="product_img_desc_delete.php?product_img_desc=<?php echo $result["product_img_desc"] ?>">Xóa</a></td>
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