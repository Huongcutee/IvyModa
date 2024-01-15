<?php
include("../route/header.php");  
include("../route/slider.php");
include("../class/product_class.php");
?>
 <?php
 $product = new product;
 $show_product = $product -> show_product();
 
 ?>
 <div class="admin-content-right">
               <div class="admin-content-right-cartegory-list">
                <h1>Danh sách sản phẩm</h1>
                <table>
                    <tr>
                        <th>STT</th>
                        <th>Tên sản phẩm</th>
                        <th>Tên danh mục</th>
                        <th>Tên loại sản phẩm</th>
                        <th>Giá</th>
                        <th>Giá giảm</th>
                        <th>Mô tả</th>
                        <th>Ảnh sản phẩm</th>
                        <th>Cập nhật</th>
                    </tr>
                    <?php
                       if($show_product){ 
                        $i = 0;
                        while($result = $show_product -> fetch_assoc())
                        {
                            $i++;
                     ?>
                   <tr>
                        <td><?php echo $i ?></td>
                        <td><?php echo $result["product_name"] ?></td>
                        <td><?php echo $result["cartegory_name"] ?></td>
                        <td><?php echo $result["brand_name"] ?></td>
                        <td class="format_price"><?php echo $result["product_price"] ?></td>
                        <td class="format_price"><?php echo $result["product_sale"] ?></td>
                        <td style="width: 300px;"><?php echo $result["product_desc"]?></td>
                        <td><img src="../uploads/<?php echo $result["product_img"] ?>" style="width: 100px; height: auto;"/></td>
                        <td><a href="productedit.php?product_id=<?php echo $result["product_id"] ?>">Sửa</a>
                        <a href="productdelete.php?product_id=<?php echo $result["product_id"] ?>">Xóa</a></td>
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
<script>
    // format price
      $('.format_price').simpleMoneyFormat();
</script>
</html>