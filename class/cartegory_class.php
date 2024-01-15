<?php
require_once('classes.php');
class cartegory{
    private $db;
    public function __construct()
    {
        $this -> db = new Database();
    }
    public function insert_cartegory($cartegory_name)
    {
        $query = "INSERT INTO tbl_cartegory (cartegory_name) VALUES ('$cartegory_name')";
        $result = $this -> db -> insert($query);
        return $result;
    }
    public function show_cartegory()
    {
        $query = "SELECT * FROM tbl_cartegory ORDER BY cartegory_id DESC";
        $result = $this -> db -> select($query);
        return $result;
    }
    public function getcartegory($cartegory_id)
    {
        $query = "SELECT * FROM tbl_cartegory WHERE cartegory_id = '$cartegory_id' ";
        $result = $this -> db -> select($query);
        return $result;
    }
    public function update_cartegory($cartegory_id,$cartegory_name)
    {
        $query = "UPDATE tbl_cartegory set cartegory_name = '$cartegory_name' where cartegory_id = '$cartegory_id' ";
        $result = $this -> db -> update($query);       
        header('Location:cartegorylist.php');
        return $result; 
    }
    public function delete_cartegory($cartegory_id,$cartegory_name)
    {
        $query = "DELETE FROM  tbl_cartegory WHERE  cartegory_name = '$cartegory_name' AND cartegory_id = '$cartegory_id' ";
        $result = $this -> db -> delete($query);       
        header('Location:cartegorylist.php');
        return $result; 
    }

}
?>