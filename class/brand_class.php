<?php
require_once('classes.php');
class brand{
    private $db;
    public function __construct()
    {
        $this -> db = new Database();
    }
    public function insert_brand($cartegory_id,$brand_name)
    {
        $query = "INSERT INTO tbl_brand (cartegory_id,brand_name) VALUES ('$cartegory_id','$brand_name')";
        $result = $this -> db -> insert($query);
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
    
     public function show_cartegory()
    {
        $query = "SELECT * FROM tbl_cartegory ORDER BY cartegory_id DESC";
        $result = $this -> db -> select($query);
        return $result;
    }
    public function getbrand($brand_id)
    {
        $query = "SELECT * FROM tbl_brand WHERE brand_id = '$brand_id' ";
        $result = $this -> db -> select($query);
        return $result;
    }
    public function update_brand($brand_id,$brand_name)
    {
        $query = "UPDATE tbl_brand set brand_name = '$brand_name' where brand_id = '$brand_id' ";
        $result = $this -> db -> update($query);       
        header('Location:brandlist.php');
        return $result; 
    }
    public function delete_brand($brand_id,$brand_name)
    {
        $query = "DELETE FROM  tbl_cartegory WHERE  brand_name = '$brand_name' AND brand_id = '$brand_id' ";
        $result = $this -> db -> delete($query);       
        header('Location:bradlist.php');
        return $result; 
    }
    public function show_brand_cartegory($cartegory_id)
    {
       $query = "SELECT tbl_brand.*, tbl_cartegory.cartegory_name 
        FROM tbl_brand 
        INNER JOIN tbl_cartegory ON tbl_brand.cartegory_id = tbl_cartegory.cartegory_id
        WHERE tbl_cartegory.cartegory_name = '$cartegory_id'
        ORDER BY tbl_brand.brand_id DESC;
        ";
        $result = $this -> db -> select($query);
        return $result;
    }
}
?>