<?php
include("../route/header.php");  
include("../route/slider.php");
include("../class/cart_class.php");
?>
 <!-- Lấy id  -->
<?php
    $cart = new cart;
    $id_cart = $_GET['id_cart'];
    $showCart = $cart -> get_cart($id_cart);
    $result = $showCart -> fetch_assoc();
    $result_tp = $cart -> get_ThanhPho($result['matp']);
    $result_qh = $cart -> get_QuanHuyen($result['maqh']);
    $result_px = $cart -> get_PhuongXa($result['xaid']);
    $nameThanhPho =  $result_tp -> fetch_assoc(); 
    $nameQuanHuyen =  $result_qh -> fetch_assoc(); 
    $namePhuongXa =  $result_px -> fetch_assoc();
    
    $get_cart_product_detail = $cart -> get_cart_detail_product($result['code_order']);
    if($_SERVER['REQUEST_METHOD'] === 'GET')
    {
       $update_status = $cart -> update_cart_status($result['id_cart']); 
    }
?>
 <div class="admin-content-right">
            <div class="admin-content-right-cartegory-add">
                <form action="orderlist.php" method="get">
                    <div class="admin-content-right-cartegory-add-head">   
                        <h1>Thông tin chi tiết đơn hàng</h1>
                        <input type="submit" value="Duyệt"  />
                    </div>
                </form>
                <div class="admin-content-right-orderdetail">
                    <table>
                        <tr>
                            <th>ID Cart</th>
                            <th><?php echo $result['id_cart']?></th>
                        </tr>
                        <tr>
                            <th>Code Order</th>
                            <th><?php echo $result['code_order']?></th>
                            <input type="hidden" name="code_order" value="<?php echo $result['code_order']?>">
                        </tr>
                        <tr>
                            <th>Email</th>
                            <th><?php echo $result['email']?></th>
                            <input type="hidden" name="email" value="<?php echo $result['email']?>">
                        </tr>
                        <tr>
                            <th>Total Price</th>
                            <th class="format-price"><?php echo $result['total_price']?></th>
                            <input type="hidden" name="total_price" value="<?php echo $result['total_price']?>">
                        </tr>
                        <tr>
                            <th>Payment Menthods</th>
                            <th><?php echo $result['payment_methods']?></th>
                            <input type="hidden" name="payment_methods" value="<?php echo $result['payment_methods']?>">
                        </tr>
                        <tr>
                            <th>Payment Status</th>
                            <th><?php echo $result['payment_status']?></th>
                            <input type="hidden" name="payment_status" value="<?php echo $result['payment_status']?>">
                        </tr>
                        <tr>
                            <th>Name</th>
                            <th><?php echo $result['name_user']?></th>
                            <input type="hidden" name="name_user" value="<?php echo $result['name_user']?>">
                        </tr>
                        <tr>
                            <th>Date Order</th>
                            <th><?php echo $result['date_order']?></th>
                            <input type="hidden" name="date_order" value="<?php echo $result['date_order']?>">
                        </tr>
                        <tr>
                            <th>Phone</th>
                            <th>0<?php echo $result['sdt']?></th>
                            <input type="hidden" name="sdt" value="<?php echo $result['sdt']?>">
                        </tr>
                        <tr>
                            <th>Thành Phố</th>
                            <th><?php echo $nameThanhPho['name']?></th>
                            <input type="hidden" name="nameThanhPho" value="<?php echo $nameThanhPho['name']?>">
                        </tr>
                        <tr>
                            <th>Quận Huyện</th>
                            <th><?php echo $nameQuanHuyen['name']?></th>
                            <input type="hidden" name="nameQuanHuyen" value="<?php echo $nameQuanHuyen['name']?>">
                        </tr>
                        <tr>
                            <th>Phường Xã</th>
                            <th><?php echo $namePhuongXa['name']?></th>
                            <input type="hidden" name="namePhuongXa" value="<?php echo $namePhuongXa['name']?>">
                        </tr>
                        <tr>
                            <th>Địa Chỉ</th>
                            <th><?php echo $result['dia_chi']?></th>
                            <input type="hidden" name="dia_chi" value="<?php echo $result['dia_chi']?>">
                        </tr>
                    </table>
                </div>
                <h1 style="margin: 12px 0px;">Thông tin đơn hàng</h1>
                <div class="admin-content-right-cartegory-add-cart">
                    <table>
                        <tr>
                            <th>STT</th>
                            <th>Product Name</th>
                            <th>Size</th>
                            <th>Quanity</th>
                            <th>Price</th>
                        </tr>
                      <?php
                        $i = 0;
                        $tongTien = 0;
                        if(isset($get_cart_product_detail))
                        {
                            while($show_product_detail = $get_cart_product_detail -> fetch_assoc())
                            {
                            $i++;
                            $getProduct = $cart -> get_product($show_product_detail['product_id']);
                            $showProduct = $getProduct -> fetch_assoc();
                             $tongTien = $tongTien +  $showProduct['product_price'];
                      ?>
                        <tr>
                            <th><?php echo $i ?></th>
                            <th><?php echo $showProduct['product_name']?></th>
                            <input type="hidden" name="product_name" value="<?php echo $showProduct['product_name']?>">
                            <th><?php echo $result['product_size']?></th>
                            <input type="hidden" name="product_size" value="<?php echo $show_product_detail['product_size']?>">
                            <th><?php echo $show_product_detail['quanity']?></th>
                            <input type="hidden" name="quanity" value="<?php echo $show_product_detail['quanity']?>">
                            <th class="format-price"><?php echo $showProduct['product_price']?></th>
                        </tr>
                        <?php
                            }
                        }
                        ?>
                        <tr>
                            <th style="border: none;"></th>
                            <th style="border: none;"></th>
                            <th style="border: none;"></th>
                            <th style="border: none;"></th>
                            <th class="format-price" style="border: none;"><?php echo $tongTien?></th>
                        </tr>
                    </table>
                </div>
            </div>
            </div>
        </div>
    </section>
</body>
<script>
    $('.format-price').simpleMoneyFormat();
</script>
</html>