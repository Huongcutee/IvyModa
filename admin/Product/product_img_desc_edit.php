<?php
include("../route/header.php");  
include("../route/slider.php");
include("../class/product_img_desc_class.php");
?>
 <!-- Lấy id  -->
<?php
 $product = new product_img_desc;
 if(!isset($_GET['product_img_desc']) || $_GET['product_img_desc'] == NULL )
 {
    echo "<script> window.location = 'product.php' </script>";
 }
 else{
    $product_img_desc = $_GET['product_img_desc'];
    $get_product_img_desc = $product -> get_product_img_desc_id($product_img_desc);
    if($get_product_img_desc)
    {
        $result = $get_product_img_desc -> fetch_assoc();
    }
}
?>
<!-- Sửa name -->
 <?php
 if($_SERVER['REQUEST_METHOD'] === 'POST'){
   
     $update_product_img_desc = $product -> update_product_img_desc();
     if($update_product_img_desc)
     {
          $product_img_desc = $result['product_img_desc'];
          unlink('../uploads/'.$product_img_desc);    
     }
 }
 ?>
 </script>
 <div class="admin-content-right">
            <div class="admin-content-right-cartegory-add">
                <h1>Sửa ảnh mô tả sản phẩm</h1>
                <div class="admin-content-right">
                    <div class="admin-content-right-product-add ">
                    <form action="" method="post" enctype="multipart/form-data">

                        <div class="admin-content-right-product-add-content">
                        <label for="">ID sản phẩm</label>
                        <p style="color: red;">*</p>
                    </div>
                    <span>
                        <?php echo $result['product_id']?>
                    </span>
                    <div style="display: none;">
                        <input value="<?php echo $result['product_id'] ?>" name="product_id" required type="text">
                    </div>
                   

                        <div class="admin-content-right-product-add-content">
                                <label for="">Ảnh mô tả </label>
                                <p style="color: red;">*</p>
                        </div>
                            <input name="product_img_desc" type="file" id="imgInp">
                            <img id="blah" src="../uploads/<?php echo $result["product_img_desc"]; ?>" style="display:block ; width: 100px; height: auto;"/>
                            <button type="submit">Sửa</button>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>
<script>
    // gửi qua ajax 
    $(document).ready(function(){
        $('#cartegory_id').change(function()
        {
            // alert($(this).val())
            var x = $(this).val();  
            $.get("productadd_ajax.php",{cartegory_id:x},function(data){
                $("#brand_id").html(data)
            })
        })
    })
    // 
        ClassicEditor
        .create( document.querySelector('#content'),{
            filebrowserBrowseUrl:'ckfinder/ckfinder.html',
            filebrowserUploadUrl:'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files'
        })
        .catch(error => {
            console.log(error);
        });

        // preview img b4 uploading
        const show = document.querySelector("#imgInp")
        show.addEventListener("click",function()
        {
            document.querySelector("#blah").style.display = "block"
        })
        imgInp.onchange = evt => 
        {
            const [file] = imgInp.files
            if (file) {
                blah.src = URL.createObjectURL(file)
            }
        }
</script>