<?php
include '../database.php';
?>
<?php
class product_img_desc{
 private $db;
    public function __construct()
    {
        $this -> db = new Database();
    }
    public function show_product_img_desc()
    {
       $query = "SELECT tbl_product_img_desc.*, tbl_product.product_name, tbl_product.product_img 
        FROM tbl_product_img_desc inner join tbl_product on tbl_product_img_desc.product_id = tbl_product.product_id
        order by tbl_product_img_desc.product_id,tbl_product.product_name desc";
        $result = $this -> db -> select($query);
        return $result;
    }
    public function delete_product_img_desc($product_img_desc)
    {
        $query = "DELETE FROM  tbl_product_img_desc WHERE  product_img_desc = '$product_img_desc'";
        $result = $this -> db -> delete($query);  
        header('Location:product_img_desc_list.php');
        return $result; 
    }
       public function get_product_img_desc_id($product_img_desc)
    {
        $query = "SELECT * FROM tbl_product_img_desc WHERE product_img_desc = '$product_img_desc' limit 1";
        $result = $this -> db -> select($query);
        return $result;
    }
      public function update_product_img_desc()
    {
        $product_img_desc = $_FILES["product_img_desc"]['name'];
        $product_id = $_POST['product_id'];
        $product_img_desc_tmp = $_FILES["product_img_desc"]['tmp_name'];
        if($product_img_desc != '' )
        {
            move_uploaded_file($product_img_desc_tmp,"../uploads/".$product_img_desc);
            $query = "UPDATE tbl_product_img_desc set 
            product_img_desc = '$product_img_desc'
            where product_id = '$product_id'";
        }
        else{
             header('Location:product_img_desc_list.php');
        }
        $result = $this -> db -> update($query); 
        header('Location:product_img_desc_list.php');      
        return $result; 
    }
}
?>