<?php
include '../database.php';
?>
<?php
class product{
 private $db;
    public function __construct()
    {
        $this -> db = new Database();
    }
      public function show_cartegory()
    {
        $query = "SELECT * FROM tbl_cartegory ORDER BY cartegory_id DESC";
        $result = $this -> db -> select($query);
        return $result;
    }
    public function show_brand()
    {
       $query = "SELECT tbl_brand.*, tbl_cartegory.cartegory_name 
        FROM tbl_brand inner join tbl_cartegory on tbl_brand.cartegory_id = tbl_cartegory.cartegory_id
        order by tbl_brand.brand_id desc";
        $result = $this -> db -> select($query);
        return $result;
    }
    public function show_brand_ajax($cartegory_id)
    {
        $query = "SELECT * FROM tbl_brand WHERE cartegory_id = '$cartegory_id'";
        $result = $this -> db -> select($query);
        return $result;
    }
     public function  insert_product()
    {
        $product_name = $_POST["product_name"];
        $cartegory_id = $_POST["cartegory_id"];
        $brand_id = $_POST["brand_id"];
        $product_price = $_POST["product_price"];
        $product_sale = $_POST["product_sale"];
        $product_color = $_POST["product_color"];
        $product_desc = $_POST["product_desc"];
        $product_img = $_FILES["product_img"]['name'];
        $product_img_tmp = $_FILES["product_img"]['tmp_name'];
        $filetarget = basename($_FILES["product_img"]['name']);
        if(file_exists("../uploads/$filetarget"))
        {
            return false;
        }
        else{
           
            $query = "INSERT INTO tbl_product 
            (
                product_name,
                cartegory_id,
                brand_id,
                product_price,
                product_sale,
                product_color,
                product_desc,
                product_img
            )
            VALUES ('$product_name','$cartegory_id','$brand_id','$product_price','$product_sale','$product_color','$product_desc','$product_img')";
            $result = $this -> db -> insert($query);
            move_uploaded_file($product_img_tmp,"../uploads/".$product_img);
            if($result)
            {
                $query = "SELECT * from tbl_product order by product_id desc limit 1";
                $result = $this -> db -> insert($query) -> fetch_assoc();
                $product_id = $result['product_id'];
                $filename = $_FILES["product_img_desc"]['name'];
                $fillttmp = $_FILES['product_img_desc']['tmp_name'];
                foreach ($filename as $key => $value)
                {
                    move_uploaded_file($fillttmp[$key],"../uploads/".$value);
                    $query = "INSERT INTO tbl_product_img_desc (product_id,product_img_desc) values('$product_id','$value')";
                    $result = $this -> db -> insert($query);
                }
                header("Location:productlist.php");
            }
        }
    }
      public function show_product()
    {
       $query = "SELECT tbl_product.*, tbl_cartegory.cartegory_name,tbl_brand.brand_name 
        FROM tbl_product inner join tbl_cartegory on tbl_product.cartegory_id = tbl_cartegory.cartegory_id 
        inner join tbl_brand on tbl_product.brand_id = tbl_brand.brand_id 
        order by tbl_product.product_id desc, tbl_product.cartegory_id";
        $result = $this -> db -> select($query);
        return $result;
    }
      public function get_product_id($product_id)
    {
        $query = "SELECT * FROM tbl_product WHERE product_id = '$product_id' limit 1";
        $result = $this -> db -> select($query);
        return $result;
    }
    public function update_product()
    {
        $product_name = $_POST["product_name"];
        $cartegory_id = $_POST["cartegory_id"];
        $brand_id = $_POST["brand_id"];
        $product_price = $_POST["product_price"];
        $product_sale = $_POST["product_sale"];
        $product_color = $_POST["product_color"];
        $product_desc = $_POST["product_desc"];
        $product_img = $_FILES["product_img"]['name'];
        $product_img_tmp = $_FILES["product_img"]['tmp_name'];
        if($product_img != '' )
        {
            move_uploaded_file($product_img_tmp,"../uploads/".$product_img);
            $query = "UPDATE tbl_product set 
            product_name = '$product_name',
            cartegory_id = $cartegory_id,
            brand_id = $brand_id,
            product_price = $product_price,
            product_sale = $product_sale,
            product_color = $product_color,
            product_desc = '$product_desc',
            product_img = '$product_img'
            where product_name = '$product_name'";
        }
        else{
            move_uploaded_file($product_img_tmp,"../uploads/".$product_img);
           $query = "UPDATE tbl_product set 
            product_name = '$product_name',
            cartegory_id = $cartegory_id,
            brand_id = $brand_id,
            product_price = $product_price,
            product_sale = $product_sale,
            product_color = $product_color,
            product_desc = '$product_desc'
            where product_name = '$product_name'";
        }
        
        $result = $this -> db -> update($query); 
        header('Location:productlist.php');      
        return $result; 
    }
    public function delete_product($product_id)
        {
            $query = "DELETE FROM  tbl_product WHERE  product_id = '$product_id'";
            $result = $this -> db -> delete($query);  
            header('Location:productlist.php');
            return $result; 
        }
}
?>