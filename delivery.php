
<?php
include "header.php";
include "class/cart_class.php";
?>
<?php
$cart = new cart();
    $number1 = rand(0, 9);
    $number2 = rand(0, 9);
    $number3 = rand(0, 9);
    $number4 = rand(0, 9);
    $code_order = 'IVY' . (string)$number1. (string)$number2. (string)$number3. (string)$number4;
$show_tinh_thanhpho = $cart -> select_Tinh_Thanhpho();

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
                    <p style = "font-size: 16px; color: black">'.$_SESSION['gio_hang'][$i][1].' SM:  '.$_SESSION['gio_hang'][$i][0].'</p>
                    </td>
                    <td>'.$_SESSION['gio_hang'][$i][6].'</td>
                    <td>
                        '.$_SESSION['gio_hang'][$i][5].'
                    </td>
                    <td>
                    <div class="input_soluong">
                        <p style ="color: black; font-size:16px">'.$_SESSION['gio_hang'][$i][4].'</p>
                        </div>
                    </td>
                    <td class ="format-price">'.$tt.'</td>
                </tr>
                ';
        } 
          return array($tong, $tongsanpham);
    }
}
?>

    <!-- ---------------------------- Delivery ---------------------------- -->
    <section class="delivery">
        <div class="container">
            <div class="delivery-top-wrap">
                <div class="delivery-top">
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
            <form action="payment.php" method="post" onsubmit = "return validatePayment()" >    
                <div class="delivery-content row">
                    <!-- Left  -->
                    <div class="delivery-content-left">
                        <!-- Địa chỉ giao hàng  -->
                        <h3>
                            Địa chỉ giao hàng
                        </h3>
                        <div class="delivery-content-left-button row">
                            <div class="delivery-content-left-button-dn"><button>ĐĂNG NHẬP</button>
                            </div>
                            <div class="delivery-content-left-button-dk"><button>ĐĂNG KÝ</button>
                            </div>
                        </div>
                        <div class="delivery-content-left-text">
                            <p>Đăng nhập/ Đăng ký tài khoản để được tích điểm và nhận thêm nhiều ưu đãi từ IVY moda.</p>
                        </div>
                            <div class="delivery-content-left-adress">
                                <div class="delivery-content-left-adress-title row">
                                    <i class="fa-solid fa-circle-check"></i>
                                    <span>Địa chỉ</span>
                                </div>
                                <div class="delivery-content-left-adress-input-top row">
                                    <div class="delivery-content-left-adress-input-top-item" >
                                        <input required placeholder="Họ tên" type="text" name="name">
                                    </div>
                                    <div class="delivery-content-left-adress-input-top-item" >
                                        <input required placeholder="Số điện thoại" name="sdt">
                                    </div>
                                    <div class="delivery-content-left-adress-input-top-item">
                                        <select required name="matp" id="matp" >
                                            <option>Tỉnh/Thành phố</option>
                                        <?php 
                                        if( $show_tinh_thanhpho ) {
                                            while($result = $show_tinh_thanhpho -> fetch_assoc()) 
                                            { 
                                            ?>
                                                <option value="<?php echo $result['matp'] ?>" ?><?php echo $result['name'] ?></option>
                                        <?php  
                                            } 
                                        }
                                        ?>
                                        </select>
                                    </div>
                                    <div class="delivery-content-left-adress-input-top-item">
                                        <select required name="maqh" id="maqh" >
                                            <option>Quận/Huyện</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="delivery-content-left-adress-input-bot">
                                <select required name="xaid" id="xaid" >
                                            <option>Phường/Xã</option>
                                        </select>
                                </div>
                                <div class="delivery-content-left-adress-input-bot">
                                    <input placeholder="Địa chỉ" type="text" name="dia_chi">
                                </div>
                            </div>
                            <div class="delivery-content-left-payment">
                                <h3>Phương thức thanh toán</h3>
                                <div class="delivery-content-left-payment-content">
                                    <p>Mọi giao dịch đều được bảo mật và mã hóa. Thông tin thẻ tín dụng sẽ không bao giờ được
                                        lưu lại.</p>
                                    <div class="delivery-content-left-payment-content-pick">
                                        <div class="delivery-content-left-payment-content-pick-item">
                                            <input type="radio" name="payment_menthods" value="Thanh toán bằng thẻ tín dụng">
                                            <label>Thanh toán bằng thẻ tín dụng</label>
                                        </div>
                                        <div class="delivery-content-left-payment-content-pick-item">
                                            <input type="radio" name="payment_menthods" value="Thanh toán bằng VNPAY">
                                            <label>Thanh toán bằng VNPAY</label>
                                        </div>
                                        <div class="delivery-content-left-payment-content-pick-item">
                                            <input type="radio" name="payment_menthods" value="Thanh toán bằng Momo">
                                            <label>Thanh toán bằng Momo</label>
                                        </div>
                                        <div class="delivery-content-left-payment-content-pick-item">
                                            <input type="radio" name="payment_menthods" value="Thanh toán khi giao hàng">
                                            <label>Thanh toán khi giao hàng</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                    <!-- .End .. -->
                    <!-- None -->
                    <div style="display: none;">
                        <?php list($tong,$tongsanpham) = showcart() ?>
                    </div>
                    <!-- None -->
                    <!-- Tổng Tiền Giỏ Hàng -->
                    <div class="delivery-content-right">
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
                          <input type="hidden" name="total_price" value="<?php echo $tong ?>">
                          <input type="hidden" name="code_order" value="<?php echo $code_order ?>">
                        <div class="cart-content-right-button">
                            <input type="submit" value="HOÀN THÀNH">
                        </div>
                    </div>
                    <!-- End -->
                </div>
            </form>
                 <!-- Hiển thị sản phẩm  -->
            <div class="">
                <div class="delivery-content-left-button-hienthisanpham">
                    <button>
                        <p>HIỂN THỊ SẢN PHẨM</p>
                    </button>
                </div>
                <div class="delivery-left-ThongTinSanPham">
                    <div class="cart-left">
                        <table style="width: 145%;">
                            <tr>
                                <th>
                                    STT
                                </th>
                                <th>
                                    ẢNH
                                </th>
                                <th >
                                    TÊN
                                </th>
                                <th>
                                    MÀU SẮC
                                </th>
                                <th>
                                    SIZE
                                </th>
                                <th>
                                    SL
                                </th>
                                <th >
                                    THÀNH TIỀN
                                </th>
                            </tr>
                            <?php list($tong,$tongsanpham) = showcart() ?>
                        </table>
                    </div>
                </div>
            </div>
            <!-- End  -->
        </div>
    </section>
  
<!--*********script*********-->
<script>
    // kiem tra chon payment_methods
    function validatePayment() {
    var paymentMenthods = document.querySelector('input[name="payment_menthods"]:checked');
    if (!paymentMenthods) {
        alert("Vui lòng chọn phương thức thanh toán.");
        return false;
    }
    }
    // format price 
       $('.format-price').simpleMoneyFormat();
    // Delivery
    // gửi ajax tỉnh thành phố 
     $(document).ready(function(){
        $('#matp').change(function()
        {
            // alert($(this).val())
            var x = $(this).val();
            $.get("matp_ajax.php",{matp:x},function(data){
                $("#maqh").html(data)
            })
        })
    })
    // gửi ajax quận huện 
     $(document).ready(function(){
        $('#maqh').change(function()
        {
            // alert($(this).val())
            var x = $(this).val();
            $.get("maqh_ajax.php",{maqh:x},function(data){
                $("#xaid").html(data)
            })
        })
    })
    //click vao hien thi se hien thi
    const show = document.querySelector(".delivery-content-left-button-hienthisanpham")
    show.addEventListener("click", function () {
        document.querySelector(".delivery-left-ThongTinSanPham").classList.toggle("activeB")
    })
</script>

<?php
include "footer.php";
?>