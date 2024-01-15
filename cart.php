<?php
include "header.php";
include "class/product_class.php";
?>
 <!-- **************************Cart********************************* -->
<?php

// Khởi tạo giỏ hàng
if (!isset($_SESSION["gio_hang"])) {
    $_SESSION['gio_hang'] = [];
}
// xóa đơn hàng trong giỏ hàng
if (isset($_GET['delid'])&& ($_GET['delid'] >= 0)) {
    array_splice($_SESSION['gio_hang'], $_GET['delid'],1);
}
// Lấy dữ liệu từ form
if (isset($_POST['addcart'])) {
        $product_id = $_POST['product_id'];
        $product_name = $_POST['product_name'];
        $product_price = $_POST['product_price'];
        $product_img = $_POST['product_img'];
        $quantity = $_POST['quantity'];
        $selectedSize = $_POST['size'] ;
        $product_color = $_POST['product_color'] ;
    // kiểm tra sản phẩm có trong giỏ hàng
    $flag = 0; // kiểm tra sản phẩm có trùng trong giỏ hàng hay không?
   for ($i = 0; $i < sizeof($_SESSION['gio_hang']); $i++) {
    if ($_SESSION['gio_hang'][$i][0] == $product_id && $_SESSION['gio_hang'][$i][5] == $selectedSize) {
        $flag = 1;
        $quantitynew = $quantity + $_SESSION['gio_hang'][$i][4];
        $_SESSION['gio_hang'][$i][4] = $quantitynew;
        break; 
    }
   }
   // nếu không trùng thì thêm mới
   if ($flag == 0) {
    // thêm mới giỏ hàng
    $sp = [$product_id,$product_name, $product_price, $product_img, $quantity,$selectedSize,$product_color];
    $_SESSION['gio_hang'][] = $sp;
   }
   $product = new  Product();
   $show_brand_id = $product->get_product_id($_POST['product_id']);
   $result = $show_brand_id -> fetch_assoc();
}
function showcart()
{
    if (isset($_SESSION['gio_hang'])&&(is_array($_SESSION['gio_hang']))) {
        $tong =0;
        $tongsanpham = 0;
        for ($i = 0; $i < sizeof($_SESSION['gio_hang']); $i++)
        {
            $tt = $_SESSION['gio_hang'][$i][2] * $_SESSION['gio_hang'][$i][4];
            $tong += $tt;
            $tongsanpham += $_SESSION['gio_hang'][$i][4];
            echo            
                ' <tr>
                    <td>
                    '.($i+1).'
                    </td>
                    <td>
                        <img src="admin/uploads/'.$_SESSION['gio_hang'][$i][3].'">
                    </td>
                    <td>
                    '.$_SESSION['gio_hang'][$i][1].' SM: '.$_SESSION['gio_hang'][$i][0].'
                    </td>
                    <td>'.$_SESSION['gio_hang'][$i][6].'</td>
                    <td>
                        '.$_SESSION['gio_hang'][$i][5].'
                    </td>
                    <td>
                    <div class="input_soluong">
                        <input type="number" value="'.$_SESSION['gio_hang'][$i][4].'" />
                        </div>
                    </td>
                    <td class ="format-price">'.$tt.'</td>
                    <td><a href="cart.php?delid='.$i.'"><i class="fa-regular fa-trash-can"></i></a></td>
                </tr>
                ';
        } 
         return array($tong, $tongsanpham);
      
    }
}
  

?>
<section class="cart">
    <div class="container">
        <div class="cart-top-wrap">
            <div class="cart-top">
                <ul>
                    <li>
                        <i class="fa-solid fa-cart-shopping "></i>
                    </li>
                    <li>
                        <i class="fa-solid fa-location-dot"></i>

                    </li>
                    <li>
                        <i class="fa-solid fa-credit-card"></i>

                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="cart-bottom row">
            <div class="cart-left">
                <table>
                    <tr>
                        <th>STT</th>
                        <th>
                            SẢN PHẨM
                        </th>
                        <th>
                            TÊN SẢN PHẨM
                        </th>
                        <th>
                            MÀU
                        </th>
                        <th>
                            SIZE
                        </th>
                        <th>
                            SL
                        </th>
                        <th>
                            THÀNH TIỀN
                        </th>
                        <th>
                            XÓA
                        </th>
                    </tr>

                 <?php 
                 list($tong, $tongsanpham) = showcart();
                 ?>

                 </table>
                 <form action="cartegory.php?brand_id=<?php echo $result['brand_id'] ?>" method="post" >
                    <div class="cart-content-left-button">
                            <button type="submit">
                                <i class="fa-solid fa-arrow-left"></i>
                                <p>Tiếp tục mua hàng</p>
                            </button>
                    </div>  
                 </form>
                   
                    </div>
                    <div class="cart-right">
                        <h3>Tổng tiền giỏ hàng</h3>
                        <table>
                            <tr>
                                <td>Tổng sản phẩm</td>
                                <td><?php echo $tongsanpham?></td>
                            </tr>
                            <tr>
                                <td>
                                    Tổng tiền hàng
                                </td>
                                <td class = "format-price"><?php echo $tong ?></td>
                            </tr>
                            <tr>
                                <td>Thành tiền</td>
                                <td><b class="format-price"><?php echo $tong ?></b></td>
                            </tr>
                            <tr>
                                <td>Tạm tính</td>
                                <td><b class="format-price"><?php echo $tong ?></b></td>
                            </tr>
                        </table>
                        <div class="cart-content-right-text row">
                            <p> <i class="fa-solid fa-circle-exclamation"></i> Miễn <b>đổi trả</b> đối với sản phẩm đồng giá
                                / sale trên 50%</p>
                        </div>
                        <div class="cart-content-right-button">
                            <?php if ($tong == 0): ?>
                                <button onclick="showIn()">TIẾP TỤC MUA SẮM</button>
                            <?php else: ?>
                                <a href="delivery.php">
                                    <button>TIẾP TỤC MUA SẮM</button>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
</section>
    <!-- *************************************** -->
<?php
include "footer.php";
?>
<script>

    

    function showIn()
    {
        alert("Giỏ hàng hiện tại chưa có sản phẩm nào cả !!");
        return false;
    }
    // format price 
       $('.format-price').simpleMoneyFormat();
</script>