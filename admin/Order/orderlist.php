<?php
include("../route/header.php");  
include("../route/slider.php");
include("../class/cart_class.php");
?>
 <?php
 $cart = new cart;
 $show_cart = $cart ->show_cart();
 ?>
 <div class="admin-content-right">
            <div class="admin-content-right-cartegory-list">
                <div class="admin-content-right-cartegory-list-head">
                  <h1>Danh sách đơn hàng</h1>
                  <div class="admin-content-right-cartegory-list-head-sort"> 
                    <div class="cartegory-right-top-item">
                        <button><span>Bộ lọc</span><i class="fa-solid fa-sort-down"></i></button>
                    </div>
                    <div class="cartegory-right-top-item">
                        <select name="" id="">
                            <option value="">Sắp xếp</option>
                            <option value="">Giá cao đến thấp</option>
                            <option value="">Giá thấp đến cao</option>
                        </select>
                    </div>
                  </div>
                </div>
                <table>
                    <tr>
                        <th>STT</th>
                        <th>Code order</th>
                        <th>email</th>
                        <th>total email</th>
                        <th>Payment methods</th>
                        <th>Payment status</th>
                        <th>View more</th>
                        <th>Edit</th>
                        <th>Status</th>
                    </tr>
                    <?php
                       if($show_cart){ 
                        $i = 0;
                        while($result =  $show_cart -> fetch_assoc())
                        {
                            $i++;
                     ?>
                   <tr>
                        <td><?php echo $i ?></td>
                        <td><?php echo $result["code_order"] ?></td>
                        <td><?php echo $result["email"] ?></td>
                        <td class="format_price"><?php echo $result["total_price"] ?></td>
                        <td><?php echo $result["payment_methods"] ?></td>
                        <td><?php echo $result["payment_status"] ?></td>
                        <td>
                             <a href="orderViewmore.php?id_cart=<?php echo $result['id_cart'] ?>">Views</a>
                        </td>
                        <td>
                            <a href="orderedit.php?id_card=<?php echo $result["id_cart"] ?>">Sửa</a>
                            <a href="orderdelete.php?id_cart=<?php echo $result["id_cart"] ?>">Xóa</a>
                        </td>
                        <td><?php echo $result["_status"] ?></td>
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
  $('.format_price').simpleMoneyFormat();
</script>
</html>