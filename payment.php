<?php
include "header.php";
include "class/cart_class.php";
?>
<?php 
    $cart = new cart();
    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
    $insert_cart = $cart -> insert_cart();
    $insert_cart_deatil_address = $cart -> insert_cart_detail_address();
    $insert_cart_deatil_address = $cart -> insert_detail_product();
    }
?>
<?php
// thanh toán vnpay
    if($_POST['payment_menthods'] == 'Thanh toán bằng VNPAY')
    {
        error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
        date_default_timezone_set('Asia/Ho_Chi_Minh');

        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = "http://localhost/ivyhtml/thanks.php";
        $vnp_TmnCode = "S5HLR5FZ";//Mã website tại VNPAY 
        $vnp_HashSecret = "PXFJRBSXMCGHRZHGKOBOMEBDSTNZYAQW"; //Chuỗi bí mật
        
        $vnp_TxnRef = $_POST['code_order']; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        $vnp_OrderInfo = 'Nội dung thanh toán';
        $vnp_OrderType = 'billpayment';
        $vnp_Amount = $_POST['total_price']*100;
        $vnp_Locale = 'vn';
        $vnp_BankCode = 'NCB';
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
        //Add Params of 2.0.1 Version
        // thời gian hết hạn thanh toán
        //$vnp_ExpireDate = $_POST['txtexpire'];
        //Billing
        // $vnp_Bill_Mobile = $_POST['txt_billing_mobile'];
        // $vnp_Bill_Email = $_POST['txt_billing_email'];
        // $fullName = trim($_POST['txt_billing_fullname']);
        // if (isset($fullName) && trim($fullName) != '') {
        //     $name = explode(' ', $fullName);
        //     $vnp_Bill_FirstName = array_shift($name);
        //     $vnp_Bill_LastName = array_pop($name);
        // }
        // $vnp_Bill_Address=$_POST['txt_inv_addr1'];
        // $vnp_Bill_City=$_POST['txt_bill_city'];
        // $vnp_Bill_Country=$_POST['txt_bill_country'];
        // $vnp_Bill_State=$_POST['txt_bill_state'];
        // // Invoice
        // $vnp_Inv_Phone=$_POST['txt_inv_mobile'];
        // $vnp_Inv_Email=$_POST['txt_inv_email'];
        // $vnp_Inv_Customer=$_POST['txt_inv_customer'];
        // $vnp_Inv_Address=$_POST['txt_inv_addr1'];
        // $vnp_Inv_Company=$_POST['txt_inv_company'];
        // $vnp_Inv_Taxcode=$_POST['txt_inv_taxcode'];
        // $vnp_Inv_Type=$_POST['cbo_inv_type'];
        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
            // "vnp_ExpireDate"=>$vnp_ExpireDate,
            // "vnp_Bill_Mobile"=>$vnp_Bill_Mobile,
            // "vnp_Bill_Email"=>$vnp_Bill_Email,
            // "vnp_Bill_FirstName"=>$vnp_Bill_FirstName,
            // "vnp_Bill_LastName"=>$vnp_Bill_LastName,
            // "vnp_Bill_Address"=>$vnp_Bill_Address,
            // "vnp_Bill_City"=>$vnp_Bill_City,
            // "vnp_Bill_Country"=>$vnp_Bill_Country,
            // "vnp_Inv_Phone"=>$vnp_Inv_Phone,
            // "vnp_Inv_Email"=>$vnp_Inv_Email,
            // "vnp_Inv_Customer"=>$vnp_Inv_Customer,
            // "vnp_Inv_Address"=>$vnp_Inv_Address,
            // "vnp_Inv_Company"=>$vnp_Inv_Company,
            // "vnp_Inv_Taxcode"=>$vnp_Inv_Taxcode,
            // "vnp_Inv_Type"=>$vnp_Inv_Type
        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        // if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
        //     $inputData['vnp_Bill_State'] = $vnp_Bill_State;
        // }

        //var_dump($inputData);
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret);//  
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        $returnData = array('code' => '00'
            , 'message' => 'success'
            , 'data' => $vnp_Url);
            if (isset($_POST['payment_menthods'])) {
                header('Location: ' . $vnp_Url);
                die();
            } else {
                echo json_encode($returnData);
            }
    }    
	// vui lòng tham khảo thêm tại code demo
?>
    <!-- ---------------------------- Payment ---------------------------- -->
    <section class="payment">
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
        <div class="container-payment row">
            
            <div class="payment-left-content">
                <div class="payment-left-content-top">
                    <div class="payment-left-content-top-top row">
                        <p>
                            Thẻ ATM / Tài khoản ngân hàng
                        </p>
                        <img src="images/atm.png">
                    </div>
                    <div class="payment-left-content-top-bottom">
                        <div class="payment-left-content-top-bottom-top">
                            <a href=""><i class="fa-solid fa-chevron-left"></i>Thanh toán qua bidv</a>
                            <img src="images/logobidv.png">
                        </div>
                        <div class="payment-left-content-middle">
                            <div class="payment-left-content-middle-title row">
                                <div class="payment-left-content-middle-title-item">
                                    <p>Số thẻ</p>
                                </div>
                                <div class="payment-left-content-middle-title-item">
                                    <p>Số tài khoản</p>
                                </div>
                            </div>

                            <div class="payment-left-content-middle-content-sothe">
                                <div class="payment-left-content-middle-content-sothe-item">
                                    <p>Số thẻ*</p>
                                    <input type="number" placeholder="0974 1234 5678 9123 012">
                                </div>
                                <div class="payment-left-content-middle-content-sothe-item">
                                    <p>Tên chủ thẻ*</p>
                                    <input type="text" placeholder="NGUYEN VAN A">
                                </div>
                            </div>
                            <div class="payment-left-content-middle-content-sotaikhoan">
                                <div class="payment-left-content-middle-content-sotaikhoan-item">
                                    <p>Số tài khoản*</p>
                                    <input type="number">
                                </div>
                                <div class="payment-left-content-middle-content-sotaikhoan-item">
                                    <p>Họ và tên*</p>
                                    <input type="text" placeholder="NGUYEN VAN A">
                                </div>

                            </div>
                        </div>
                        <div class="payment-left-content-button">
                            <a href="">Hướng dẫn</a>
                            <button>Thanh toán</button>
                        </div>
                        <div class="payment-left-content-bot">
                            <a href="delivery.php">x Hủy giao dịch</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="payment-right-content">
                <div class="payment-right-content-bot">
                    <h3 style="margin-top: 20px;">Thông tin đơn hàng</h3>
                    <table>
                        <tr>
                            <td>Đơn vị chấp nhận vận chuyển</td>
                        </tr>
                        <tr>
                            <td>IVY</td>
                        </tr>
                        <tr>
                            <td>
                                Mã đơn hàng
                            </td>
                            <td>IVM7332759</td>
                        </tr>
                        <tr>
                            <td>Số tiền thanh toán</td>
                            <td><b>1.869.000<sup>đ</sup></b></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </section>
   <?php
include "footer.php";
?>