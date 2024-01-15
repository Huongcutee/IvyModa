<?php
include '../database.php';
class cart{
    private $db;
    public function __construct()
    {
        $this -> db = new Database();
    }
   
    public function select_Tinh_Thanhpho(){
    $query = "SELECT * FROM tbl_tinhthanhpho 
    ";
    $result = $this -> db -> select($query);
    return $result;
    }
    public function show_maqh_ajax($matp){
    $query = "SELECT * FROM tbl_quanhuyen 
    where matp = '$matp'
    ";
    $result = $this -> db -> select($query);
    return $result;
    }
     public function show_xaid_ajax($maqh){
    $query = "SELECT * FROM tbl_xaphuongthitran 
    where maqh = '$maqh'
    ";
    $result = $this -> db -> select($query);
    return $result;
    }
    public function insert_cart()
    {
        $code_order = $_POST['code_order'];
        $tong = $_POST['total_price'];
        $payment_menthods = $_POST['payment_menthods'];
        $query = "INSERT INTO cart
        (
            code_order,
            email,
            total_price,
            payment_methods,
            payment_status
        )
        values ('$code_order','ẩn danh','$tong','$payment_menthods','Chưa thanh toán')";
        $result = $this -> db -> insert($query);
        return $result;
    }
    public function insert_cart_detail_address()
    {
        $code_order = $_POST['code_order'];
        $name_user = $_POST['name'];
        $date_order = date("Y-m-d H:i:s");
        $sdt = $_POST['sdt'];
        $matp = $_POST['matp'];
        $maqh = $_POST['maqh'];
        $xaid = $_POST['xaid'];
        $dia_chi = $_POST['dia_chi'];
        $query = "INSERT INTO cart_detail_address
        (
            code_order,
            date_order,
            name_user,
            sdt,
            matp,
            maqh,
            xaid,
            dia_chi
        )
        values ('$code_order','$date_order','$name_user',$sdt,'$matp','$maqh','$xaid','$dia_chi')";
        $result = $this -> db -> insert($query);
        return $result;
    }
    public function insert_detail_product()
    {
        session_start();
        if(isset($_SESSION["gio_hang"])){
            for($i = 0; $i < count($_SESSION["gio_hang"]);$i++)
            {
                $code_order = $_POST["code_order"];
                $product_id = $_SESSION["gio_hang"][$i][0];
                $product_price = $_SESSION['gio_hang'][$i][2];
                $quanity = $_SESSION['gio_hang'][$i][4];
                $query = "INSERT INTO cart_detail_product 
                (
                    code_order,
                    product_id,
                    product_price,
                    quanity
                )
            VALUES ('$code_order','$product_id','$product_price','$quanity')";
            $result = $this -> db -> insert($query);
            }
        }
        return $result;
    }
    public function insert_ncb()
    {
        if(isset($_GET['vnp_Amount']))
        {
        $vnp_TxnRef = $_GET['vnp_TxnRef']; 
        $vnp_Amount = $_GET['vnp_Amount'];
        $vnp_BankCode= $_GET['vnp_BankCode'];
        $vnp_BankTranNo = $_GET['vnp_BankTranNo'];
        $vnp_CardType = $_GET['vnp_CardType'];
        $vnp_OrderInfo = $_GET['vnp_OrderInfo'];
        $vnp_PayDate = $_GET['vnp_PayDate'];
        $vnp_ResponseCode = $_GET['vnp_ResponseCode'];
        $vnp_TmnCode = $_GET['vnp_TmnCode'];
        $vnp_TransactionNo = $_GET['vnp_TransactionNo'];
        $vnp_TransactionStatus = $_GET['vnp_TransactionStatus'];
        $vnp_SecureHash = $_GET['vnp_SecureHash'];
        }
         $query = "INSERT INTO ncb
        (
            vnp_TxnRef,
            vnp_Amount,
            vnp_BankCode,
            vnp_BankTranNo,
            vnp_CardType,
            vnp_OrderInfo,
            vnp_PayDate,
            vnp_ResponseCode,
            vnp_TmnCode,
            vnp_TransactionNo,
            vnp_TransactionStatus,
            vnp_SecureHash
        )
        values ('$vnp_TxnRef','$vnp_Amount','$vnp_BankCode','$vnp_BankTranNo','$vnp_CardType','$vnp_OrderInfo','$vnp_PayDate','$vnp_ResponseCode','$vnp_TmnCode','$vnp_TransactionNo','$vnp_TransactionStatus','$vnp_SecureHash')";
        $result = $this -> db -> insert($query);
        return $result;
    }
  
    public function show_cart()
    {
        $query = "SELECT * FROM cart
        order by id_cart desc";
        $result = $this -> db -> select($query);

        return $result;
    }
     public function delete_cart($id_cart)
    {
        $query = "DELETE FROM  cart WHERE  id_cart = '$id_cart'
         ";
        $result = $this -> db -> delete($query);  
        header("location:orderlist.php");
        return $result; 
    }
    public function delete_cart_detail_product($code_order)
    {
         $query = "DELETE FROM  cart_detail_product WHERE  code_order = '$code_order'
         ";
        $result = $this -> db -> delete($query);
        return $result;
    }
    public function delete_cart_detail_address($code_order)
    {
         $query = "DELETE FROM  cart_detail_address WHERE  code_order = '$code_order'
         ";
        $result = $this -> db -> delete($query);
        return $result;
    }
     public function delete_ncb($code_order)
    {
         $query = "DELETE FROM  ncb WHERE  vnp_TxnRef = '$code_order'
         ";
        $result = $this -> db -> delete($query);
        return $result;
    }
    public function get_cart($id_card)
    {
        $query = "SELECT * FROM cart inner join cart_detail_address on 
        cart.code_order = cart_detail_address.code_order inner join cart_detail_product on 
        cart_detail_address.code_order = cart_detail_product.code_order
        where cart.id_cart = $id_card
        ";
        $result = $this -> db -> select($query);
        return $result;
    }
    public function get_ThanhPho($matp){
        $query = "SELECT * from tbl_tinhthanhpho where matp = $matp";
        $result = $this -> db -> select($query);
        return $result;
    }
    public function get_QuanHuyen($maqh){
        $query = "SELECT * from tbl_quanhuyen where maqh = $maqh";
        $result = $this -> db -> select($query);
        return $result;
    }
    public function get_PhuongXa($xaid){
        $query = "SELECT * from tbl_xaphuongthitran where xaid = $xaid";
        $result = $this -> db -> select($query);
        return $result;
    }
    public function get_product($product_id){
        $query = "SELECT * from tbl_product where product_id = $product_id";
        $result = $this -> db -> select($query);
        return $result;
    }
    public function update_cart(){
        $id_cart = $_GET['id_cart'];
        $code_order = $_GET['code_order'];
        $email = $_GET['email'];
        $total_price = $_GET['total_price'];
        $payment_methods = $_GET['payment_methods'];
        $payment_status = $_GET['payment_status'];
        $query  ="UPDATE cart set 
        code_order = '$code_order',
        email = '$email',
        total_price = '$total_price',
        payment_methods = '$payment_methods',
        payment_status = '$payment_status'
        where id_cart = '$id_cart'";
        $result = $this -> db -> update($query);
        header('Location:orderlist.php');
        return $result;
    }
    public function update_detail_product(){
        $query  ="";
        $result = $this -> db -> insert($query);
        return $result;
    }
    public function update_detail_address(){
        $query  ="";
        $result = $this -> db -> insert($query);
        return $result;
    }
    public function get_cart_detail_product($code_order)
    {
        $query = "SELECT * FROM cart_detail_product where code_order = '$code_order'";
        $result = $this -> db -> select($query);
        return $result;
    }
       public function update_cart_status($id_cart)
    {
        $query = "UPDATE cart set _status = 'Đã Duyệt' where id_cart = '$id_cart' ";
        $result = $this -> db -> update($query);
        return $result;
    }
    
}
?>